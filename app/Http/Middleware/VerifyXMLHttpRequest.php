<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class VerifyXMLHttpRequest
{
    public function handle(Request $request, Closure $next)
    {
        if (!in_array($request->method(), ['GET', 'HEAD'], true) && !$request->isXmlHttpRequest()) {
            throw new BadRequestHttpException('Missing X-Requested-With header.');
        }

        return $next($request);
    }
}


