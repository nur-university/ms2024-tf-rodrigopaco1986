<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateTokenMiddleware
{
    /**
     * Handle an incoming request to validate a token in the headers.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (! $this->isValidToken($token)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'Invalid or missing token.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    /**
     * Check if the provided token is valid.
     */
    private function isValidToken(?string $token): bool
    {
        $validToken = config('app.api_token');

        $cleanedToken = str_starts_with($token, 'Bearer ')
            ? substr($token, 7)
            : $token;

        return $cleanedToken === $validToken;
    }
}
