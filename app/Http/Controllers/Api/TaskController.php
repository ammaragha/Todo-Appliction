<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinishTaskRequest;
use App\Http\Requests\Api\StoreTaskRequest;
use App\Http\Requests\Api\UpdateTaskRequest;
use App\Models\Task;
use App\Repositories\Task\TaskRepositoryInterface;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use ResponseTrait;

    private TaskRepositoryInterface $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::orderBy('status', 'DESC')->paginate(20); // to fetch pending first
        return $this->succWithData($data, 'Tasks List');
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
    public function store(StoreTaskRequest $request)
    {
        $data = $this->taskRepo->create($request);
        return $this->succWithData($data, 'new Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Task::find($id))
            return $this->errMsg('not real Task');
        $data = $this->taskRepo->read($id);
        return $this->succWithData($data, 'Todo task');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->taskRepo->read($id);
        return $this->succWithData($data, 'Todo task');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        if (!Task::find($id))
            return $this->errMsg('not real Task ');

        if ($request->status == 'finished')
            $this->taskRepo->finish($id);
        elseif ($request->status == 'pending')
            $this->taskRepo->pending($id);

        $data = $this->taskRepo->update($request, (int) $id);
        return $this->succWithData($data, 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Task::find($id))
            return $this->errMsg('not real Task');
        $this->taskRepo->delete($id);
        return $this->succMsg('Task deleted');
    }

    /**
     * Finish todo with his tasks if exist
     * 
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finish(FinishTaskRequest $request)
    {
        $this->taskRepo->finish($request->id);
        return $this->succMsg('Todo finished');
    }
}
