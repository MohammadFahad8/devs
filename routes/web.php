<?php

use App\Http\Controllers\BirdsController;
use App\Http\Middleware\BooksProcessing;
use App\Models\Books;
use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Auth;

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
    $client = ClientBuilder::create()->build();
    var_dump($client);
});

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get("/bookme/search",[App\Http\Controllers\BooksController::class,'search'])->name('bookme.search');
Route::resource('bookme',App\Http\Controllers\BooksController::class)->middleware(['auth']);
Route::get('/birds-list',[BirdsController::class,'retrieve']);
Route::resource('birds',BirdsController::class);
// Route::resource('bookme',App\Http\Controllers\BooksController::class)->middleware([BooksProcessing::class, 'auth']);
