<?php

namespace App\Http\Controllers\SanctumTutorial;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SanctumTutorial\StoreTaskRequest;
use App\Traits\HttpResponse;

class TasksController extends Controller
{

    use HttpResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // need for resources to convert Collection data into json format
        return TaskResource::collection(
            Task::where("id","<",50)
            ->latest()
            ->get()
        );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = $request->safe()->all();
        $task = Task::create([
            'user_id' => Auth::user()->id,
            'name' => $task['name'],
            'description' => $task['description'],
            'priority' => $task['priority'],
        ]);
        return new TaskResource($task);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // user_id = 3
        // post_id = 21,127,239

        $response = Gate::inspect('view-task',$task);
        if($response->allowed())
        {
            return new TaskResource($task);

        }else {
            return $this->error('',$response->message(),403);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // dd('yes');
       $response = Gate::inspect("update-task", $task);
       if($response->allowed())
       {
           $task->update($request->all());
           return new TaskResource($task);
       }

       return $this->error('',$response->message(),403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $response = Gate::inspect("delete-task", $task);
       if($response->allowed())
       {
           $task->delete();
           return $this->success('',"You have successfull delete task");
       }

       return $this->error('',$response->message(),403);
    }


}
