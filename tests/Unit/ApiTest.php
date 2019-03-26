<?php
declare(strict_types=1);
namespace Tests\Unit;

use Tests\TestCase;

final class ApiTest extends TestCase
{
    public function testPaymentCreate(): void
    {
        $request = $this->createApiRequest();
        $response = $request->paymentCreate([]);
        $this->isRequestSuccess($response);
        $this->assertEquals(true, $response->verify(), 'Message not verified');
    }
}