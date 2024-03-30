<?php

namespace App\Http\Middleware;

use Flasher\Laravel\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    //  22:53 video 45
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if ($request->is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            }
            elseif($request->is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            }
            elseif($request->is(app()->getLocale() . '/parent/dashboard')) {
                return route('selection');
            }
            else {
                return route('selection');
            }
        }
    }
}
