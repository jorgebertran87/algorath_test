<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Query;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Users;

class RetrieveUsersQueryHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(): Users
    {
        return $this->userRepository->all();
    }
}