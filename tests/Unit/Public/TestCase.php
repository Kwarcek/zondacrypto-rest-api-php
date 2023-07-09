<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Tests\Unit\Public;

use GuzzleHttp\Client as GuzzleClient;
use Kwarcek\ZondacryptoRestApiPhp\Public\Client;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $guzzleClient = new GuzzleClient();
        $this->client = new Client($guzzleClient);
    }
}