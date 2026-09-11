<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Database\Eloquent\Model;

class ProductsImport implements
    ToModel,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row): ?Model
    {
        return new Product([
            'name' => $row['nombre'],
            'description' => $row['descripcion'] ?? null,
            'price' => $row['precio'],
            'stock' => $row['stock'],
            'active' => $this->parseActive($row['estado'] ?? 'Activo'),
            'photo' => $row['foto'] ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.nombre' => ['required', 'string', 'max:255'],
            '*.descripcion' => ['nullable', 'string'],
            '*.precio' => ['required', 'numeric', 'min:0'],
            '*.stock' => ['required', 'integer', 'min:0'],
            '*.estado' => ['nullable'],
            '*.foto' => ['nullable', 'url', 'max:2048'],
        ];
    }

    private function parseActive($value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        $value = strtolower(trim((string) $value));

        return in_array($value, [
            '1',
            'true',
            'si',
            'sí',
            'activo',
            'yes',
        ]);
    }
}
