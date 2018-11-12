<?php
declare(strict_types=1);

namespace Tests\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Infrastructure\CQRS\QueryBus;
use Tests\Application\Repository\UserRepositoryStub;

class QueryBusStub extends QueryBus
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