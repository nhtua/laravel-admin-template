<?php

namespace App\Http\Middleware;

use App\Http\Middleware\VerifyCsrfToken;

class CsrfForGet extends VerifyCsrfToken
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    /**
     * Determine if the HTTP request uses a ‘read’ verb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading($request)
    {
        return in_array($request->method(), ['HEAD', 'OPTIONS']);
    }
}
