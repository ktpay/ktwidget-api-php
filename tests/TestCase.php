<?php
declare(strict_types=1);
namespace Tests;

use KTpay\Api\Request;
use KTpay\Api\Response;
use PHPUnit\Framework\TestCase as BaseCase;

abstract class TestCase extends BaseCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        Request::useTestApi();
        parent::__construct($name, $data, $dataName);
    }

    protected function createApiRequest()
    {
        return new Request(
            getenv('KTPAYAPI_APP_KEY'),
            getenv('KTPAYAPI_KEY')
        );
    }

    public function isRequestSuccess(Response $response)
    {
        $this->assertTrue($response->success(), "API request error: {$response->message()}");
    }
}
