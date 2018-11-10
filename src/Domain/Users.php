<?php
declare(strict_types=1);

namespace AlgorathTest\Domain;

use AlgorathTest\Domain\Exceptions\UserNotValid;

class Users extends Collection
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

        foreach($this->items as $it) {
            if ($it->equals($item)) {
                return true;
            }
        }

        return false;
    }

    private static function validate($item): void
    {
        if (! self::isAValidUser($item)) {
            throw new UserNotValid();
        }
    }

    private static function isAValidUser($item): bool
    {
        return $item instanceof User;
    }
}