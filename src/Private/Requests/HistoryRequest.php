<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Psr\Http\Message\ResponseInterface;

class HistoryRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    public function getTransactions(): ResponseInterface
    {
        return $this->client->get("rest/trading/history/transactions");
    }

    public function getOperations(): ResponseInterface
    {
        return $this->client->get("rest/balances/BITBAY/history");
    }
}