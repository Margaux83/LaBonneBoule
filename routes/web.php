<?php
use App\Http\Controllers\BallController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/balls', [BallController::class, 'index'])->middleware(['auth'])->name('balls');

Route::get('/update/{ball_id}', [BallController::class, 'update'])->middleware(['auth'])->name('update_form');
Route::post('/update', [BallController::class, 'store'])->middleware(['auth'])->name('store');

Route::get('/delete/{ball_id}', [BallController::class, 'delete'])->middleware(['auth'])->name('delete');

Route::get('/ball/{ball_id}', [BallController::class, 'ball'])->middleware(['auth'])->name('ball');
Route::get('/addballs', function () {
    return view('addballs');
})->middleware(['auth'])->name('addballs');

Route::post('/postBall', [BallController::class, 'save'])->middleware(['auth'])->name('postBall');


/**
 * ==============================================================
 * GAMES
 * ==============================================================
 */

Route::get('/games', [GameController::class, 'index'])->middleware(['auth'])->name('games');

/**
 * ==============================================================
 * TEAMS
 * ==============================================================
 */

Route::get('/teams', [TeamController::class, 'index'])->middleware(['auth'])->name('teams');
Route::get('/team/{team_id}', [TeamController::class, 'team'])->middleware(['auth'])->name('team');

Route::get('/addteam', function () {
    return view('addteam');
})->middleware(['auth'])->name('addteam');

Route::post('/postTeam', [TeamController::class, 'save'])->middleware(['auth'])->name('postTeam');

/**
 * ==============================================================
 * TOURNAMENT
 * ==============================================================
 */

Route::get('/tournaments', [TournamentController::class, 'index'])->middleware(['auth'])->name('tournaments');
Route::get('/tournament/{tournament_id}', [TournamentController::class, 'tournament'])->middleware(['auth'])->name('tournament');

Route::get('/addtournament', function () {
    return view('addtournament');
})->middleware(['auth'])->name('addtournament');

Route::post('/postTournament', [TournamentController::class, 'save'])->middleware(['auth'])->name('postTournament');

require __DIR__.'/auth.php';
