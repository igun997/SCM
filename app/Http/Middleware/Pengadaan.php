<?php

namespace App\Http\Middleware;

use Closure;

class Pengadaan
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
      if (! $request->expectsJson()) {
        if (session()->get("level") == "pengadaan") {
          return $next($request);
        }
        return back()->withErrors(["msg"=>"Akses Ditolak"],500);
      }else {
        if (session()->get("level") == "pengadaan") {
          return $next($request);
        }
        return response()->json(["msg"=>"Akses Ditolak"],500);
      }
    }
}
