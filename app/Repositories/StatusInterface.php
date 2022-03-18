<?php

namespace App\Repositories;

interface StatusInterface
{
    public function finish(int $id);
    public function pending(int $id);
}
