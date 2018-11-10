<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;

class RetrieveUsersWithConnectionsQuery
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userRepository(): UserRepository
    {
        return $this->userRepository;
    }
}