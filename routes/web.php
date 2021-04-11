<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\AcademicoController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\PlaneacionController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('alumnos', AlumnoController::class)
    ->middleware(['auth:sanctum', 'verified']);
Route::resource('academicos', AcademicoController::class)
->middleware(['auth:sanctum', 'verified']);
Route::resource('asignaturas', AsignaturaController::class)
->middleware(['auth:sanctum', 'verified']);
Route::resource('grupos', GrupoController::class)
->middleware(['auth:sanctum', 'verified']);
Route::resource('planeaciones', PlaneacionController::class)
->middleware(['auth:sanctum', 'verified']);
