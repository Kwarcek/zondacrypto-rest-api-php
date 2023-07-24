
# Zondacrypto REST API PHP
A PHP wrapper for [https://docs.zonda.exchange/reference/introduction](https://docs.zonda.exchange/reference/introduction)



## Installation


```bash
  composer require kwarcek/zondacrypto-rest-api-php
```
    
## Simple usage

```php
use GuzzleHttp\Client as GuzzleClient;
use Kwarcek\ZondacryptoRestApiPhp\Public\Client;
use Kwarcek\ZondacryptoRestApiPhp\Public\Requests\TradingRequest;

$guzzleClient = new GuzzleClient([
    'base_uri' => Client::ZONDA_DEFAULT_API_URL,
]);
$zondaClient = new Client($guzzleClient);
$tradingRequest = new TradingRequest($zondaClient);
$tradingRequest->getOrderbook();
```


## Documentation

Coming soon...


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Authors

- [@kwarcek](https://www.github.com/kwarcek)

