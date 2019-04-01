<?php
namespace KTWidget\Merchant;

use GuzzleHttp\Psr7\Response as BaseResponse;
use KTWidget\Merchant\Traits\SodiumCrypt;

class Response
{
    use SodiumCrypt;

    protected $success = false;

    protected $code = 0;

    protected $messages = [];

    protected $data = [];

    protected $hint = null;

    public function __construct(BaseResponse $response)
    {
        $contents = $response->getBody()->getContents();
        $payload = json_decode($contents, false, 512, JSON_UNESCAPED_UNICODE);

        $this->success = $payload->response->success;

        if ($this->success) {
            $this->data = $payload->response->data;
        } else {
            $this->code = $payload->error->code;
            $this->messages = (array) $payload->error->messages;
            $this->hint = $payload->error->hint;
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

    /**
     * @return string|null
     */
    public function hint(): ?string
    {
        return $this->hint;
    }
}
