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
                                'tournament_id' => $keyTournament,
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
                                'tournament_id' => $keyTournament,
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
    }
}
