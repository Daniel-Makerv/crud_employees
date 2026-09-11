<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsTemplateExport implements FromCollection, WithHeadings
{
    public function collection(): Collection
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Descripción',
            'Precio',
            'Stock',
            'Estado',
            'Foto',
        ];
    }
}
