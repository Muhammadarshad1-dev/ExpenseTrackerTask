<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('student.login');
    }

    public function authenticate($request, array $guards)
    {
            if (Auth::guard('student')->check()) {
                return $this->auth->shouldUse('student');
            }

            $this->unauthenticated($request, ['student']);
    }
}
