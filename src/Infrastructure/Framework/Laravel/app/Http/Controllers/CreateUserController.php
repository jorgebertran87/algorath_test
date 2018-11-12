<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Command\AddUserCommand;
use AlgorathTest\Application\Command\CommandBus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

final class CreateUserController extends Controller
{
    public function handle(CommandBus $commandBus): RedirectResponse
    {
        $name = Input::get('name');
        $command = new AddUserCommand($name);
        $commandBus->handle($command);
        return redirect('/');
    }
}