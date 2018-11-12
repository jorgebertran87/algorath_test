<?php
declare(strict_types=1);

namespace AlgorathTest\Infrastructure\CQRS;

use AlgorathTest\Infrastructure\Repository\Eloquent\UserRepository;
use DI\ContainerBuilder;

abstract class MessageBus
{
    protected $container;

    public function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->useAnnotations(false);

        $this->container = $builder->build();

        $this->enableDI();
    }

    protected function enableDI(): void
    {
        $this->container->set(
            \AlgorathTest\Application\Repository\UserRepository::class,
            new UserRepository()
        );
    }

}