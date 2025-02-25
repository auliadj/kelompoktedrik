<?php
namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;


class EnsureTokenIsValid
{
   public function handle(Request $request, Closure $next)
   {
       $token = $request->header('Authorization');


       if ($token !== 'your-secret-token') {
           return response()->json(['message' => 'Unauthorized'], 401);
       }


       return $next($request);
   }
}
