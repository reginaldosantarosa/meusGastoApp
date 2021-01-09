<?php

use App\Http\Livewire\Despesa\{
    DespesaCreate,
    DespesaEdit,
    DespesaList,
};
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    Route::prefix('despesas')->name('despesas.')->group(function(){
        Route::get('/',DespesaList::class)->name('index');
        Route::get('/create',DespesaCreate::class)->name('create');
        Route::get('/edit/{despesa}',DespesaEdit::class)->name('edit');
    });

});
