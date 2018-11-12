<?php
declare(strict_types=1);

namespace Tests\Application\Command;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Infrastructure\CQRS\CommandBus;
use Tests\Application\Repository\UserRepositoryStub;

class CommandBusStub extends CommandBus
{
    protected function enableDI(): void
    {
        $this->container->set(
            UserRepository::class,
            new UserRepositoryStub()
        );
    }

    public function userRepository(): UserRepository
    {
        return $this->container->get(UserRepository::class);
    }
}