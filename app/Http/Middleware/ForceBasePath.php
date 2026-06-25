<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceBasePath
{
    public function handle(Request $request, Closure $next)
    {
        $request->server->set(
            'SCRIPT_NAME',
            '/avaliacao_fisica/index.php'
        );

        $request->server->set(
            'SCRIPT_FILENAME',
            public_path('index.php')
        );

        return $next($request);
    }
}
