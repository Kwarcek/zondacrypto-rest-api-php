<?php

namespace Kwarcek\ZondacryptoRestApiPhp\Private;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Kwarcek\ZondacryptoRestApiPhp\Private\Exceptions\ClientException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private ClientInterface $client;

    public function __construct(
        private AuthCredentials $authCredentials,
        array                   $clientConfig = []
    )
    {
        $this->client = new GuzzleClient(
            array_merge(
                $clientConfig,
                ['handler' => $this->getStack()]
            )
        );
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

    /** @return HandlerStack */
    protected function getStack(): HandlerStack
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push($this->handleAuthenticationHeaders());

        return $stack;
    }

    /** @return \Closure */
    protected function handleAuthenticationHeaders(): \Closure
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $time = time();
                $post = ($request->getMethod() === 'GET') ? null : json_encode($options);

                $request->withHeader('API-Key', $this->authCredentials->publicKey);
                $request->withHeader(
                    'API-Hash',
                    hash_hmac(
                        "sha512",
                        $this->authCredentials->publicKey . $time . $post,
                        $this->authCredentials->privateKey
                    )
                );
                $request->withHeader('operation-id', $this->getUUID(random_bytes(16)));
                $request->withHeader('Request-Timestamp', $time);
                $request->withHeader('Content-Type', 'application/json');
                $request->withHeader('Accept', 'application/json');

                return $handler($request, $options);
            };
        };
    }

    /**
     * @param string $data
     * @return string
     */
    protected function getUUID(string $data): string
    {
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    //    public function get(string $uri): array
    //    {
    //        try {
    //            return $this->parse(
    //                $this->client->get($uri . '?query=' . urlencode(json_encode($this->params)), $this->params)
    //            );
    //        } catch (GuzzleException $exception) {
    //            throw new BitbayException($exception->getMessage(), $exception->getCode());
    //        }
    //    }
    //
}