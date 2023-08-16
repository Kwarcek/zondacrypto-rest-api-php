<?php

declare(strict_types=1);

namespace Kwarcek\ZondacryptoRestApiPhp\Private\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Private\Client;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OfferType;
use Kwarcek\ZondacryptoRestApiPhp\Private\Enums\OrderMode;
use Psr\Http\Message\ResponseInterface;

class TradingStopRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    public function createOrder(
        string $marketCode,
        OfferType $offerType,
        float  $amount,
        float  $stopRate,
        OrderMode $mode,
        float $rate = null,
        array $balances = null,
        bool $ignoreInvalidStopRate = false
    ): ResponseInterface
    {
        return $this->client->post("trading/stop/offer/$marketCode", [
            'amount' => $amount,
            'rate' => $rate,
            'stopRate' => $stopRate,
            'balances' => $balances,
            'offerType' => $offerType->value,
            'mode' => $mode->value,
            'ignoreInvalidStopRate' => $ignoreInvalidStopRate,
        ]);
    }

    public function getActiveOrders(?string $marketCode = null): ResponseInterface
    {
        $uri = 'trading/stop/offer';

        if($marketCode !== null) {
            $uri = "$uri/$marketCode";
        }

        return $this->client->get($uri);
    }

    public function deleteOrder(string $marketCode, int $offerId): ResponseInterface
    {
        return $this->client->delete("trading/stop/offer/$marketCode/$offerId");
    }
}