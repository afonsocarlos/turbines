<?php

namespace App\Lib;


class Response
{

    public function __construct(private mixed $body, private int $statusCode = 200)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    public static function toJson(mixed $body, int $statusCode = 200): Response
    {
        return new Response($body, $statusCode);
    }

    /**
     * Getter for body
     *
     * @return mixed
     */
    public function getBody(): mixed
    {
        return $this->body;
    }

    /**
     * Getter for statusCode
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
