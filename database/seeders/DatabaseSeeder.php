<?php

namespace Database\Seeders;

use Hash;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $usuario = User::create([
            'name' => 'Nortti Sistemas',
            'email' => 'contato@nortti.net',
            'password' => Hash::make('12345678'),
        ]);
		Admin::create([
			'user_id' => $usuario->id
		]);

    }
}
