<?php
namespace KTpay\Api;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Response
{
    protected $success = false;

    protected $message = null;

    protected $payload = [];

    protected $code = null;

    protected $exception = null;

    public function __construct(ResponseInterface $response, RequestException $exception = null)
    {
        $this->code = $response->getStatusCode();
        $this->exception = $exception;

        switch ($this->code) {
            case 200: $this->ok($response); break;
            case 404: $this->notFound($response); break;
            case 422: $this->unprocessableEntity($response); break;
            case 500: $this->internalServerError($response); break;
            default: $this->default($response);
        }
    }

    public function fail()
    {
        return !$this->success;
    }

    public function verify(string $crt)
    {
        return true;
    }

    public function message(): string
    {
        return $this->message;
    }

    protected function ok(ResponseInterface $response)
    {
        $this->success = true;
    }

    protected function notFound(ResponseInterface $response)
    {
        $this->message = "Not found {$this->requestURL()}";
    }

    protected function unprocessableEntity(ResponseInterface $response)
    {
        //
    }

    protected function internalServerError(ResponseInterface $response)
    {
        //
    }

    protected function default(ResponseInterface $response)
    {
        //
    }

    protected function requestURL()
    {
        $req = $this->exception->getRequest();
        return "{$req->getMethod()}:{$req->getUri()}";
    }
}