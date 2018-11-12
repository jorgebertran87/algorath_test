<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

class UpdateUserCommand
{
    private $id;
    private $name;
    private $connectedUserIds;

    public function __construct(string $id, string $name, ?array $connectedUserIds)
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->connectedUserIds = $connectedUserIds;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function connectedUserIds(): ?array
    {
        return $this->connectedUserIds;
    }
}