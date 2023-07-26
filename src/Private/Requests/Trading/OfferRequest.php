<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests\Trading;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OfferType;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OrderMode;
use Kwarcek\ZondacryptoRestApiPhp\Private\Requests\Request;
use Psr\Http\Message\ResponseInterface;

class OfferRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    public function create(
        string $tradingPair,
        float  $amount,
        float  $rate,
        OfferType $offerType,
        OrderMode $mode,
        bool $postOnly,
        bool $fillOrKill,
        bool $immediateOrCancel,
        string $firstBalanceId,
        string $secondBalanceId,
    ): ResponseInterface
    {
        return $this->client->post("trading/offer/$tradingPair", [
            'amount' => $amount,
            'rate' => $rate,
            'offerType' => $offerType->value,
            'mode' => $mode->value,
        ]);
    }

    public function getActive(string $tradingPair): ResponseInterface
    {
        return $this->client->get("trading/offer/$tradingPair");
    }

    public function delete(
        string $tradingPair,
        string $offerId,
        string $offerType,
        float $price,
    ): ResponseInterface
    {
        return $this->client->delete("trading/offer/$tradingPair/$offerId/$offerType/$price");
    }

    public function getFeeAndMarketConfiguration(string $tradingPair): ResponseInterface
    {
        return $this->client->get("rest/trading/config/$tradingPair");
    }

    public function updateFeeAndMarketConfiguration(
        string $tradingPair,
        string $first,
        string $second
    ): ResponseInterface
    {
        return $this->client->post("rest/trading/config/$tradingPair", [
            'first' => $first,
            'second' => $second
        ]);
    }
}