<?php

namespace AlgorathTest\Application\Command;

interface CommandBus
{
    public function handle($command): void;
}