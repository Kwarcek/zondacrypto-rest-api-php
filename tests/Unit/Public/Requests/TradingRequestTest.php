<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Tests\Unit\Public\Requests;

use Kwarcek\ZondacryptoRestApiPhp\Public\Enums\Resolution;
use Kwarcek\ZondacryptoRestApiPhp\Public\Requests\TradingRequest;
use Kwarcek\ZondacryptoRestApiPhp\Tests\Unit\Public\TestCase;

class TradingRequestTest extends TestCase
{
    protected TradingRequest $tradingRequest;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->tradingRequest = new TradingRequest($this->client);
    }

    public function test_trading_request_get_ticker()
    {
        $response = $this->tradingRequest->getTicker();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('items', $response);
        $this->assertIsArray($response['items']);
    }

    public function test_trading_request_get_pair_ticker()
    {
        $response = $this->tradingRequest->getPairTicker('BTC-PLN');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('ticker', $response);
        $this->assertIsArray($response['ticker']);
    }

    public function test_trading_request_get_stats()
    {
        $response = $this->tradingRequest->getStats();

        $this->assertIsArray($response);
        $this->assertArrayHasKey('items', $response);
        $this->assertIsArray($response['items']);
    }

    public function test_trading_request_get_pair_stats()
    {
        $response = $this->tradingRequest->getPairStats('BTC-PLN');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('stats', $response);
        $this->assertIsArray($response['stats']);
    }

    public function test_trading_request_get_orderbook()
    {
        $response = $this->tradingRequest->getOrderbook('BTC-PLN');

        $this->assertIsArray($response);
        $this->assertArrayHasKey('sell', $response);
        $this->assertIsArray($response['sell']);
        $this->assertArrayHasKey('buy', $response);
        $this->assertIsArray($response['buy']);
    }

    public function test_trading_request_get_orderbook_limited()
    {
        $response = $this->tradingRequest->getOrderbookLimited('BTC-PLN', 50);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('sell', $response);
        $this->assertIsArray($response['sell']);
        $this->assertCount(50, $response['sell']);
        $this->assertArrayHasKey('buy', $response);
        $this->assertIsArray($response['buy']);
        $this->assertCount(50, $response['buy']);
    }

    public function test_trading_request_get_last_transactions()
    {
        $response = $this->tradingRequest->getLastTransaction('BTC-PLN', 50);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('items', $response);
        $this->assertIsArray($response['items']);
        $this->assertCount(50, $response['items']);
    }

    public function test_trading_request_get_candle_history()
    {
        $response = $this->tradingRequest->getCandleHistory(
            'BTC-PLN',
            Resolution::FOUR_HOUR,
            (new \DateTime())->sub(\DateInterval::createFromDateString('1 week'))->format('Uv'),
            (new \DateTime())->sub(\DateInterval::createFromDateString('1 day'))->format('Uv')
        );

        $this->assertIsArray($response);
        $this->assertArrayHasKey('items', $response);
        $this->assertIsArray($response['items']);
    }
}