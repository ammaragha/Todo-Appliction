<?php

namespace App\Repositories\Todo;

use App\Repositories\CrudInterface;
use App\Repositories\StatusInterface;

interface TodoRepositoryInterface extends CrudInterface,StatusInterface
{
    public function withTasks(int $id);
    
}
