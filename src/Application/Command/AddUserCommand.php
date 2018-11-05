<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\User;

class AddUserCommand
{
    private $user;
    private $userRepository;

    public function __construct(User $user, UserRepository $userRepository)
    {
        $this->user           = $user;
        $this->userRepository = $userRepository;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function userRepository(): UserRepository
    {
        return $this->userRepository;
    }
}