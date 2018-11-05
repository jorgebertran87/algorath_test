<?php
declare(strict_types=1);

namespace AlgorathTest\Domain\Exceptions;

use Exception;
use Throwable;

class ConnectionNotValid extends Exception
{
    private const MESSAGE = "Connection not valid. It must be an User entity";

    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(self::MESSAGE, $code, $previous);
    }
}