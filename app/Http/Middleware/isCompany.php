<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomForbiddenException;
use Closure;
use Illuminate\Http\Request;

class isCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->roles->name !== 'Company') {
            throw new CustomForbiddenException();
        }
        return $next($request);
    }
}
