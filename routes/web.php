<?php

use App\Http\Livewire\Despesa\{
    DespesaCreate,
    DespesaEdit,
    DespesaList
};

use App\Http\Livewire\Plano\{
    PlanoCreate,
    PlanoList,
};

use App\Http\Livewire\Pagamento\{
    CrediCard,

};

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades;
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
        Route::get('/{despesa}/foto', function ($despesa){
               $despesa = auth()->user()->despesas()->findOrFail($despesa);

                if(! Storage::disk('public')->exists($despesa->foto)){
                    return abort('404','Imagem nao existe');
                }

              $imagem=Storage::disk('public')->get($despesa->foto);
               $mimeType = File::mimeType(storage_path('app/public/' . $despesa->foto));

                return response($imagem)->header('Content-Type',$mimeType);
           })
            ->name('foto');
    });

    Route::prefix('planos')->name('planos.')->group(function(){
        Route::get('/',PlanoList::class)->name('index');
        Route::get('/create',PlanoCreate::class)->name('create');
    });
});

Route::get('/inscricao',CrediCard::class)->name('plano.inscricao');
