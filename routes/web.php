<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Models\Player;

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
    $players = Player::pluck('name', 'id');

    $game = null;
    if (session('game'))
        $game = session('game');

    return view('home', compact('players', 'game'));
})->name('home');

Route::get('players/{gameId?}', [PlayerController::class, 'index'])->name('players.index');
Route::resource('players', PlayerController::class)->except(['index']);

Route::post('games/play', [GameController::class, 'play'])->name('games.play');
Route::get('games/restart/{id}', [GameController::class, 'restart'])->name('games.restart');
Route::resource('games', GameController::class);
