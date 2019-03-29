<?php
namespace KTWidget\Merchant;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use KTWidget\Merchant\Traits\Payment;
Use KTWidget\Merchant\Traits\SodiumCrypt;

class Request
{
    use Payment, SodiumCrypt;

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
    protected $key;

    protected $httpClient;

    /**
     * Payment constructor.
     *
     * @param string $appKey Application key
     * @param string $key
     */
    public function __construct(string $appKey, string $key)
    {
        $this->httpClient = new Client([
            'base_uri' => sprintf(static::$test ? static::URL_TEST : static::URL, static::CURRENT_API_VERSION),
            'http_errors' => false,
            'headers' => [
                'Auth-Identifier' => $appKey
            ],
        ]);

        $this->key = $key;
    }

    public static function useTestApi()
    {
        static::$test = true;
    }

    /**
     * Call request to api
     *
     * @param $method
     * @param $uri
     * @param $payload
     * @return \KTWidget\Merchant\Response
     */
    public function callApi(string $method, string $uri, array $payload)
    {
        try {
            $res = $this->httpClient->request($method, $uri, [
                'body' => $this->encrypt($this->key, $payload),
            ]);
        } catch (GuzzleException $e) {
            dd($e->getMessage(), $e);
        }

        return new Response($res);
    }
}