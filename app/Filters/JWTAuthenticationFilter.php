<?php

namespace App\Filters;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Exception;

class JWTAuthenticationFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        //log_message('error', 'vibhroe'.$request->getMethod());
        if ($request->getMethod() === 'OPTIONS') {
            $response = service('response');
            $response->setStatusCode(ResponseInterface::HTTP_OK)
                     ->setHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
                     ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                     ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
                     ->setHeader('Access-Control-Max-Age', '86400');
            return $response;
        }

        $authenticationHeader = $request->getServer('HTTP_AUTHORIZATION');
        
        try {

            helper('jwt');
            $encodedToken = getJWTFromRequest($authenticationHeader);
            validateJWTFromRequest($encodedToken);
            return $request;

        } catch (Exception $e) {

            return Services::response()
                ->setJSON(
                    [
                        'error' => $e->getMessage()
                    ]
                    )
                ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);

        }
    }

    public function after(RequestInterface $request,
                          ResponseInterface $response,
                          $arguments = null)
    {
    }
}