<?php

use App\Models\Books;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\BooksProcessing;
use Elastic\Elasticsearch\ClientBuilder;
use App\Http\Controllers\BirdsController;
use App\Http\Controllers\ZebrasController;

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
Route::get('/emb',function(){
     dd(env('APP_URL'));
});
Route::get('/', function () {
    $client = ClientBuilder::create()->build();
    var_dump($client);
});
Auth::routes();

Route::post("/add-to-book",[App\Http\Controllers\BooksController::class,'create'])->name('new-book');
Route::get('/map-data',function(){
    $client = ClientBuilder::create()->build();	//connect with the client
    $params = array();
    $books = Books::all();
    $books =  $books->toArray();
    foreach($books as $book) {
    $params['body']  = array(
      'name' => $book['title'], 											//preparing structred data
      'body' => $book['body']
    );
    $params['index'] = 'beyblade';
    $params['type']  = 'beyblade_owner';
    $result = $client->index($params);							//using Index() function to inject the data
    }});

    Route::get('find/{query}',function($query){
        $client = ClientBuilder::create()->build();		//connect to the client
        $params['index'] = 'beyblade';						// Preparing Indexed Data
        $params['type'] = 'beyblade_owner';
        $params['body']['query']['match']['body'] = $query;			//Find data in which age matches given input
        $result = $client->search($params);					//Using Search function
        return $result;	               					//Printing out result
        });

  Route::get("books-list",[App\Http\Controllers\BooksController::class,'index']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/bookme/search",[App\Http\Controllers\BooksController::class,'search'])->name('bookme.search');
Route::resource('bookme',App\Http\Controllers\BooksController::class)->middleware(['auth']);
Route::get('/birds-list',[BirdsController::class,'retrieve']);
Route::resource('birds',BirdsController::class);
// Route::resource('bookme',App\Http\Controllers\BooksController::class)->middleware([BooksProcessing::class, 'auth']);

Route::group([
    'prefix' => 'birds',
], function () {
    Route::get('/', [BirdsController::class, 'index'])
         ->name('birds.birds.index');
    Route::get('/create', [BirdsController::class, 'create'])
         ->name('birds.birds.create');
    Route::get('/show/{birds}',[BirdsController::class, 'show'])
         ->name('birds.birds.show')->where('id', '[0-9]+');
    Route::get('/{birds}/edit',[BirdsController::class, 'edit'])
         ->name('birds.birds.edit')->where('id', '[0-9]+');
    Route::post('/', [BirdsController::class, 'store'])
         ->name('birds.birds.store');
    Route::put('birds/{birds}', [BirdsController::class, 'update'])
         ->name('birds.birds.update')->where('id', '[0-9]+');
    Route::delete('/birds/{birds}',[BirdsController::class, 'destroy'])
         ->name('birds.birds.destroy')->where('id', '[0-9]+');
});

Route::group([
    'prefix' => 'zebras',
], function () {
    Route::get('/', [ZebrasController::class, 'index'])
         ->name('zebras.zebra.index');
    Route::get('/create', [ZebrasController::class, 'create'])
         ->name('zebras.zebra.create');
    Route::get('/show/{zebra}',[ZebrasController::class, 'show'])
         ->name('zebras.zebra.show')->where('id', '[0-9]+');
    Route::get('/{zebra}/edit',[ZebrasController::class, 'edit'])
         ->name('zebras.zebra.edit')->where('id', '[0-9]+');
    Route::post('/', [ZebrasController::class, 'store'])
         ->name('zebras.zebra.store');
    Route::put('zebra/{zebra}', [ZebrasController::class, 'update'])
         ->name('zebras.zebra.update')->where('id', '[0-9]+');
    Route::delete('/zebra/{zebra}',[ZebrasController::class, 'destroy'])
         ->name('zebras.zebra.destroy')->where('id', '[0-9]+');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/redis',function(){
     $redis_key = Redis::connection();
     $redis_key->set('key1423','welcome to redis');
     var_dump($redis_key->get('key1'));
});
