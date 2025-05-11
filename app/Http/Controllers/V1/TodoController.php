<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTodoRequest;
use App\Http\Requests\V1\UpdateTodoRequest;
use App\Http\Resources\V1\Todo\TodoApiResource;
use App\Http\Resources\V1\Todo\TodoApiResourceCollection;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::where('user_id',Auth::guard('sanctum')->id())->paginate();

        return ApiResponse::withData(new TodoApiResourceCollection($todos))->withMessage("Todos Returned .")->send();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = $request->validated();

        $todo['user_id'] = Auth::guard('sanctum')->id();

        $todo = Todo::create($todo);

        return ApiResponse::withData(new TodoApiResource($todo))->withMessage("Todo Returned .")->send();
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        if($todo->user_id !== Auth::guard('sanctum')->id()){
            return ApiResponse::withStatus(403)->withMessage("Unauthorized .")->send();
        }

        return ApiResponse::withData(new TodoApiResource($todo))->withMessage("Todo Returned .")->send();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        if($todo->user_id !== Auth::guard('sanctum')->id()){
            return ApiResponse::withStatus(403)->withMessage("Unauthorized .")->send();
        }

        $todo->update($request->validated());

        return ApiResponse::withData(new TodoApiResource($todo))->withMessage("Todo Returned .")->send();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return ApiResponse::withMessage("Todo Deleted .")->send();
    }
}
