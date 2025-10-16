<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'primer_apellido' => 'Ejemplo',
                'segundo_apellido' => null,
                'password' => Hash::make('admin123'),
                'id_rol' => 1,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Usuario',
                'primer_apellido' => 'Normal',
                'segundo_apellido' => null,
                'password' => Hash::make('user123'),
                'id_rol' => 2,
            ]
        );
    }
}

