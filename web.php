<?php

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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('institucional.index');
});
Route::post('/register', 'RegisterController@create');
Route::get('/registro', function (){
    return view('auth.register');
});
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/tag/{id}', 'TagController@pessoaTag');
Route::get('/tagPet/{id}', 'TagController@petTag');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/pessoas', 'AcheiPessoasController@index');

    Route::post('/fragmentoprotegido', 'AcheiPessoasController@cadastroInicial');
    Route::get('pessoas/form/{id}/edit', 'AcheiPessoasController@show');
    Route::put('/editar', 'AcheiPessoasController@editar');
    Route::delete('pessoa/protegido/{id}', 'AcheiPessoasController@apagar');

//rotas do contato
    Route::post('pessoas/form/{id}/contato', 'ContatoController@store');
    Route::post('/pessoas/form/{id}/contatoDelete', 'ContatoController@destroy');
    Route::post('/pessoas/form/{id_protegido}/contato/update', 'ContatoController@update');

//rotas do pdf falta terminar a contrução do pessoa do pdf
    Route::get('pdf/{id}', 'AcheiPessoasController@gerarPdf');
//construção da pagiana estatica
    Route::get('pessoa/{id}', 'AcheiPessoasController@paginaPessoa');
//usado para imprimir o qrcode direto do site
    Route::get('imprimir/{id}', 'AcheiPessoasController@imprimir');

//rotas da tag para pessoas

    Route::post('/adicionaTag', 'TagController@salvar');
    Route::post('/excluirTag', 'TagController@excluir');
    Route::get('/gerartags', function () {
        return view('tags.gerartags');
    });
    Route::post('/gerartagsnovas', 'TagController@novasTags');

//rotas da tag pet
    Route::get('/pet', 'PetController@index');
    Route::post('/fragmentoprotegidopet', 'PetController@cadastroInicial');
    Route::get('pet/form/{id}/edit', 'PetController@show');
    Route::put('/editarpet', 'PetController@editar');
    Route::delete('pet/protegido/{id}', 'PetController@destroy');

//rotas do contato pet
    Route::post('pet/form/{id}/contato', 'ContatoController@store');
    Route::post('/pet/form/{id}/contatoDelete', 'ContatoController@destroy');
    Route::post('/pet/form/{id_protegido}/contato/update', 'ContatoController@update');

    Route::get('imprimirpet/{id}', 'PetController@imprimir');
    Route::get('pet/{id}', 'PetController@paginaPet');
//tags AcheiPet
    Route::post('/adicionaTagPet', 'TagController@salvarPet');
    Route::post('/excluirTagPet', 'TagController@excluirPet');
    Route::get('/gerartagspet', function () {
        return view('tags.gerartagspets');
    });
    Route::post('/gerartagsnovaspet', 'TagController@novasTagsPet');


});
