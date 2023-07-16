<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SAQController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\BouteilleCellierController;
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

Route::get('/importation', function () {
    return view('importation');
});

Route::get('/test', function () {
    return view('test');
});

// routes pour la vue login
Route::get('/',  [AuthController::class, 'index'])->name('login');
Route::post('/',  [AuthController::class, 'authentification']);
Route::get('/login',  [AuthController::class, 'index'])->name('login');
Route::post('/login',  [AuthController::class, 'authentification']);

Route::get('/index',  [BouteilleController::class, 'index'])->name('bouteilles.index')->middleware('auth');
Route::get('/details/{id}',  [BouteilleController::class, 'show'])->name('bouteilles.details')->middleware('auth');

Route::get('/logout',  [AuthController::class, 'deconnexion']);



//routes pour la vue création utilisateur
Route::get('/create',  [UserController::class, 'index'])->name('user.create');
Route::post('/create',  [UserController::class, 'store']);


Route::get('/importer-bouteilles', [SAQController::class, 'index'])->name('importer-bouteilles')->middleware('auth');

Route::post('/importer-bouteilles', [SAQController::class, 'scrapeSAQ']);


// routes pour la vue cellier
Route::resource('celliers',  CellierController::class)->middleware('auth');

Route::resource('bouteille-cellier',  BouteilleCellierController::class)->middleware('auth');

Route::get('/indexCellier/{cellier_id}',  [BouteilleController::class, 'indexCellier'])->name('bouteilles.indexCellier')->middleware('auth');

Route::get('/celliers/{cellier}/edit', [CellierController::class, 'edit'])->name('celliers.edit')->middleware('auth');
// Route::put('/celliers/{cellier}', [CellierController::class, 'update'])->name('celliers.update')->middleware('auth');

// Route::delete('/celliers/{cellier}', [CellierController::class, 'destroy'])->name('celliers.destroy')->middleware('auth');


