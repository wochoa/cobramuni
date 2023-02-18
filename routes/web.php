<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvokerController;
use App\Http\Controllers\Tramites\TramitesController;
use App\Http\Controllers\Administrador\DepedendenciaController;
use App\Http\Controllers\Administrador\UserController;
use App\Http\Controllers\Tipodocumento\TipodocumentoController; 

// cobranzas
use App\Http\Controllers\FormatocobranzaController;
use App\Http\Controllers\ConceptocobranzaController;
use App\Http\Controllers\CobranzasController;
use App\Http\Controllers\Resumen;
use App\Http\Controllers\ClasificadorController;
use App\Http\Controllers\HomeController;//ClasificadorController
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('firmados/{file}', function ($file) {

	$rutaDeArchivo = Storage::path('firmados/'.$file);
	$headers = array(
		'Content-Type: application/pdf',
	  );
	return response()->file($rutaDeArchivo,$headers);
    
});

Route::get('invoker/postArguments',[InvokerController::class, 'postArguments'])->name('invoker.postArguments');
Route::get('invoker/upload',[InvokerController::class, 'upload'])->name('invoker.upload');
Route::get('invoker/getArguments',[InvokerController::class, 'getArguments'])->name('invoker.getArguments');
Route::get('invoker/getFile',[InvokerController::class, 'getFile'])->name('invoker.getFile');
Route::get('documento/printR/{idFile}/{idDocumento}',[InvokerController::class, 'printPdfR'])->name('invoker.printPdfRefirma');

route::get('/alldependencia',[DepedendenciaController::class, 'alldependencia'])->name('alldependencia');
route::get('/listardepe',[DepedendenciaController::class, 'index'])->name('dependencias');
route::get('/oficinas/{coddepe}',[DepedendenciaController::class, 'oficinas'])->name('oficinas');///api/oficinas/unidad/
route::get('/oficinas/unidad/{coddepe}',[DepedendenciaController::class, 'unidad'])->name('unidad');
route::get('/oficinas/nombredepe/{coddepe}',[DepedendenciaController::class, 'nombredepe'])->name('nombredepe');

route::get('/listauser',[UserController::class, 'index'])->name('usuarios');// todo los usuarios para paginacion
route::get('/alluser',[UserController::class, 'alluser'])->name('alluser');// todo los usuarios sin paginacion
route::get('/listauser/{id}',[UserController::class, 'buscar'])->name('buscarusuarios');
route::get('/nombreuser/{id}',[UserController::class, 'nombreuser'])->name('nombreuser');
route::get('/listauserdepe/{id}',[UserController::class, 'listauserdepe'])->name('listauserdepe');
route::get('/representante/{id}',[UserController::class, 'representante'])->name('representante');
route::get('/detalleuserderivacion/{id}',[UserController::class, 'detalleuserderivacion'])->name('detalleuserderivacion');
route::get('/usuariosunidad',[UserController::class, 'usuariosunidad'])->name('usuariosunidad');//lista user segun el id del user loeagdo

route::get('/exportaword',[TramitesController::class, 'exportaword'])->name('exportaword');
route::get('/buscaregdoc/{id?}',[TramitesController::class, 'buscaregdoc'])->name('buscaregdoc');


route::post('/generacionnuevotramite',[TramitesController::class, 'generacionnuevotramite'])->name('generacionnuevotramite');

route::get('/buscatipodocumento/{id}/{tipotram}', [TipodocumentoController::class, 'buscatipodocumento'])->name('buscatipodocumento');
Route::get('tipodocumento', [TipodocumentoController::class, 'index'])->name('lista');
route::get('consulta_user/{tipotram}/{seldoc}/{id}',[TramitesController::class, 'consulta_user'])->name('consulta_user');
route::get('tramite/documentoenproceso',[TramitesController::class, 'documentoenproceso'])->name('documentoenproceso'); 
route::get('tramite/porRecibir',[TramitesController::class, 'porRecibir'])->name('porRecibir');
route::get('tramite/archivados',[TramitesController::class, 'archivados'])->name('archivados');
route::get('tramite/obtenerTotal',[TramitesController::class, 'obtenerTotal'])->name('obtenerTotal');



// fromato cobranza
route::get('listaformatos',[FormatocobranzaController::class, 'index'])->name('listaformatos');//listaformatos
route::get('listaformatos/{id}',[FormatocobranzaController::class, 'buscar'])->name('buscar');
route::post('nuevoformato',[FormatocobranzaController::class, 'nuevoformato'])->name('nuevoformato');

//concepto
route::get('conceptocobranzas',[ConceptocobranzaController::class, 'index'])->name('conceptocobranzas');
route::get('conceptocobranzas/{id}',[ConceptocobranzaController::class, 'busqueda'])->name('busqueda');
route::post('nuevoconcepto',[ConceptocobranzaController::class, 'nuevoconcepto'])->name('nuevoconcepto');
route::post('updateconcepto',[ConceptocobranzaController::class, 'update'])->name('updateconcepto');

// clasificador
route::get('clasificador',[ClasificadorController::class, 'index'])->name('clasificador');
route::post('nuevoclasificador',[ClasificadorController::class, 'nuevoclasificador'])->name('nuevoclasificador');

// generar cobranza
route::get('/listacobranza',[CobranzasController::class, 'listacobranza'])->name('listacobranza');
route::post('generarcobranza',[CobranzasController::class, 'generarcobranza'])->name('generarcobranza');

//pide consultas
route::get('reniec/{dni}',[CobranzasController::class, 'reniec'])->name('reniec');
route::get('ruc/{rruc}',[CobranzasController::class, 'ruc'])->name('ruc');
// impresion cobranza
route::get('imprimecobranza/{id}',[CobranzasController::class, 'imprimecobranza'])->name('imprimecobranza');

route::get('/resumen',[Resumen::class, 'index'])->name('resumen');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{any?}', [HomeController::class, 'index'])->name('home')->where('any','.*');
