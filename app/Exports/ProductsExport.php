<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection(): Collection
    {
        return Product::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Descripción',
            'Precio',
            'Stock',
            'Estado',
            'Foto',
            'Fecha de creación',
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $product->active ? 'Activo' : 'Inactivo',
            $product->photo,
            $product->created_at?->format('d/m/Y H:i'),
        ];
    }
}
