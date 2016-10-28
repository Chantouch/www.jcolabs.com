<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckEmployer
{
    public function handle($request, Closure $next)
    {
        if (!empty(auth()->guard('employer')->id())) {
            $data = DB::table('employers')
                ->select('employers.id')
                ->where('employers.id', auth()->guard('employer')->id())
                ->get();

            if (!$data[0]->id) {
                return redirect()->intended('employer/login/')->with('status', 'You do not have access to user admin side');
            }
            return $next($request);
        } else {
            return redirect()->intended('employer/login/')->with('status', 'Please Login to access user admin area');
        }
    }
}
