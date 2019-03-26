<?php
namespace KTpay\Api;

use GuzzleHttp\Psr7\Response as BaseResponse;
use KTpay\Api\Traits\SodiumCrypt;

class Response
{
    use SodiumCrypt;

    protected $success = false;

    protected $code = 500;

    protected $message = null;

    protected $data = [];

    public function __construct(BaseResponse $response)
    {
        $this->code = $response->getStatusCode();

        if ($this->code === 200) {
            $this->success = true;
        }

        $payload = json_decode($response->getBody()->getContents());

        if ($payload->response->status !== 'ok') {
            $this->success = false;
            $this->message = implode(' | ', (array) $payload->error);
            $this->data = $payload->response->data;
        }
    }

    public function success()
    {
        return $this->success;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function data(): array
    {
        return $this->data;
    }
}