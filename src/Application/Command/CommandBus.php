<?php

namespace AlgorathTest\Application\Command;

final class CommandBus
{
    private static $commands;

    public static function use(array $commands): void
    {
        self::$commands = $commands;
    }

    public function handle($command): void
    {
        $handler = new self::$commands[get_class($command)]($command);
        $handler->handle();
    }
}