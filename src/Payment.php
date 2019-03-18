<?php
namespace KTpay\Api;

use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

class Payment
{
    /**
     * @var bool $test
     */
    protected static $test = false;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var resource|null
     */
    protected $key = null;

    const
        TIMEOUT = 2.0,
        URL = 'https://ktpay.kz',
        URL_TEST = 'https://fintech.test.nplus.tech';

    /**
     * Payment constructor.
     *
     * @param string $appKey Application key
     * @param string $crt Certificate for encrypt/decrypt
     */
    public function __construct(
        string $appKey,
        string $crt
    ) {
        $this->httpClient = new HttpClient([
            'base_uri' => static::$test ? static::URL_TEST : static::URL,
            'timeout'  => static::TIMEOUT,
            'headers' => [
                'Auth-Identifier' => $appKey
            ],
        ]);

        $this->key = openssl_get_publickey($crt);
    }

    /**
     * Change api to test
     */
    public static function useTestApi()
    {
        static::$test = true;
    }

    /**
     * Send request to api
     *
     * @param $method
     * @param $uri
     * @param $payload
     * @return \KTpay\Api\Response
     */
    protected function send(string $method, string $uri, array $payload)
    {
        try {
            $res = $this->httpClient->request($method, $uri, [
                'json' => $payload
            ]);

            return new Response($res);
        } catch (RequestException $exception) {
            return $this->getExceptionFromResponse($exception);
        }
    }

    protected function getExceptionFromResponse(RequestException $e)
    {
        if ($e->hasResponse()) {
            return new Response($e->getResponse(), $e);
        }

        return new Response(new \GuzzleHttp\Psr7\Response(), $e);
    }

    /**
     * Create payment
     *
     * @return \KTpay\Api\Response
     */
    public function create()
    {
        return $this->send('POST', '/api/v1/', [

        ]);
    }
}
