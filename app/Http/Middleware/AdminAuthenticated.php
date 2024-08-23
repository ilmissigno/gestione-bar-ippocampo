<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated{

    public function handle(Request $request, Closure $next){
        if(Auth::check())
            return $next($request);
        return redirect('/')->withErrors(['msg'=>'Controllare username e/o password.']);
    }

}

?>
