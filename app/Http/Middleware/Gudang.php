<?php

namespace App\Http\Middleware;

use Closure;

class Gudang
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
        if (session()->get("level") == "gudang") {
          return $next($request);
        }
        return back()->withErrors(["msg"=>"Akses Ditolak"]);
      }else {
        if (session()->get("level") == "gudang") {
          return $next($request);
        }
        return response()->json(["msg"=>"Akses Ditolak"]);
      }
    }
}
