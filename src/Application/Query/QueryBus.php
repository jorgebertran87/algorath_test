<?php

namespace AlgorathTest\Application\Query;

interface QueryBus
{
    /** @return mixed */
    public function handle($query);
}