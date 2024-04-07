<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompressResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Compress the response content using gzip encoding
        $compressedContent = gzencode($response->getContent(), 9);
        
        // Set the Content-Encoding header to indicate gzip encoding
        $response->headers->set('Content-Encoding', 'gzip');
        
        // Set the Vary header to inform caches that the response varies based on the Accept-Encoding header
        $response->headers->set('Vary', 'Accept-Encoding');
        
        // Set the response content to the compressed content
        $response->setContent($compressedContent);
        
        return $response;
    }
}
