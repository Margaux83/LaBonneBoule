<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Date;
use App\Models\Role;
use App\Models\Inventory;
use App\Models\Cup;
use App\Models\Team;
use App\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator',
            'description' => 'Admin is able to manage all the site',
        ]);
        $referee = Role::create([
            'name' => 'referee',
            'display_name' => 'User Referee',
            'description' => 'referee is able to manage games',
        ]);

        $createGame = Permission::create([
            'name' => 'createGame',
            'display_name' => 'Create Games', // optional
            'description' => 'create new blog games', // optional
        ]);
        $createTournament = Permission::create([
            'name' => 'createTournament',
            'display_name' => 'Create Tournaments', // optional
            'description' => 'create new blog games', // optional
        ]);
        $createBall = Permission::create([
            'name' => 'createBall',
            'display_name' => 'Create Balls', // optional
            'description' => 'create new blog games', // optional
        ]);
        $manageGame = Permission::create([
            'name' => 'manageGame',
            'display_name' => 'Manage Games', // optional
            'description' => 'manage games', // optional
        ]);

        //COMPTE ADMIN : A ne pas laisser public évidemment, c'est juste pour la présentation
        DB::table('users')->insert([
            'name' => 'AdminESGI',
            'team_id' => 1,
            'team_accepted' => true,
            'email' => 'esgi-admin@myges.fr',
            'password' => Hash::make('admin'),
            'balance' => 192300
        ]);

        $user = User::find(1);
        $user->attachRole('admin');

        $admin->attachPermission($createGame);
        $admin->attachPermission($createTournament);
        $admin->attachPermission($createBall);

        $referee->attachPermission($manageGame);

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
        $teamUser = [2, 3, 4, 1, 2, 3, 4, 1, 2];
        $teamUserAccepted = [true, true, true, true, true, true];
        $mailUser = ['carluer.maxime@gmail.com'];
        foreach ($users as $key => $user) {
            DB::table('users')->insert([
                'name' => $user,
                'team_id' => $teamUser[$key],
                'team_accepted' => $teamUserAccepted[$key] ?? false,
                'email' => $mailUser[$key] ?? Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'balance' => 100
            ]);
        }
        for ($i = 0; $i <= count($users); $i++) {
            if ($i < 4) {
                $user = User::find($i + 2);
                $user->attachRole('referee');
            }
            DB::table('shoppingcarts')->insert([
                'user_id' => ($i + 1),
            ]);
        }

        $cupsImages = ['coupe_gold.png', 'coupe_silver.png', 'coupe_bronze.png'];
        $tournaments = ['Premier Tournoi', "Tournoi de l'été", "Tournoi départemental", "Tournoi national", 'Tournoi mondial'];
        $tournamentsStart = [new \DateTime('2021-06-19'), new \DateTime('2021-06-25'), new \DateTime('2021-07-28'), new \DateTime('2021-08-12'), new \DateTime('2021-10-01')];
        $tournamentsEnd = [new \DateTime('2021-06-19'), new \DateTime('2021-07-15'), new \DateTime('2021-07-30'), new \DateTime('2021-08-16'), new \DateTime('2021-10-09')];

        $teams = ['Les Fifous De La Night' => 1, 'Les Boulistes En Folie' => 2, 'Tir Ou Pointe' => 3, 'Ok Ok' => 4];

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
                'date_start' => $tournamentsStart[$keyTournament],
                'date_end' => $tournamentsEnd[$keyTournament],
                'winner' => $winnerTournament
            ]);

            DB::table('cups')->insert([
                'tournament_id' => ($keyTournament + 1),
                'team_id' => $winnerTournament,
                'image' => $cupsImages[random_int(0, 2)]
            ]);
        }

        foreach ($teams as $key => $value) {
            DB::table('teams')->insert([
                'name' => $key,
                'wins' => $teamsResults[$value]['wins'],
                'loses' => $teamsResults[$value]['loses'],
                'creator' => $value,
                'is_deleted' => false
            ]);
        }

        $cups = Cup::where('team_id', '!=', null)->get();
        foreach ($cups as $key => $cup) {
            $users = User::where('team_id', '=', $cup->team_id)->where('team_accepted', '=', true)->get();
            foreach ($users as $key => $user) {
                DB::table('inventories')->insert([
                    'user_id' => $user->id,
                    'cup_id' => $cup->id,
                ]);
            }
        }

        $balls = [
            [
                'name' => 'Boule COAT',
                'image' => 'boule_lr_coat.png',
                'description' => 'La boule COAT permet une précision et une gestion du tir parfait. Recommandée pour les joueurs avisés.',
                'price' => 320
            ],
            [
                'name' => 'Boule HENNOU',
                'image' => 'boule_lr_hennou.png',
                'description' => 'La boule HENNOU a du caractère et permet de mener le jeu de façon poignante. Recommandée pour les joueurs avisés.',
                'price' => 330
            ],
            [
                'name' => 'Boule SKRZYPCZYK',
                'image' => 'boule_lr_yves.png',
                'description' => 'La boule SKRZYPCZYK permet d\'entrer avec performance dans la partie. Recommandée pour les joueurs avisés.',
                'price' => 270
            ],
            [
                'name' => 'Boule VAUCELLE',
                'image' => 'boule_lr_vaucelle.png',
                'description' => 'La boule VAUCELLE est précise et permet de mettre des effets de rotation. Recommandée pour les joueurs avisés.',
                'price' => 270
            ],
            [
                'name' => 'Boule SERVAL',
                'image' => 'boule_lr_serval.png',
                'description' => 'La boule SERVER est faite pour un style plus décontracté mais toujours précis. Recommandée pour les joueurs avisés.',
                'price' => 270
            ],
            [
                'name' => 'Boule ETCHEBEST',
                'image' => 'boule_epique_etchebest.png',
                'description' => 'La boule ETCHEBEST est faite pour la puissance. Elle influence le jeu par une forte présence.',
                'price' => 190
            ],
            [
                'name' => 'Boule LA BOULE',
                'image' => 'boule_epique_laboule.png',
                'description' => 'La boule LA BOULE est menaçante. Elle rappellera à vos adversaire que vous êtes là pour gagner.',
                'price' => 180
            ],
            [
                'name' => 'Boule THANOS',
                'image' => 'boule_epique_thanos.png',
                'description' => 'La boule THANOS permet d\'éparpiller les boules adverses par sa puissance.',
                'price' => 210
            ],
            [
                'name' => 'Boule ZIZOU',
                'image' => 'boule_epique_zizou.png',
                'description' => 'La boule ZIZOU est précise, d\'une puissance plus que correcte. Frappez juste avec cette dernière.',
                'price' => 195
            ],
            [
                'name' => 'Boule Gold Match',
                'image' => 'boule_gold_match.png',
                'description' => 'La boule Gold Match est faite pour les effets.',
                'price' => 110
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut.png',
                'description' => 'Cette boule Gold Obut est faite pour rouler avec précision après le tir.',
                'price' => 140
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut_1.png',
                'description' => 'Cette boule Gold Obut est faite pour rouler après un long tir.',
                'price' => 140
            ],
            [
                'name' => 'Boule Gold Obut',
                'image' => 'boule_gold_obut_2.png',
                'description' => 'Cette boule Gold Obut est faite pour frapper fort les boules adverses.',
                'price' => 125
            ],
            [
                'name' => 'Boule Match',
                'image' => 'boule_normal_match.png',
                'description' => 'La boule Match est faite pour les effets.',
                'price' => 60
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut.png',
                'description' => 'Cette boule Obut est faite pour rouler avec précision après le tir.',
                'price' => 75
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut_1.png',
                'description' => 'Cette boule Obut est faite pour rouler après un long tir.',
                'price' => 75
            ],
            [
                'name' => 'Boule Obut',
                'image' => 'boule_normal_obut_2.png',
                'description' => 'Cette boule Obut est faite pour frapper fort les boules adverses.',
                'price' => 70
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
