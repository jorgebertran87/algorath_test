<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;

class RetrieveConnectionsFromUserQuery
{
    private $userId;
    private $userRepository;

    public function __construct(Id $userId, UserRepository $userRepository)
    {
        $this->userId = $userId;
        $this->userRepository = $userRepository;
    }

    public function userId(): Id
    {
        return $this->userId;
    }

    public function userRepository(): UserRepository
    {
        return $this->userRepository;
    }
}