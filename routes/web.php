<?php
use App\Http\Controllers\BallController;
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

Route::get('/balls', [BallController::class, 'index'])->middleware(['auth']);

Route::get('/update/{ball_id}', [BallController::class, 'update'])->middleware(['auth'])->name('update_form');
Route::post('/update', [BallController::class, 'store'])->middleware(['auth'])->name('store');

Route::get('/delete/{ball_id}', [BallController::class, 'delete'])->middleware(['auth'])->name('delete');

Route::get('/ball/{ball_id}', [BallController::class, 'ball'])->middleware(['auth'])->name('ball');
Route::get('/addballs', function () {
    return view('addballs');
})->middleware(['auth'])->name('addballs');

Route::post('/postBall', [BallController::class, 'save'])->middleware(['auth'])->name('postBall');

require __DIR__.'/auth.php';
