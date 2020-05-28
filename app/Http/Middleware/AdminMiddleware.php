<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // only /maker should be accessable all other should be 404
        if ( auth()->guest() && $this->isAForbiddenRoute($request) || auth()->check() && auth()->user()->cannotCreatePost() ) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * Routes names that anyone can access 
     * though, are kept open for ADMIN
     * only
     * 
     * @return array 
     */
    public function allowedRoutes() : array
    {
        return [
            'admin.login.view', 'admin.login'
        ];
    }

    /**
     * Only two routes are open for anyone to 
     * access though are open for ADMIN only
     * 
     * @param  Http\Request  $request 
     * @return boolean          
     */
    public function isAForbiddenRoute($request) : bool
    {
        return ! in_array($request->route()->getName(), $this->allowedRoutes());
    }

}