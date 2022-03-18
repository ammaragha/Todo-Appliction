<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Repositories\Todo\TodoRepository;
use PHPUnit\Framework\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }


    public function testCreateTodo()
    {
        $todo  = (new TodoRepository)->read(2);
        $this->assertInstanceOf(Todo::class,$todo);
    }
}
