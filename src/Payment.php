<?php
namespace KTpay\Api;

class Payment
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

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
        $this->httpClient = HttpClient::create($appKey, $crt);
    }

    /**
     * Create payment
     *
     * @param array $payloads
     * @return \KTpay\Api\Response
     */
    public function create(array $payloads)
    {
        return $this->httpClient->callApi(HttpClient::POST, '', $payloads);
    }
}
