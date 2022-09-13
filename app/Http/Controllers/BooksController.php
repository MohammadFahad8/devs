<?php

namespace App\Http\Controllers;

use Cache;
use App\Models\Books;
use App\Traits\Authorize;
use App\Jobs\ProcessBooks;
use Illuminate\Http\Request;
use App\Contracts\BookContract as BookContract;
use App\Constants\StringConstants;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BooksRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
// use Illuminate\Http\Request;

class BooksController extends Controller
{
    use Authorize;

    public function __construct(BookContract $book_contract)
    {
        $this->post = $book_contract;

    }
    public function index()
    {
        //skinny controller example
        #dd(Strings::Constants::WELCOME)using from Constants/StringConstants
        #dd(__('mystrings.fahad')); using from lang file
        return view('books.index',[
            'books' => Books::fatModel(),
        ]);
    }

    public function create()
    {
        $storage = Redis::connection();
        return view('books.create',[
            'book'=>1
        ]);
    }

    public function edit($id)
    {
        dd(Auth::user()->id);
        Authorize::authorizeUser($id);
        var_dump($this->fetchById($id));
             return view('books.edit',[
            'book'=>Books::find($id)
        ]);


    }
    public function show($id)
    {
        DB::connection()->enableQueryLog();
        $books = $this->post->fetchAll();
        $log= DB::getQueryLog();
            print_r($log);
    }

    public function store(BooksRequest $request)
    {
        // $this->authorize('store',Books::class); GATES APPROACH
        $user = Auth::user();

    if ($user->can('create', Books::class)) {
      echo 'Current logged in user is allowed to create new posts.';
    } else {
      echo 'Not Authorized';
    }
        // $validated = $request->validated();
        Books::create($request->validated());
        return view('books.create');
    }

    public function search(Request $request)
    {
        $results = Books::search($request->input('query'))->get();
        return view('books.subviews.search',[
            'searchResults' => $results
        ]);
    }
}
