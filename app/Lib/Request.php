<?php

namespace App\Lib;


class Request
{
    private string $method;
    private array $params;
    private array $segments;

    public function __construct(array $segments = [])
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->params = [];
        $this->segments = $segments;
        $this->withParams();
    }

    private function withParams(): void
    {
        if ($this->method === 'GET') {
            $inputType = INPUT_GET;
            $params = $_GET;
        } elseif ($this->method === 'POST') {
            $inputType = INPUT_POST;
            $params = $_POST;
        }

        foreach ($params as $key => $value) {
            $this->params[$key] = filter_input($inputType, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        $content = file_get_contents('php://input');
        $this->params = array_merge($params, json_decode($content, true) ?? []);
    }

    /**
     * Getter for method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Getter for params
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Get specified param from params
     *
     * @return mixed
     */
    public function getParam(string $key): mixed
    {
        return $this->params[$key] ?? null;
    }

    /**
     * Getter for segments
     *
     * @return array
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * Get specified segment from segments
     *
     * @return mixed
     */
    public function getSegment($index): mixed
    {
        return $this->segments[$index] ?? null;
    }
}
