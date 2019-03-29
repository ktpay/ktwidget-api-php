<?php
declare(strict_types=1);
namespace Tests;

use KTWidget\Merchant\Request;
use KTWidget\Merchant\Response;
use PHPUnit\Framework\TestCase as BaseCase;

abstract class TestCase extends BaseCase
{
    /**
     * TestCase constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        Request::useTestApi();
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @return Request
     */
    protected function createApiRequest()
    {
        return new Request(
            getenv('KTPAYAPI_APP_KEY'),
            "gBvdrvZhiMg12sICet9l82Mtn1XNVn/ekdJhx61U+VA="
        );
    }

    /**
     * @param Response $response
     */
    public function isRequestSuccess(Response $response)
    {
        $this->assertTrue($response->success(), "API request error: {$response->message()}");
    }
}
