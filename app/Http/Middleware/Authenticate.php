<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards, $this->redirectTo($request, $guards)
        );
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param array Guards
     * @return string|null
     */
    protected function redirectTo($request, array $guards = [])
    {
        if (! $request->expectsJson()) {

            foreach ($guards as $guard) {
                if ($guard === 'account') {
                    return route('account.login');
                }
                if ($guard === 'admin') {
                    return route('admin.login');
                }
            }
        }

        return url('/');
    }
}
