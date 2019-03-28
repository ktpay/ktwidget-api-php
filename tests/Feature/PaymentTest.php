<?php
declare(strict_types=1);
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Unit\PaymentApiTest;

final class PaymentTest extends TestCase
{
    public function testPaymentDone(): void
    {
        $apiUnit = $this->getUnit();
        $apiUnit->testPaymentCreate();
        //$apiUnit->testPaymentClearing();
    }

    public function testPaymentCancel(): void
    {
        $apiUnit = $this->getUnit();
        $apiUnit->testPaymentCreate();
        //$apiUnit->testPaymentRefund();
    }

    public function getUnit()
    {
        return new PaymentApiTest();
    }
}
