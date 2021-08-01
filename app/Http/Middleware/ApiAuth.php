<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($request->all());
        if($request->has('api_token')){
            $token = $request->api_token;
            if(!User::where('api_token',$token)->where('api_token','!=',null)->first()){
                return response()->json(['unauthenticated'],'401');
            }
            return $next($request);
        }
        return response()->json(['unauthinticated'],'401');
    }
}
