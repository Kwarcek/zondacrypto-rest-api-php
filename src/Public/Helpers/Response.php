<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public\Helpers;

use Psr\Http\Message\ResponseInterface;

class Response
{
    public static function toArray(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}