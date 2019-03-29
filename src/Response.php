<?php
namespace KTWidget\Merchant;

use GuzzleHttp\Psr7\Response as BaseResponse;
use KTWidget\Merchant\Traits\SodiumCrypt;

class Response
{
    use SodiumCrypt;

    protected $success = false;

    protected $code = 500;

    protected $messages = [];

    protected $data = [];

    public function __construct(BaseResponse $response)
    {
        $this->code = $response->getStatusCode();

        if ($this->code === 200) {
            $this->success = true;
        }

        $contents = $response->getBody()->getContents();
        $payload = json_decode($contents, false, 512, JSON_UNESCAPED_UNICODE);

        if (!is_null($payload) && property_exists($payload, 'response')) {
            $this->data = $payload->response->data;

            if ($payload->response->status !== 'ok') {
                $this->success = false;
                $this->messages = (array) $payload->error;
            }
        } else {
            $this->messages = [$contents];
        }
    }

    public function success()
    {
        return $this->success;
    }

    public function messages(): array
    {
        return $this->messages;
    }

    public function message(string $glue = ' | '): string
    {
        return implode($glue, $this->messages);
    }

    public function data(): array
    {
        return $this->data;
    }
}