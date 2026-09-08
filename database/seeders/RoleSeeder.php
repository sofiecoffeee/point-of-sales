<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //eloquent : querybuilder/orm laravel
        // kalo di sql kan = insert, into, select, updatem delete, nah kalo di laravel
        // pakenya eloquent, model itu buat acuan ke tabel

        Role::insert([
            ['name'=> 'Administrator'],
            ['name'=> 'Cashier'],
            ['name'=> 'Owner'],
        ]);
    }
}
