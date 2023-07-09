<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Private;

class AuthCredentials
{
    public function __construct(
        public readonly string $publicKey,
        public readonly string $privateKey
    )
    {
    }
}