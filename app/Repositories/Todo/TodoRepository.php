<?php

namespace App\Repositories\Todo;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoRepository implements TodoRepositoryInterface
{

    public function create(Request $request): Todo
    {
        $todo = Todo::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => "pending",
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
        ]);
        

        return $todo;
    }

    public function read(int $id): Todo
    {
        return Todo::find($id);
    }

    public function update(Request $request, int $id): Todo
    {
        $todo = $this->read($id);
        $todo->update([
            'name' => $request->name ? $request->name : $todo->name,
            'description' => $request->description ? $request->description : $todo->description,
            //'status' => $request->status ? $request->status : $todo->status,
            'end_date' => $request->end_date ? $request->end_date : $todo->end_date,
            'end_time' => $request->end_time ? $request->end_time : $todo->end_time,
        ]);
       
        return $todo;
    }

    public function delete(int $id): void
    {
        $this->read($id)->delete();
    }

    public function withTasks(int $id): Todo
    {
        return Todo::where('id',$id)->with('tasks')->first();
    }

    public function finish(int $id): Todo
    {
        $todo = $this->read($id);
        $todo->status = 'finished';
        $todo->save();
        return $todo;
    }
    public function pending(int $id): Todo
    {
        $todo = $this->read($id);
        $todo->status = 'pending';
        $todo->save();
        return $todo;
    }
}
