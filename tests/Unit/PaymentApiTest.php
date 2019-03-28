<?php
declare(strict_types=1);
namespace Tests\Unit;

use Tests\TestCase;

final class PaymentApiTest extends TestCase
{
    public function testPaymentCreate(): void
    {
        $request = $this->createApiRequest();
        $response = $request->paymentCreate([
	        "order" => [
                "id" => "Order1",
		        "description" => "Тестовая оплата за Order1",
		        "amount" => 10000,
		        "type" => "ecom"
	        ],
	        "user" => [
                "merchant_user_id" => "user1",
                "phone" => "+77001234567",
                "email" => "test@example.com"
            ]
        ]);
        $this->isRequestSuccess($response);
    }
}