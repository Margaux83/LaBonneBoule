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

        $items = ['balls' => [1,2,3,4], 'cups' => []];
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
            
        }

        $teams = ['LesFifousDeLeNight' => 1, 'BcpTropSrx' => 2, 'TryHarderDeLXTrem' => 3, 'OkOk' => 4];

        $teamsResults = [
            1 => [
                'wins' => 0,
                'loses' => 0,
            ],
            2 => [
                'wins' => 0,
                'loses' => 0,
            ],
            3 => [
                'wins' => 0,
                'loses' => 0,
            ],
            4 => [
                'wins' => 0,
                'loses' => 0,
            ],
        ];
        
        $indexGame = 1;
        foreach ($tournaments as $keyTournament => $tournament) {
            $nbRound = 1;
            $nextRound = [1,2,3,4];
            shuffle($nextRound);
            $winnerTournament = null;
            while (count($nextRound) > 1 && $winnerTournament === null) {
                $nextRoundCopy = [];
                for ($i = 0; $i < count($nextRound); $i += 2) {
                    if (($i + 1) <= count($nextRound)) {
                        if ($keyTournament > 1) {
                            DB::table('games')->insert([
                                'tournament_round' => $nbRound,
                                'tournament_id' => ($keyTournament + 1),
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $nextRound[$i],
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $nextRound[$i + 1],
                            ]);
                            $indexGame ++;
                        }else {
                            $rand = [$nextRound[$i], $nextRound[$i + 1]];
                            $indexWinner = random_int(0, 1);
                            $winnerGame = $rand[$indexWinner];
                            $loserGame = $rand[$indexWinner === 0 ? 1 : 0];

                            $teamsResults[$winnerGame]['wins'] ++;
                            $teamsResults[$loserGame]['loses'] ++;
                            array_push($nextRoundCopy, $winnerGame);
                            DB::table('games')->insert([
                                'tournament_round' => $nbRound,
                                'tournament_id' => ($keyTournament + 1),
                                'winner' => $winnerGame
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $nextRound[$i],
                            ]);
                            DB::table('teamgames')->insert([
                                'game_id' => $indexGame,
                                'team_id' => $nextRound[$i + 1],
                            ]);
                            $indexGame ++;
                        }
                    }
                }
                $nbRound ++;
                $nextRound = $nextRoundCopy;

                if (count($nextRound) === 1) {
                    $winnerTournament = $nextRound[0];
                }
            }

            DB::table('tournaments')->insert([
                'name' => $tournament,
                'date_start' => new \DateTime(),
                'date_end' => new \DateTime(),
                'winner' => $winnerTournament
            ]);
        }

        foreach ($teams as $key => $value) {
            DB::table('teams')->insert([
                'name' => $key,
                'wins' => $teamsResults[$value]['wins'],
                'loses' => $teamsResults[$value]['loses'],
                'creator' => $value
            ]);
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
