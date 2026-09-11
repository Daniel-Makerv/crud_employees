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
                'name' => 'Ver empleados',
                'str' => 'view-employees',
            ],
            [
                'name' => 'Crear empleados',
                'str' => 'create-employees',
            ],
            [
                'name' => 'Editar empleados',
                'str' => 'edit-employees',
            ],
            [
                'name' => 'Eliminar empleados',
                'str' => 'delete-employees',
            ],
            [
                'name' => 'Restaurar empleados',
                'str' => 'restore-employees',
            ],
            [
                'name' => 'Exportar empleados',
                'str' => 'export-employees',
            ],
            [
                'name' => 'Importar empleados',
                'str' => 'import-employees',
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
