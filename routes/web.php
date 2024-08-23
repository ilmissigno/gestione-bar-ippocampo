<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CeneController;
use App\Http\Controllers\SociController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UtentiController;
use App\Http\Controllers\TessereController;
use App\Http\Controllers\AcquistiController;
use App\Http\Controllers\ProdottiController;
use App\Http\Controllers\RicaricaController;
use App\Http\Controllers\RicaricheController;
use App\Http\Controllers\ScontrinoController;
use App\Http\Controllers\Select2SearchController;


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

Route::get('/', function () {return view('login');})->name('/');

Route::get('/home', function () {return view('home');})->name('home')->middleware('admin');

Route::get('/inventario', function () {return view('inventario');})->name('inventario')->middleware('admin');
Route::get('/inventario2', function () {return view('inventario2');})->name('inventario2')->middleware('admin');

Route::get('/inventario2/{parametro}', function ($parametro, Request $request) {return view("$parametro");})->middleware('admin');

Route::get('/acquisti', [AcquistiController::class, 'index'])->name('acquisti')->middleware('admin');

Route::get('/inventario_acquisti/{parametro}', [AcquistiController::class,'view'])->name('inventario_acquisti')->middleware('admin');
Route::get('/inventario_tessere/{parametro}', [TessereController::class,'view'])->name('inventario_tessere')->middleware('admin');
Route::get('/inventario_soci/{parametro}', [SociController::class,'view'])->name('inventario_soci')->middleware('admin');
Route::get('/inventario_prodotti/{parametro}', [ProdottiController::class,'view'])->name('inventario_prodotti')->middleware('admin');
Route::get('/inventario_ricariche/{parametro}', [RicaricheController::class,'view'])->name('inventario_ricariche')->middleware('admin');
Route::get('/inventario_utenti/{parametro}', [UtentiController::class,'view'])->name('inventario_utenti')->middleware('admin');
Route::get('/inventario_cene/{parametro}', [CeneController::class,'view'])->name('inventario_cene')->middleware('admin');

Route::get('/acquisti/ajax-autocomplete-search', [Select2SearchController::class,'selectSearch'])->middleware('admin');

Route::get('/view_acq_prod', [AcquistiController::class,'view_acq_prod'])->name('view_acq_prod')->middleware('admin');

Route::get('/inventario_acquisti/view_acq_soci', [AcquistiController::class, 'view_acq_soci'])->name('inventario_acquisti/view_acq_soci')->middleware('admin');
Route::get('/inventario_acquisti/view_acq_soci/cancella/{acquisto}', [AcquistiController::class, 'delete_acquisto'])->name('deleteacq')->middleware('admin');
Route::get('/inventario_acquisti/view_acq_giorno/cancella/{acquisto}', [AcquistiController::class, 'delete_acquisto'])->name('deleteacq')->middleware('admin');
Route::get('/inventario_acquisti/delete_acquisti', [AcquistiController::class, 'delete_all_acquisti'])->name('deletetotacq')->middleware('admin');

Route::post('/inventario_acquisti/view_acq_prod', [AcquistiController::class, 'view_acq_prod'])->name('inventario_acquisti/view_acq_prod')->middleware('admin');

Route::post('/inventario_acquisti/view_acq_soci', [AcquistiController::class, 'view_acq_soci'])->name('inventario_acquisti/view_acq_soci')->middleware('admin');

Route::post('/inventario_utenti/change_password', [UtentiController::class, 'cambiaPassword'])->name('change_password')->middleware('admin');
Route::post('/inventario_utenti/registration_user', [UtentiController::class, 'registrazione'])->name('registration_user')->middleware('admin');

