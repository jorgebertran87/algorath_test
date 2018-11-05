<?php
declare(strict_types=1);

namespace AlgorathTest\Domain;

final class User
{
    private $id;
    private $name;
    private $connections;

    public function __construct(Id $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function addConnections(Connections $connections): void
    {
        $this->connections = $connections;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function connections(): Connections
    {
        return $this->connections;
    }

    public function equals(User $user): bool
    {
        return (string)$this->id() === (string)$user->id();
    }
}