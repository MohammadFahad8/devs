<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BooksProcessing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($_SERVER['REQUEST_URI'] == '/bookme/create') {
            $data = $request->all();
            $tp = $data['title'] . $data['body'];
            $tp = array($data['title'], $data['body']);
            $data['title'] = join('-', $tp);
            return $next($request);
        } else {
            return redirect('/');
        }
    }

    public function terminate(Request $request, Response $response)
    {
        echo 'Do something after method';
    }
}
