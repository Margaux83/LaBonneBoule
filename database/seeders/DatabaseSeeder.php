<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Date;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //COMPTE ADMIN : A ne pas faire évidemment, c'est juste pour la présentation
        DB::table('users')->insert([
            'name' => 'AdminESGI',
            'email' => 'esgi-admin@myges.fr',
            'password' => Hash::make('admin'),
        ]);

        $users = ['Maxime Carluer', 'Louis Moulin', 'Loudo Rex-Harrison', 'Margaux Hebert', 'Calvin VeryBadTrip', 'Padito ElChapo', 'Antoine LeBlond', 'Christophe Critique', 'Abdelhamid Jaméla'];
        for ($i = 0; $i < count($users); $i++) {
            DB::table('users')->insert([
                'name' => $users[$i],
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
        for ($i = 0; $i <= count($users); $i++) {
            DB::table('shoppingcarts')->insert([
                'user_id' => $i,
            ]);
        }

        $tournaments = ['Premier Tournoi', "Tournoi de l'été", "Tournoi départemental", "Tournoi national", 'Tournoi mondial'];
        for ($i = 0; $i < count($tournaments); $i++) {
            DB::table('tournaments')->insert([
                'name' => $tournaments[$i],
                'date_start' => new \DateTime(),
                'date_end' => new \DateTime()
            ]);
        }
    }
}
