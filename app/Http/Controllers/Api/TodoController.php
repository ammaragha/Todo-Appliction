<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinishTodoRequest;
use App\Http\Requests\Api\StoreTodoRequest;
use App\Http\Requests\Api\UpdateTodoRequest;
use App\Models\Todo;
use App\Repositories\Task\TaskRepository;
use App\Repositories\Todo\TodoRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use ResponseTrait;

    private TodoRepositoryInterface $todoRepo;

    /**
     * @param App\Repositories\Todo\TodoRepositoryInterface
     * 
     */
    public function __construct(TodoRepositoryInterface $todoRepo)
    {
        $this->todoRepo = $todoRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Todo::orderBy('status', 'DESC')->paginate(20); // to fetch pending first
        return $this->succWithData($data, 'Todo Lists');
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //return view
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $data = $this->todoRepo->create($request);
        if (isset($request->tasks) && count($request->tasks) > 0) {
            (new TaskRepository)->createManyTasks($request->tasks, $data->id);
            $data = $this->todoRepo->withTasks($data->id);
        }
        return $this->succWithData($data, 'new todo has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Todo::find($id);
        if (!$data)
            return $this->errMsg('No Todo Found');
        $data = $this->todoRepo->withTasks($data->id);
        return $this->succWithData($data, 'Todo item');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->todoRepo->read($id);
        return $this->succWithData($data, 'Edit Todo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, $id)
    {
        if (!Todo::find($id))
            return $this->errMsg('not real Todo item');

        if ($request->status == 'finished')
            $this->todoRepo->finish($id);
        elseif ($request->status == 'pending')
            $this->todoRepo->pending($id);

        $data = $this->todoRepo->update($request, (int) $id);

        return $this->succWithData($data, 'Todo item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Todo::find($id))
            return $this->errMsg('not real Todo item');
        $this->todoRepo->delete($id);
        (new TaskRepository)->deleteAllTasksFor($id);
        return $this->succMsg('Todo item deleted');
    }

    /**
     * Finish todo with it tasks if exist
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finish(FinishTodoRequest $request)
    {
        $this->todoRepo->finish($request->id);
        $tasks = $this->todoRepo->withTasks($request->id)->tasks;
        if (count($tasks) > 0) (new TaskRepository)->finishAllTasksFor($request->id);
        return $this->succMsg('Todo finished');
    }
}
