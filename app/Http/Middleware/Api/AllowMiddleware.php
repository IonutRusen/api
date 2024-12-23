<?php

declare(strict_types=1);

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class AllowMiddleware
{
    public function handle(Request $request, Closure $next, string ...$methods): Response
    {
        /** @var Response $response */

        $response = $next($request);

        $response->headers->set(
            key: 'Allow',
            values: implode(
                separator: ',',
                array: $methods,
            ),
        );

        return $response;
    }
}
