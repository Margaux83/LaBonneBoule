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
            'balance' => 192300
        ]);

        $items = ['balls' => [1,2,3,4], 'cups' => [3,7]];
        foreach ($items['balls'] as $key => $itemBall) {
            DB::table('inventories')->insert([
                'user_id' => 1,
                'ball_id' => $itemBall
            ]);
        }
        foreach ($items['cups'] as $key => $itemCup) {
            DB::table('inventories')->insert([
                'user_id' => 1,
                'cup_id' => $itemCup
            ]);
        }

        $users = ['Maxime Carluer', 'Louis Moulin', 'Loudo Rex-Harrison', 'Margaux Hebert', 'Calvin VeryBadTrip', 'Padito ElChapo', 'Antoine LeBlond', 'Christophe Critique', 'Abdelhamid Jaméla'];
        foreach ($users as $key => $user) {
            DB::table('users')->insert([
                'name' => $user,
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'balance' => 100
            ]);
        }
        for ($i = 0; $i <= count($users); $i++) {
            DB::table('shoppingcarts')->insert([
                'user_id' => $i,
            ]);
        }

        $tournaments = ['Premier Tournoi', "Tournoi de l'été", "Tournoi départemental", "Tournoi national", 'Tournoi mondial'];
        foreach ($tournaments as $key => $tournament) {
            DB::table('tournaments')->insert([
                'name' => $tournament,
                'date_start' => new \DateTime(),
                'date_end' => new \DateTime()
            ]);
        }

        $teams = ['LesFifousDeLeNight' => 1, 'BcpTropSrx' => 2, 'TryHarderDeLXTrem' => 3, 'OkOk' => 4];
        foreach ($teams as $key => $value) {
            DB::table('teams')->insert([
                'name' => $key,
                'wins' => 0,
                'loses' => 0,
                'creator' => $value
            ]);
        }

        $indexGame = 1;
        foreach ($tournaments as $keyTournament => $tournament) {
            foreach ($teams as $keyTeam => $team) {
                foreach ($teams as $keyTeam2 => $team2) {
                    if ($team !== $team2) {
                        if ($keyTournament > 1) {
                            DB::table('games')->insert([
                                'tournament_id' => ($keyTournament + 1),
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $team,
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $team2,
                            ]);
                            $indexGame ++;
                        }else {
                            $rand = [$team, $team2];
                            DB::table('games')->insert([
                                'tournament_id' => ($keyTournament + 1),
                                'winner' => $rand[random_int(0, 1)]
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $team,
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $team2,
                            ]);
                            $indexGame ++;
                        }
                    }
                }  
            }
        }

        $balls = [
            [
                'name' => 'Boule COAT',
                'image' => 'boule_lr_coat.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule HENNOU',
                'image' => 'boule_lr_hennou.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule SKRZYPCZYK',
                'image' => 'boule_lr_yves.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule VAUCELLE',
                'image' => 'boule_lr_vaucelle.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule SERVAL',
                'image' => 'boule_lr_serval.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule ETCHEBEST',
                'image' => 'boule_epique_etchebest.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule LA BOULE',
                'image' => 'boule_epique_laboule.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule THANOS',
                'image' => 'boule_epique_thanos.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule ZIZOU',
                'image' => 'boule_epique_zizou.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Gold Match',
                'image' => 'boule_gold_match.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut_1.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut_2.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Match',
                'image' => 'boule_normal_match.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut_1.png',
                'description' => '',
                'price' => 270
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut_2.png',
                'description' => '',
                'price' => 270
            ],
        ];

        foreach ($balls as $key => $ball) {
            DB::table('balls')->insert([
                'name' => $ball['name'],
                'image' => $ball['image'],
                'description' => $ball['description'],
                'price' => $ball['price'],
                'isDeleted' => 0
            ]);
        }
    }
}
