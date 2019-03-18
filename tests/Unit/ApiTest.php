<?php
declare(strict_types=1);
namespace Tests\Unit;

use Tests\TestCase;

final class ApiTest extends TestCase
{
    public function testPaymentCreate(): void
    {
        $payment = $this->payment();

        $response = $payment->create([
            ''
        ]);

        $this->assertEquals(true, !$response->fail(), $response->message());

        $this->assertEquals(true, $response->verify('asdadad'), 'Message not verified');
    }
}