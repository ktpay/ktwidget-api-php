<?php
namespace KTpay\Api\Traits;

trait Payment
{
    /**
     * Create payment
     *
     * @param array $payloads
     * @return \KTpay\Api\Response
     */
    public function paymentCreate(array $payloads)
    {
        return $this->callApi('POST', '', $payloads);
    }
}
