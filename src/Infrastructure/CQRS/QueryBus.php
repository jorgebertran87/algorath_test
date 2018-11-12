<?php
declare(strict_types=1);

namespace AlgorathTest\Infrastructure\CQRS;

use AlgorathTest\Application\Query\QueryBus as QueryBusInterface;

class QueryBus extends MessageBus implements QueryBusInterface
{
    /** @return mixed */
    public function handle($query)
    {
        $handlerClass = get_class($query).'Handler';
        $handler = $this->container->get($handlerClass);
        return $handler->handle($query);
    }
}