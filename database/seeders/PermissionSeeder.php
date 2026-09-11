<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'Ver productos',
                'str' => 'view-products',
            ],
            [
                'name' => 'Crear empleados',
                'str' => 'create-products',
            ],
            [
                'name' => 'mirar productos',
                'str' => 'view-products',
            ],
            [
                'name' => 'Editar productos',
                'str' => 'edit-products',
            ],
            [
                'name' => 'Eliminar empleados',
                'str' => 'delete-products',
            ],
            [
                'name' => 'Exportar productos',
                'str' => 'export-products',
            ],
            [
                'name' => 'Importar productos',
                'str' => 'import-products',
            ],
        ];


        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'str' => $permission['str'],
                ],
                [
                    'name' => $permission['name'],
                ]
            );
        }
    }
}
