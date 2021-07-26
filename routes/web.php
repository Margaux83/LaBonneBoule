<?php
use App\Http\Controllers\BallController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InventoryController;
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
})->name('dashboard');

Route::get('/balls', [BallController::class, 'index'])->name('balls');

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

Route::get('/games', [GameController::class, 'index'])->name('games');
Route::get('/game/{game_id}', [GameController::class, 'game'])->name('game');

Route::get('/addgame', [GameController::class, 'addgame'])->middleware(['auth'])->name('addgame');

Route::post('/postGame', [GameController::class, 'save'])->middleware(['auth'])->name('postGame');
Route::get('/gameSetWinner/{game_id}/{team_id}', [GameController::class, 'gameSetWinner'])->middleware(['auth'])->name('gameSetWinner');

/**
 * ==============================================================
 * TEAMS
 * ==============================================================
 */

Route::get('/teams', [TeamController::class, 'index'])->name('teams');
Route::get('/team/{team_id}', [TeamController::class, 'team'])->name('team');

Route::get('/addteam', function () {
    return view('addteam');
})->middleware(['auth'])->name('addteam');

Route::post('/postTeam', [TeamController::class, 'save'])->middleware(['auth'])->name('postTeam');

Route::get('/joinTeam/{team_id}', [TeamController::class, 'joinTeam'])->middleware(['auth'])->name('joinTeam');
Route::get('/leaveTeam', [TeamController::class, 'leaveTeam'])->middleware(['auth'])->name('leaveTeam');

Route::get('/acceptMember/{user_id}', [TeamController::class, 'acceptMember'])->middleware(['auth'])->name('acceptMember');
Route::get('/fireMember/{user_id}', [TeamController::class, 'fireMember'])->middleware(['auth'])->name('fireMember');

/**
 * ==============================================================
 * TOURNAMENT
 * ==============================================================
 */

Route::get('/tournaments', [TournamentController::class, 'index'])->name('tournaments');
Route::get('/tournament/{tournament_id}', [TournamentController::class, 'tournament'])->name('tournament');

Route::get('/addtournament', function () {
    return view('addtournament');
})->middleware(['auth'])->name('addtournament');

Route::post('/postTournament', [TournamentController::class, 'save'])->middleware(['auth'])->name('postTournament');

/**
 * ==============================================================
 * SHOPPINGCART
 * ==============================================================
 */

Route::get('/shoppingcart', [CartController::class, 'shoppingcart'])->middleware(['auth'])->name('shoppingcart');
Route::get('/addToCart/{ball_id}', [CartController::class, 'addToCart'])->middleware(['auth'])->name('addToCart');

Route::get('/removeToCartFromCart/{ball_id}', [CartController::class, 'removeToCartFromCart'])->middleware(['auth'])->name('removeToCartFromCart');
Route::get('/addToCartFromCart/{ball_id}', [CartController::class, 'addToCartFromCart'])->middleware(['auth'])->name('addToCartFromCart');
Route::get('/deleteToCart/{ball_id}', [CartController::class, 'deleteToCart'])->middleware(['auth'])->name('deleteToCart');

Route::get('/deleteCart', [CartController::class, 'deleteCart'])->middleware(['auth'])->name('deleteCart');


/*
Route::post('cart', [CartController::class, 'addToCart'])->middleware(['auth'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->middleware(['auth'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->middleware(['auth'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->middleware(['auth'])->name('cart.clear');

/**
 * ==============================================================
 * INVENTORY
 * ==============================================================
 */
Route::get('/inventory', [InventoryController::class, 'index'])->middleware(['auth'])->name('inventory');


require __DIR__.'/auth.php';
