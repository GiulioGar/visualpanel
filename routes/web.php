<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerTarget;
use App\Http\Controllers\UserImportController;

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

//rotte panel get
Route::get('/gestioneTarget', [ControllerTarget::class,'stampaTarget']);
Route::get('/vediTarget/{id}', [ControllerTarget::class,'countUsers']);
Route::get('/associazioniTarget/{targetInfo}', [ControllerTarget::class,'stampaAssociazioni']);

//route panel post
Route::post('/gestioneTarget', [ControllerTarget::class,'store']);
Route::post('/associazioniTarget/{targetInfo}', [ControllerTarget::class,'storeA']);

//route panel delete
Route::delete('/gestioneTarget/{evento}', [ControllerTarget::class,'destroy']);
Route::delete('/associazioniTarget/{evento2}', [ControllerTarget::class,'destroy']);

//route edit
Route::patch('/gestioneTarget/{targ}', [ControllerTarget::class,'update']);

Route::get('/export/{id}', [ControllerTarget::class, 'csvDownload']);