Route::post('/inventario_ricariche/view_crediti', [RicaricheController::class,'view_crediti'])->name('view_crediti')->middleware('admin');
Route::post('/inventario_ricariche/view_ric_giorno', [RicaricheController::class,'view_ric_giorno'])->name('view_ric_giorno')->middleware('admin');
Route::post('/inventario_ricariche/view_ric_tot', [RicaricheController::class,'view_ric_tot'])->name('view_ric_tot')->middleware('admin');
Route::post('/inventario_ricariche/view_ric_data', [RicaricheController::class,'view_ric_data'])->name('view_ric_data')->middleware('admin');
Route::post('/inventario_ricariche/view_ric_tessera', [RicaricheController::class,'view_ric_tessera'])->name('view_ric_tessera')->middleware('admin');
Route::post('/inventario_ricariche/view_ric_tessera_data', [RicaricheController::class,'view_ric_tessera_data'])->name('view_ric_tessera_data')->middleware('admin');
Route::get('/inventario_ricariche/view_ric_tot/cancella/{ricarica}',[RicaricheController::class,'delete_ricarica'])->name('deleteric')->middleware('admin');
Route::get('/inventario_ricariche/view_ric_giorno/cancella/{ricarica}',[RicaricheController::class,'delete_ricarica'])->name('deleteric')->middleware('admin');
Route::get('/inventario_ricariche/view_ric_data/cancella/{ricarica}',[RicaricheController::class,'delete_ricarica'])->name('deleteric')->middleware('admin');
Route::get('/inventario_ricariche/view_ric_tessera/cancella/{ricarica}',[RicaricheController::class,'delete_ricarica'])->name('deleteric')->middleware('admin');
Route::get('/inventario_ricariche/view_ric_tessera_data/cancella/{ricarica}',[RicaricheController::class,'delete_ricarica'])->name('deleteric')->middleware('admin');
Route::post('/inventario_ricariche/delete_all_ricariche', [RicaricheController::class,'delete_all_ricariche'])->name('delete_all_ricariche')->middleware('admin');

Route::post('/inventario_tessere/insert_tessera', [TessereController::class,'insert_tessera'])->name('insert_tessera')->middleware('admin');
Route::post('/inventario_tessere/view_tessere', [TessereController::class,'view_tessere'])->name('view_tessere')->middleware('admin');
Route::post('/inventario_tessere/delete_tessera', [TessereController::class,'delete_tessera'])->name('delete_tessera')->middleware('admin');
Route::post('/inventario_tessere/delete_all_tessere', [TessereController::class,'delete_all_tessere'])->name('delete_all_tessere')->middleware('admin');
Route::post('/inventario_tessere/reset_crediti', [TessereController::class,'reset_crediti'])->name('reset_crediti')->middleware('admin');
Route::post('/inventario_soci/insert_socio', [SociController::class,'insert_socio'])->name('insert_socio')->middleware('admin');
Route::post('/inventario_soci/delete_socio', [SociController::class,'delete_socio'])->name('delete_socio')->middleware('admin');
Route::post('/inventario_soci/delete_all_soci', [SociController::class,'delete_all_soci'])->name('delete_all_soci')->middleware('admin');
Route::post('/inventario_soci/view_soci', [SociController::class,'view_soci'])->name('view_soci')->middleware('admin');
Route::post('/inventario_soci/view_tessere_socio', [SociController::class,'view_tessere_socio'])->name('inventario_soci/view_tessere_socio')->middleware('admin');
Route::post('/inventario_soci/view_acq_socio_data', [SociController::class,'view_acq_socio_data'])->name('inventario_soci/view_acq_socio_data')->middleware('admin');
Route::post('/inventario_prodotti/insert_prodotto', [ProdottiController::class,'insert_prodotto'])->name('insert_prodotto')->middleware('admin');
Route::post('/inventario_prodotti/update_rif_prodotto', [ProdottiController::class,'update_rif_prodotto'])->name('update_rif_prodotto')->middleware('admin');
Route::post('/inventario_prodotti/view_prod_categoria', [ProdottiController::class,'view_prod_categoria'])->name('view_prod_categoria')->middleware('admin');
Route::get('/inventario_prodotti/delete_prodotto/{prodotto}', [ProdottiController::class,'delete_prodotto'])->name('delete_prodotto')->middleware('admin');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/ajax', [AjaxController::class, 'ajax'])->name('ajax');

Route::post('/get_products_by_cat', [Select2SearchController::class, 'get_products_by_cat'])->name('get_products_by_cat');

Route::post('/getProductsCategory', [AcquistiController::class, 'getProductsCategory'])->name('getProductsCategory');

Route::post('/scontrino', [ScontrinoController::class, 'scontrino'])->name('scontrino');

Route::get('/stampa_scontrino_acquisto', function () {return view('stampa_scontrino_acquisto');});
Route::get('/stampa_scontrino_ricarica', function () {return view('stampa_scontrino_ricarica');});

Route::get('/ricarica', function () {return view('ricarica');})->name('ricarica')->middleware('admin');

Route::post('/ricarica_effettuata', [RicaricaController::class, 'crea_ricarica'])->name('ricarica_effettuata');

Route::post('/dati_ricarica', [RicaricaController::class, 'getdati'])->name('dati_ricarica');

Route::get('stampa_table', [AcquistiController::class, 'stampa_table'])->name('stampa_table');
