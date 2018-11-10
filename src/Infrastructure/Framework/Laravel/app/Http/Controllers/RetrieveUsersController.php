<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveUsersQuery;
use AlgorathTest\Application\Query\RetrieveUsersQueryHandler;
use AlgorathTest\Application\Repository\UserRepository;
use Illuminate\View\View;


final class RetrieveUsersController extends Controller
{
    public function handle(
        QueryBus $queryBus,
        UserRepository $userRepository
    ): View
    {
        $query = new RetrieveUsersQuery($userRepository);
        $users = $queryBus->handle($query);

        return view('users', compact('users'));
    }

    protected function injectCommandQueryDependencies(): void
    {
        QueryBus::use([RetrieveUsersQuery::class => RetrieveUsersQueryHandler::class]);
    }
}