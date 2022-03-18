<?php

namespace App\Providers;

use App\Http\Controllers\Api\TodoController;
use App\Repositories\Todo\TodoRepository;
use App\Repositories\Todo\TodoRepositoryInterface;

use App\Http\Controllers\Api\TaskController;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(TodoController::class)
            ->needs(TodoRepositoryInterface::class)
            ->give(TodoRepository::class);

        $this->app->when(TaskController::class)
            ->needs(TaskRepositoryInterface::class)
            ->give(TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
