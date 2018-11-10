<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\User;

class AddConnectionBetweenUsersCommand
{
    private $user1;
    private $user2;
    private $userRepository;

    public function __construct(User $user1, User $user2, UserRepository $userRepository)
    {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->userRepository = $userRepository;
    }

    public function user1(): User
    {
        return $this->user1;
    }

    public function user2(): User
    {
        return $this->user2;
    }

    public function userRepository(): UserRepository
    {
        return $this->userRepository;
    }
}