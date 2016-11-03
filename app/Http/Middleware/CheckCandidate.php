<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckCandidate
{
    public function handle($request, Closure $next)
    {
        if (!empty(auth()->guard('candidate')->id())) {
            $data = DB::table('candidates')
                ->select('candidates.id')
                ->where('candidates.id', auth()->guard('candidate')->id())
                ->get();

            if (!$data[0]->id) {
                return redirect()->intended('candidate/login/')->with('status', 'You do not have access to user admin side');
            }
            return $next($request);
        } else {
            return redirect()->intended('candidate/login/')->with('status', 'Please Login to access user admin area');
        }
    }
}
