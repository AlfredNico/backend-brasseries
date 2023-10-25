<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserTypes;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    static $users = [
        [
            'nm' => 'Olivier KAMDEM',
            'usm' => 'olivier.kamdem@camtrack.net'
        ], [
            'nm' => 'Alanic Julio NGUETSA',
            'usm' => 'alanic.nguetsa@camtrack.net',
        ], [
            'nm' => 'Armstrong Kufor',
            'usm' => 'armstrong.kufor@camtrack.net',
        ], [
            'nm' => 'Donald NKOUAKEP',
            'usm' => 'donald.nkouakep@camtrack.net',
        ], [
            'nm' => 'Alfred Nico',
            'usm' => 'alfred.andrianjatovo@camtrack.mg',
        ], [
            'nm' => 'user test',
            'usm' => 'user.test@camtrack.net',
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::$users as $usr) {
            User::create([
                'name' => $usr['nm'],
                'username' =>  $usr['usm'],
                'passwd' => bcrypt('123456'),
                'dates' => null,
                'is_activated' => true,
                'cle_user' => strtoupper(Str::random(5)),
                'departement_id' => null,
                'usertype_id' => UserTypes::where('name', 'admin')->first()->ids,
            ]);
        }
    }
}
