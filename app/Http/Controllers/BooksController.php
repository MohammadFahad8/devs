<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Traits\Authorize;
use App\Jobs\ProcessBooks;
use Illuminate\Http\Request;
use App\Constants\StringConstants;
use App\Http\Requests\BooksRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
// use Illuminate\Http\Request;

class BooksController extends Controller
{
    use Authorize;

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
        return view('books.create',[
            'book'=>1
        ]);
    }

    public function edit($id)
    {
        Authorize::authorizeUser($id);
             return view('books.edit',[
            'book'=>Books::find($id)
        ]);


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
