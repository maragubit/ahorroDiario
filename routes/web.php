<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\IngresoFijoController;
use App\Http\Controllers\GastoFijoController;
use App\Http\Controllers\AhorroController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\ResumenController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[IndexController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*RUTAS INGRESOS FIJOS */
Route::get('/ingresosFijos',[IngresoFijoController::class,'list'])->name('ingresosFijos.list');
Route::get('/ingresosFijos/crear',[IngresoFijoController::class,'create'])->name('ingresosFijos.create');
Route::post('/ingresosFijos',[IngresoFijoController::class,'save'])->name('ingresosFijos.save');
Route::get('/ingresosFijos/editar/{ingreso}',[IngresoFijoController::class,'edit'])->name('ingresosFijos.edit');
Route::put('/ingresosFijos/actualizar/{ingreso}',[IngresoFijoController::class,'update'])->name('ingresosFijos.update');
Route::get('/ingresosFijos/borrar/{ingreso}',[IngresoFijoController::class,'delete'])->name('ingresosFijos.delete');

/*RUTAS GASTOS FIJOS */
Route::get('/gastosFijos',[GastoFijoController::class,'list'])->name('gastosFijos.list');
Route::get('/gastosFijos/crear',[GastoFijoController::class,'create'])->name('gastosFijos.create');
Route::post('/gastosFijos',[GastoFijoController::class,'save'])->name('gastosFijos.save');
Route::get('/gastosFijos/editar/{gasto}',[GastoFijoController::class,'edit'])->name('gastosFijos.edit');
Route::put('/gastosFijos/actualizar/{gasto}',[GastoFijoController::class,'update'])->name('gastosFijos.update');
Route::get('/gastosFijos/borrar/{gasto}',[GastoFijoController::class,'delete'])->name('gastosFijos.delete');

/*RUTAS AHORRO */
Route::get('/ahorro',[AhorroController::class,'index'])->name('ahorros.index');
Route::post('/ahorro/crear',[AhorroController::class,'save'])->name('ahorros.save');
Route::get('/ahorro/actualizar/{ahorro}',[AhorroController::class,'edit'])->name('ahorros.edit');
Route::get('/ahorro/borrar/{ahorro}',[AhorroController::class,'delete'])->name('ahorros.delete');

/*RUTAS INGRESOS */
Route::get('/ingresos/crear',[IngresoController::class,'create'])->name('ingresos.create');
Route::post('/ingresos/crear',[IngresoController::class,'save'])->name('ingresos.save');
Route::get('/ingresos/list',[IngresoController::class,'list'])->name('ingresos.list');
Route::post('/ingresos/listFilter',[IngresoController::class,'listFilter'])->name('ingresos.listFilter');
Route::get('/ingresos/delete/{ingreso}',[IngresoController::class,'delete'])->name('ingresos.delete');
Route::get('/ingresos/editar/{ingreso}',[IngresoController::class,'edit'])->name('ingresos.edit');
Route::put('/ingresos/actualizar/{ingreso}',[IngresoController::class,'update'])->name('ingresos.update');

/*RUTAS GASTOS */
Route::get('/gastos/crear',[GastoController::class,'create'])->name('gastos.create');
Route::post('/gastos/crear',[GastoController::class,'save'])->name('gastos.save');
Route::get('/gastos/list',[GastoController::class,'list'])->name('gastos.list');
Route::post('/gastos/listFilter',[GastoController::class,'listFilter'])->name('gastos.listFilter');
Route::get('/gastos/delete/{gasto}',[GastoController::class,'delete'])->name('gastos.delete');
Route::get('/gastos/editar/{gasto}',[GastoController::class,'edit'])->name('gastos.edit');
Route::put('/gastos/actualizar/{gasto}',[GastoController::class,'update'])->name('gastos.update');

//RUTAS RESUMEN
Route::get('/resumen/list',[ResumenController::class,'list'])->name('resumen.list');
Route::post('/resumen/listFilter',[ResumenController::class,'listFilter'])->name('resumen.listFilter');

require __DIR__.'/auth.php';
