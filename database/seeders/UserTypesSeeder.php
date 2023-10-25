<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    static $types = [
        'admin',
        'user',
        'driver',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         foreach (self::$types as $tp) {
            DB::table('user_types')->insert([
                'name' => $tp,
            ]);
        }
    }
}
