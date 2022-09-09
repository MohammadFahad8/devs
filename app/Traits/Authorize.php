<?php
namespace App\Traits;

use App\Models\Books;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait Authorize
{
    public static function authorizeUser($verify)
    {
        if (!Auth::user()->can('view', Books::find($verify))) {
            Session::flash('error', 'Unauthorized Personale');
            redirect('bookme')->send();
        }
    }
}
