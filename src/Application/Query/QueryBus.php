<?php

namespace AlgorathTest\Application\Query;

final class QueryBus
{
    private static $queries;

    public static function use(array $queries): void
    {
        self::$queries = $queries;
    }

    public function handle($query)
    {
        $handler = new self::$queries[get_class($query)]($query);
        return $handler->handle();
    }
}