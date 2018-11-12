<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;

class AddUserCommandHandler
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(AddUserCommand $addUserCommand): void
    {
        $name           = $addUserCommand->name();
        $user           = new User(Id::generateRandom(), new Name($name));

        $this->userRepository->add($user);
    }
}