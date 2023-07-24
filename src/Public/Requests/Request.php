<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public\Requests;

use Psr\Http\Message\ResponseInterface;

abstract class Request
{
    protected function parseResponseToArray(ResponseInterface $response): array
    {
        return [
            'code' => $response->getStatusCode(),
            'data' => json_decode($response->getBody()->getContents(), true)
        ];
    }
}