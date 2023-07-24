<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Public;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Kwarcek\ZondacryptoRestApiPhp\Public\Exceptions\ClientException;
use Psr\Http\Message\ResponseInterface;

class Client
{
    public const ZONDA_DEFAULT_API_URL = 'https://api.zonda.exchange/';

    public function __construct(private ClientInterface $client)
    {
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function get(string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->client->request("GET", $uri, $options);
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function post(string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->client->request("POST", $uri, $options);
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function put(string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->client->request("PUT", $uri, $options);
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }

    /**
     * @param string $uri
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    public function delete(string $uri, array $options = []): ResponseInterface
    {
        try {
            return $this->client->request("DELETE", $uri, $options);
        } catch (GuzzleException $exception) {
            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception->getPrevious());
        }
    }
}