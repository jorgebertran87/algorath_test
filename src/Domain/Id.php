<?php
declare(strict_types=1);

namespace AlgorathTest\Domain;

final class Id
{
    private $id;

    private const LENGTH = 10;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function equals(Id $id): bool
    {
        return $this->id === (string)$id;
    }

    public static function generateRandom(): self
    {
        return new self(str_random(self::LENGTH));
    }

    public function __toString(): string
    {
        return $this->id;
    }
}