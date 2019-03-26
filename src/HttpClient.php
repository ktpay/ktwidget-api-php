<?php
namespace KTpay\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient extends Client
{
    const
        GET = 'GET',
        POST = 'POST',
        DELETE = 'DELETE'
    ;

    const
        CURRENT_API_VERSION = 1,
        URL = 'https://ktpay.kz/api/v%s/merchant-widget/payment',
        URL_TEST = 'https://fintech.test.nplus.tech/api/v%s/merchant-widget/payment';

    /**
     * @var bool $test
     */
    protected static $test = false;

    /**
     * @var resource|null
     */
    protected $key = null;

    public static function create($appKey, $crt)
    {
        $key = openssl_get_publickey($crt);

        return new static([
            'base_uri' => static::getURL(),
            'http_errors' => false,
            'handler' => static::handler(),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Auth-Identifier' => $appKey
            ],
        ]);
    }

    public static function useTestApi()
    {
        static::$test = true;
    }

    protected static function handler(): HandlerStack
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(static::add_response_header());

        return $stack;
    }

    /**
     * Call request to api
     *
     * @param $method
     * @param $uri
     * @param $payload
     * @return \KTpay\Api\Response
     */
    public function callApi(string $method, string $uri, array $payload)
    {
        return new Response(
            $this->request($method, $uri, [
                'json' => $payload,
            ])
        );
    }


    /**
     * Return url for service
     *
     * @return string
     */
    protected static function getURL(): string
    {
        return sprintf(static::$test ? static::URL_TEST : static::URL, static::CURRENT_API_VERSION);
    }

    protected static function add_response_header()
    {
        return function (callable $handler) {
            return function (
                RequestInterface $request,
                array $options
            ) use ($handler) {
                $promise = $handler($request, $options);
                return $promise->then(
                    function (ResponseInterface $response) {
                        dd($response->getBody()->getContents(), get_class($response));
                    }
                );
            };
        };
    }
}