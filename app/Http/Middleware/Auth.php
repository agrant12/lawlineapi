<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\User;

class Auth
{
     public function __construct(Request $request, User $user)
    {
        //
        $this->request = $request;
        $this->user = $user;
    }

    public function handle(Request $request, Closure $next)
    {
        $key = $this->request->key;

        if (!isset($key)) {
            return 'No Authorization';
        }

        $user = $this->user->where('key', $key)->first();

        if (!isset($user)) {
            return 'User not authorized';
        }
        
        
        return $next($request);
    }
}
