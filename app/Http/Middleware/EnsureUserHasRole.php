<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role) {

        Log::debug("test :".$role);
        if ($request->user()->roles()->where('nom', $role)->exists())
            return $next($request);
        throw new HttpResponseException(response()->json(json_encode([
            'message' => "The user {$request->user()->name} can't
                access to this endpoint"]),RESPONSE::HTTP_FORBIDDEN));
    }
}
