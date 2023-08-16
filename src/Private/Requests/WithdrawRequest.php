<?php

declare(strict_types=1);

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Psr\Http\Message\ResponseInterface;

class WithdrawRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    public function crypto(
        string $address,
        string $amount,
        string $currency,
        string $balanceId,
        string $tag
    ): ResponseInterface
    {
        return $this->client->post("api_payments/withdrawals/crypto", [

        ]);
    }

    public function fiat()
    {
        
    }
}