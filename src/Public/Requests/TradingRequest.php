<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Public\Client;
use Psr\Http\Message\ResponseInterface;
use Kwarcek\ZondacryptoRestApiPhp\Public\Exceptions\ClientException;

/**
 *
 */
class TradingRequest extends Request
{
    public function __construct(protected Client $client)
    {
    }

    /**
     * @return ResponseInterface
     * @throws ClientException
     */
    public function ticker(): ResponseInterface
    {
        return $this->client->get("trading/ticker");
    }

    /**
     * @param string $tradingPair
     * @return ResponseInterface
     * @throws ClientException
     */
    public function pairTicker(string $tradingPair): ResponseInterface
    {
        return $this->client->get("trading/ticker/$tradingPair");
    }

    /**
     * @return ResponseInterface
     * @throws ClientException
     */
    public function stats(): ResponseInterface
    {
        return $this->client->get("trading/stats");
    }

    /**
     * @param string $tradingPair
     * @return ResponseInterface
     * @throws ClientException
     */
    public function pairStats(string $tradingPair): ResponseInterface
    {
        return $this->client->get("trading/stats/$tradingPair");
    }

    /**
     * @return ResponseInterface
     * @throws ClientException
     */
    public function orderbook(): ResponseInterface
    {
        return $this->client->get("trading/orderbook");
    }

    /**
     * @param string $tradingPair
     * @return ResponseInterface
     * @throws ClientException
     */
    public function pairOrderbook(string $tradingPair): ResponseInterface
    {
        return $this->client->get("trading/orderbook/$tradingPair");
    }

    /**
     * @param string $tradingPair
     * @param int $limit
     * @return ResponseInterface
     * @throws ClientException
     */
    public function orderbookLimited(string $tradingPair, int $limit = 10): ResponseInterface
    {
        return $this->client->get("trading/orderbook-limited/$tradingPair/$limit");
    }

    /**
     * @param string $tradingPair
     * @param int $limit
     * @param string $sort
     * @param int|null $fromTime
     * @return ResponseInterface
     * @throws ClientException
     */
    public function lastTransaction(
        string $tradingPair,
        int $limit = 10,
        string $sort = 'desc',
        int $fromTime = null
    ): ResponseInterface
    {
        return $this->client->get("trading/transactions/$tradingPair", [
            'limit' => $limit,
            'sort' => $sort,
            'fromTime' => $fromTime
        ]);
    }

    /**
     * @param string $tradingPair
     * @param int $resolution
     * @param int $from
     * @param int $to
     * @return ResponseInterface
     * @throws ClientException
     */
    public function candleHistory(
        string $tradingPair,
        int $resolution,
        int $from,
        int $to
    ): ResponseInterface
    {
        return $this->client->get("trading/candle/history/$tradingPair/$resolution", [
            'from' => $from,
            'to' => $to
        ]);
    }
}