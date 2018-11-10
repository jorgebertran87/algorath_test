<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

final class NewUserController extends Controller
{
    public function handle(): View
    {
        return view('users_new');
    }

    protected function injectCommandQueryDependencies(): void
    {
        //without dependencies
    }
}