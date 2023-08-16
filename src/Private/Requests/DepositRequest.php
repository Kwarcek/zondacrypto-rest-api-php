<?php

declare(strict_types=1);

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Psr\Http\Message\ResponseInterface;

class DepositRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    public function create(
        string $walletId = null,
        string $currency = null
    ): ResponseInterface
    {
        return $this->client->get("api_payments/deposits/crypto/addresses" . http_build_query([
                'balanceId' => $walletId,
                'currency' => $currency,
            ]));
    }
}