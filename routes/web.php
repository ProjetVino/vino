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

Route::post('recherche', [BouteilleController::class, 'rechercher'])->name('recherche');
Route::get('recherche', [BouteilleController::class, 'rechercher'])->name('recherche');

//ajouter bouteille au celleir
Route::post('ajouter-au-cellier', [BouteilleCellierController::class, 'store']);






Route::get('/logout',  [AuthController::class, 'deconnexion'])->name('authentification.logut');



//routes pour la vue création utilisateur
Route::get('/create',  [UserController::class, 'index'])->name('user.create');
Route::post('create',  [UserController::class, 'store']);


Route::get('importer-bouteilles', [SAQController::class, 'index'])->name('importer-bouteilles')->middleware('auth');
Route::post('importer-bouteilles', [SAQController::class, 'scrapeSAQ']);

//routes celliers
Route::get('/supprimer/cellier/{id}', [CellierController::class, 'destroy'])->name('supprimer-cellier')->middleware('auth');
Route::get('/modifier/cellier/{id}', [CellierController::class, 'edit'])->name('modifier-cellier')->middleware('auth');
Route::post('/modifier/cellier/{id}', [CellierController::class, 'update'])->middleware('auth');

    // routes pour la vue cellier
    Route::resource('celliers',  CellierController::class)->middleware('auth');
    Route::resource('bouteillecellier',  BouteilleCellierController::class)->middleware('auth');
    Route::get('/indexCellier/{cellier_id}',  [BouteilleController::class, 'indexCellier'])->name('bouteilles.indexCellier')->middleware('auth');
    Route::post('celliers/{id}/updateQuantite',  [BouteilleCellierController::class, 'updateQuantite'])->name('updateQuantite')->middleware('auth');
    Route::post('celliers/{id}/bouteillecellier-destroy',  [BouteilleCellierController::class, 'destroy'])->name('destroyBC')->middleware('auth');
    Route::post('rechercherCellier', [BouteilleCellierController::class, 'rechercherCellier'])->name('rechercherCellier');
    Route::post('ajouter/{id}',  [BouteilleCellierController::class, 'ajouterbouteilleaucelleir'])->name('ajouterBouteilleCellier')->middleware('auth');
