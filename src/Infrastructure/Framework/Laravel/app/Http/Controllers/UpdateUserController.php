<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Command\CommandBus;
use AlgorathTest\Application\Command\UpdateUserCommand;
use AlgorathTest\Infrastructure\Framework\Laravel\app\Services\ConnectionsParser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

final class UpdateUserController extends Controller
{
    public function handle(
        CommandBus $commandBus,
        string $id
    ): RedirectResponse
    {
        $name        = Input::get('name');
        $connections = Input::get('connections');

        $command = new UpdateUserCommand($id, $name,  $connections);
        $commandBus->handle($command);

        return redirect('/');
    }
}