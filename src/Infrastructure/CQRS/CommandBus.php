<?php
declare(strict_types=1);

namespace AlgorathTest\Infrastructure\CQRS;

use AlgorathTest\Application\Command\CommandBus as CommandBusInterface;

class CommandBus extends MessageBus implements CommandBusInterface
{
    public function handle($command): void
    {
        $handlerClass = get_class($command).'Handler';
        $handler = $this->container->get($handlerClass);
        $handler->handle($command);
    }
}