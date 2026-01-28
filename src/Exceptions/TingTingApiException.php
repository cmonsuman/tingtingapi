<?php

namespace TingTing\Laravel\Exceptions;

use Exception;
use Throwable;

class TingTingApiException extends Exception
{
    /**
     * The response data from the API.
     *
     * @var array|null
     */
    protected ?array $data;

    /**
     * Create a new exception instance.
     *
     * @param string $message
     * @param int $code
     * @param array|null $data
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, ?array $data = null, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * Get the response data from the API.
     *
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }
}
