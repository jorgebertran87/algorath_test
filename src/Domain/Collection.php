<?php
declare(strict_types=1);

namespace AlgorathTest\Domain;

use ArrayIterator;
use Countable;
use IteratorAggregate;


abstract class Collection implements Countable, IteratorAggregate
{
    protected $items;

    protected function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /** @return mixed */
    abstract public static function create(array $items);

    /** @param mixed $item */
    abstract public function add($item): void;

    /** @param mixed $item */
    abstract public function exists($item): bool;
}