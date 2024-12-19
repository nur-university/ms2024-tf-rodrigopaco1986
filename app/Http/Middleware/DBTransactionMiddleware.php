<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DBTransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get method for queries
        if ($request->isMethod('get')) {
            return $next($request);
        }

        // Other methods for transactions
        DB::beginTransaction();
        try {
            $response = $next($request);
            if ($response->getStatusCode() >= 400) {
                DB::rollBack();
            } else {
                DB::commit();
            }

            return $response;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
