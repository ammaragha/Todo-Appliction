<?php

namespace App\Repositories\Task;

use App\Models\Todo;
use App\Repositories\CrudInterface;
use App\Repositories\StatusInterface;
use Illuminate\Http\Request;

interface TaskRepositoryInterface extends CrudInterface, StatusInterface
{
    public function createManyTasks(array $tasks, Todo $todo);
}
