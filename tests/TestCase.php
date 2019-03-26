<?php
declare(strict_types=1);
namespace Tests;

use KTpay\Api\HttpClient;
use KTpay\Api\Payment;
use PHPUnit\Framework\TestCase as BaseCase;

abstract class TestCase extends BaseCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        HttpClient::useTestApi();
        parent::__construct($name, $data, $dataName);
    }

    protected function payment()
    {
        return new Payment('asdasdasdadasdasd','asdasdadadadasd');
    }
}
