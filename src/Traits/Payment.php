<?php
namespace KTWidget\Merchant\Traits;

trait Payment
{
    /**
     * Create payment
     *
     * @param array $payloads
     * @return \KTWidget\Merchant\Response
     */
    public function paymentCreate(array $payloads)
    {
        return $this->callApi('POST', '', $payloads);
    }
}
