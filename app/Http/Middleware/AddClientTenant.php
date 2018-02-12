<?php

namespace CodeFin\Http\Middleware;

use Closure;

class AddClientTenant
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
        if ($request->is('api/*')) {
            $user = \Auth::guard('api')->user();

            if ($user) {
                $client = $user->client;
                //var_dump($client->id);exit;
                \Landlord::addTenant($client);
            }
        }
        return $next($request);
    }
}
