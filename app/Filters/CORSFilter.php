<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CORSFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // No actions needed before the request
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $origin = $request->getHeaderLine('Origin');

        $allowedOrigins = [
            'https://example.com', // Add your allowed domains here
            'https://anotherdomain.com'
        ];

        if (in_array($origin, $allowedOrigins)) {
            $response->setHeader('Access-Control-Allow-Origin', $origin);
            $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
            $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->setHeader('Access-Control-Allow-Credentials', 'true');
        }
    }
}
