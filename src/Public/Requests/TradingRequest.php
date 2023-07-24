<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Public\Client;
use Kwarcek\ZondacryptoRestApiPhp\Public\Enums\Resolution;
use Kwarcek\ZondacryptoRestApiPhp\Public\Exceptions\ClientException;

class TradingRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    /**
     * @return array
     * @throws ClientException
     */
    public function getTicker(): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/ticker"));
    }

    /**
     * @param string $tradingPair
     * @return array
     * @throws ClientException
     */
    public function getPairTicker(string $tradingPair): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/ticker/$tradingPair"));
    }

    /**
     * @return array
     * @throws ClientException
     */
    public function getStats(): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/stats"));
    }

    /**
     * @param string $tradingPair
     * @return array
     * @throws ClientException
     */
    public function getPairStats(string $tradingPair): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/stats/$tradingPair"));
    }

    /**
     * @param string $tradingPair
     * @return array
     * @throws ClientException
     */
    public function getOrderbook(string $tradingPair): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/orderbook/$tradingPair"));
    }

    /**
     * @param string $tradingPair
     * @param int $limit
     * @return array
     * @throws ClientException
     */
    public function getOrderbookLimited(string $tradingPair, int $limit = 10): array
    {
        return $this->parseResponseToArray($this->client->get("rest/trading/orderbook-limited/$tradingPair/$limit"));
    }

    /**
     * @param string $tradingPair
     * @param int $limit
     * @param string $sort
     * @param int|null $fromTime
     * @return array
     * @throws ClientException
     */
    public function getLastTransaction(
        string $tradingPair,
        int    $limit = 10,
        string $sort = 'desc',
        int    $fromTime = null
    ): array
    {
        return $this->parseResponseToArray(
            $this->client->get("rest/trading/transactions/$tradingPair?limit=$limit&sort=$sort&fromTime=$fromTime")
        );
    }

    /**
     * @param string $tradingPair
     * @param Resolution $resolution
     * @param int $fromTimestamp
     * @param int $toTimestamp
     * @return array
     * @throws ClientException
     */
    public function getCandleHistory(
        string     $tradingPair,
        Resolution $resolution,
        int        $fromTimestamp,
        int        $toTimestamp
    ): array
    {
        return $this->parseResponseToArray(
            $this->client->get("rest/trading/candle/history/$tradingPair/$resolution->value?from=$fromTimestamp&to=$toTimestamp")
        );
    }
}