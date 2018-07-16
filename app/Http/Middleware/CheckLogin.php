<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = session('logined') and session('unit_id');

        if ($auth or $request->path() == 'portal') {
            return $next($request);
        } else {
            return redirect()->to('https://teos.tyc.edu.tw');
        }
    }
}
