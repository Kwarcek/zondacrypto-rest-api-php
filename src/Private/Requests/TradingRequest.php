<?php

declare(strict_types=1);

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OfferType;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OrderMode;
use Psr\Http\Message\ResponseInterface;

class TradingRequest extends Request
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
        float $price = null,
        bool $postOnly = false,
        bool $fillOrKill = false,
        bool $immediateOrCancel = false,
        string $firstBalanceId = null,
        string $secondBalanceId = null,
    ): ResponseInterface
    {
        return $this->client->post("trading/offer/$tradingPair", [
            'amount' => $amount,
            'rate' => $rate,
            'offerType' => $offerType->value,
            'mode' => $mode->value,
            'postOnly' => $postOnly,
            'fillOrKill' => $fillOrKill,
            'price' => $price,
            'immediateOrCancel' => $immediateOrCancel,
            'firstBalanceId' => $firstBalanceId,
            'secondBalanceId' => $secondBalanceId,
        ]);
    }

    public function getActive(string $tradingPair): ResponseInterface
    {
        return $this->client->get("trading/offer/$tradingPair");
    }

    public function delete(
        string $tradingPair,
        string $offerId,
        OfferType $offerType,
        float $price,
    ): ResponseInterface
    {
        return $this->client->delete("trading/offer/$tradingPair/$offerId/$offerType->value/$price");
    }

    public function getFeeAndMarketConfiguration(string $tradingPair): ResponseInterface
    {
        return $this->client->get("rest/trading/config/$tradingPair");
    }

    public function updateFeeAndMarketConfiguration(
        string $tradingPair,
        string $firstCurrencyWalletUuid,
        string $secondCurrencyWalletUuid
    ): ResponseInterface
    {
        return $this->client->post("rest/trading/config/$tradingPair", [
            'first' => $firstCurrencyWalletUuid,
            'second' => $secondCurrencyWalletUuid
        ]);
    }
}