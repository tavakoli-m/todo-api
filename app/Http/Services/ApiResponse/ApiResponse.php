<?php

namespace App\Http\Services\ApiResponse;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    private string|null $message = null;

    private mixed $data = [];

    private int $status = 200;

    private array $appends = [];

    private array $errors = [];


    /**
     * @param string $message
     */
    public function setMessage(string $message) : void
    {
        $this->message = $message;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data) : void
    {
        $this->data = $data;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    /**
     * @param array $appends
     */
    public function setAppends(array $appends) : void
    {
        $this->appends = $appends;
    }

    /**
     * @param array $errors
     */
    public function setErrors(array $errors) : void
    {
        $this->errors = $errors;
    }

    public function response() : JsonResponse
    {
        $body = [];
        $body['message'] = $this->message;
        $body['data'] = $this->data;
        $body['status'] = $this->status;
        $body['errors'] = $this->errors;
        $body = $body + $this->appends;
        return response()->json($body, $this->status);
    }
}
