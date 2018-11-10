<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Command\AddUserCommand;
use AlgorathTest\Application\Command\AddUserCommandHandler;
use AlgorathTest\Application\Command\CommandBus;
use AlgorathTest\Application\Repository\UserRepository;
use AlgorathTest\Domain\Id;
use AlgorathTest\Domain\Name;
use AlgorathTest\Domain\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;

final class CreateUserController extends Controller
{
    public function handle(CommandBus $commandBus, UserRepository $userRepository): RedirectResponse
    {


        $randomId = Id::generateRandom();
        $name     = new Name(Input::get('name'));
        $user     = new User($randomId, $name);

        $command = new AddUserCommand($user,$userRepository);
        $commandBus->handle($command);
        return redirect('/');
    }

    protected function injectCommandQueryDependencies(): void
    {
        CommandBus::use([AddUserCommand::class => AddUserCommandHandler::class]);
    }
}