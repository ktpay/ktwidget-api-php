<?php
namespace KTpay\Api;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response as BaseResponse;

class Response extends BaseResponse
{

  /*  protected $success = false;

    protected $message = null;

    protected $payload = [];

    protected $code = null;

    public function __construct(ResponseInterface $response)
    {
        $this->code = $response->getStatusCode();

        switch ($this->code) {
            case 200: $this->ok($response); break;
            case 404: $this->notFound($response); break;
            case 401: $this->unauthorized($response); break;
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
        return $this->message ? : ':\'(';
    }

    protected function ok(ResponseInterface $response)
    {
        $this->success = true;
        dd($response->getBody()->getContents(), $response->getHeaders());
    }

    protected function notFound(ResponseInterface $response)
    {
        $this->message = "Not found {$this->requestURL()}";
    }

    protected function unauthorized(ResponseInterface $response)
    {

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
    }*/
}