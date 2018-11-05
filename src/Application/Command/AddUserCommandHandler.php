<?php
declare(strict_types=1);

namespace AlgorathTest\Application\Command;

class AddUserCommandHandler
{
    private $addUserCommand;

    public function __construct(AddUserCommand $addUserCommand)
    {
        $this->addUserCommand = $addUserCommand;
    }

    public function handle(): void
    {
        $userRepository = $this->addUserCommand->userRepository();
        $user           = $this->addUserCommand->user();

        $userRepository->add($user);
    }
}