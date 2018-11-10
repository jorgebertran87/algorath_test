<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use AlgorathTest\Application\Query\QueryBus;
use AlgorathTest\Application\Query\RetrieveUsersWithConnectionsQuery;
use AlgorathTest\Application\Query\RetrieveUsersWithConnectionsQueryHandler;
use AlgorathTest\Application\Repository\UserRepository;
use Illuminate\View\View;


final class ShowStatsController extends Controller
{
    public function handle(
        QueryBus $queryBus,
        UserRepository $userRepository
    ): View
    {
        $query = new RetrieveUsersWithConnectionsQuery($userRepository);
        $users = $queryBus->handle($query);

        return view('stats', compact('users'));
    }

    protected function injectCommandQueryDependencies(): void
    {
        QueryBus::use([RetrieveUsersWithConnectionsQuery::class => RetrieveUsersWithConnectionsQueryHandler::class]);
    }
}