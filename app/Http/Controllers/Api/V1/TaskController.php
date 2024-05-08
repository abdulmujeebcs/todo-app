<?php

namespace App\Http\Controllers\Api\V1;

use App\Eloquent\Interface\TaskInterface;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\V1\TaskRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskController extends Controller
{
    public function __construct(public TaskInterface $taskRepository) {}

    public function index(Request $request)
    {
        $tasks = $this->taskRepository->findAll($request);
        return response()->success(
            data: $tasks,
            message: __('Tasks listing successfull.')
        );
    }

    public function store(TaskRequest $request)
    {
        $task = $this->taskRepository->store($request->validated());

        return response()->success(
            data: $task,
            message: __('Task has been created successfully.')
        );
    }

    public function update(TaskRequest $request, $id)
    {
        try {
            $data = $this->taskRepository->update($request->validated(), $id);
            return response()->success(
                message: __('Task has been updated successfully.'),
                data: $data
            );
        } catch (NotFoundHttpException $exception) {
            return response()->error(
                status: $exception->getStatusCode(),
                message: __('Sorry no task available for the given Id.')
            );
        }
    }

    public function show($id)
    {
        try {
            $task = $this->taskRepository->findTask($id);
            return response()->success(
                message: __('Task details fetched sucessfully.'),
                data: $task,
            );
        } catch (NotFoundHttpException $exception) {
            return response()->error(
                status: $exception->getStatusCode(),
                message: __('Sorry no task available for the given Id.')
            );
        }
    }

    public function destroy($id)
    {
        try {
            $this->taskRepository->destroy($id);
            return response()->success(
                message: __('Task has been deleted sucessfully.'),
            );
        } catch (NotFoundHttpException $exception) {
            return response()->error(
                status: $exception->getStatusCode(),
                message: __('Unable to find task.')
            );
        }
    }
}
