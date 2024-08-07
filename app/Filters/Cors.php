<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        // Check for OPTIONS request (preflight request)
        if ($request->getMethod() === 'options') {
            $response = service('response');
            $response->setStatusCode(200)
                     ->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
                     ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                     ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                     ->setHeader('Access-Control-Max-Age', '86400');
            return $response;
        }

        // For all other requests, set CORS headers
        $response = service('response');
        $response->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
                 ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                 ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Optionally, add more headers here if needed
    }
}
