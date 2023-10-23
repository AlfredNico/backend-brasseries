<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{

    static $status = [
        'OK',
        'Not OK',
        'En panne',
    ];
    static $types = [
        'M',
        'AM',
        'V',
        'D'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         foreach (self::$types as $tp) {
            foreach (self::$status as $stt) {
                DB::table('statuses')->insert([
                    'name' => $stt,
                    'type' => $tp
                ]);
            }
        }
    }
}
