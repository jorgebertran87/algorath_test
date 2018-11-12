<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

class AddUserCommand
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}