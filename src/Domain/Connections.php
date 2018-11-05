<?php
declare(strict_types=1);

namespace AlgorathTest\Domain;

use AlgorathTest\Domain\Exceptions\ConnectionNotValid;

class Connections extends Collection
{
    public static function create(array $items): self
    {
        return new self(array_map( function($item)
        {
            self::validate($item);
            
            return $item;
        }, $items));
    }

    public function add($item): void
    {
        self::validate($item);
        
        $this->items[] = $item;
    }

    /** @param mixed $item */
    public function exists($item): bool
    {
        self::validate($item);

        /** @var User $it */
        foreach($this->items as $it) {
            if ($it->equals($item)) {
                return true;
            }
        }

        return false;
    }

    private static function validate($item): void
    {
        if (! self::isAValidConnection($item)) {
            throw new ConnectionNotValid();
        }
    }

    private static function isAValidConnection($item): bool
    {
        return $item instanceof User;
    }
}