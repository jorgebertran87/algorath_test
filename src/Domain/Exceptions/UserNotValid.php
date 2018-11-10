<?php
declare(strict_types=1);

namespace AlgorathTest\Domain\Exceptions;

use Exception;
use Throwable;

class UserNotValid extends Exception
{
    private const MESSAGE = "User not valid";

    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(self::MESSAGE, $code, $previous);
    }
}