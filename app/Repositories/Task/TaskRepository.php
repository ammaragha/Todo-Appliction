<?php

namespace App\Repositories\Task;

use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;

class TaskRepository implements TaskRepositoryInterface
{


    public function create(Request $request): Task
    {
        $task = Task::create([
            'name' => $request->name,
            'status' => "pending",
            'todo_id' => $request->todo_id
        ]);

        return $task;
    }

    public function read(int $id): Task
    {
        return Task::find($id);
    }

    public function update(Request $request, int $id): Task
    {
        $task = $this->read($id);
        $task->update([
            'name' => $request->name ? $request->name : $task->name,
            'status' => $request->status ? $request->status : $task->status,
        ]);
        return $task;
    }

    public function delete(int $id): void
    {
        $this->read($id)->delete();
    }

    public function finish(int $id)
    {
        $task = $this->read($id);
        $task->status = 'finished';
        $task->save();
        return $task;
    }

    public function pending(int $id)
    {
        $task = $this->read($id);
        $task->status = 'pending';
        $task->save();
        return $task;
    }

    public function finishAllTasks(int $id): void
    {
        $tasks = Task::where('todo_id', $id)->get();
        foreach ($tasks as $task) {
            $this->finish($task->id);
        }
    }


    public function createManyTasks(array $tasks, Todo $todo): void
    {
        foreach ($tasks as $task) {
            Task::create([
                'name' => $task['name'],
                'status' => "pending",
                'todo_id' => $todo->id
            ]);
        }
    }
}
