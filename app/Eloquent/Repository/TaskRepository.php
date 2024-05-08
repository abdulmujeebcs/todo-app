<?php

namespace App\Eloquent\Repository;

use App\Eloquent\Interface\TaskInterface;
use App\Http\Requests\V1\TaskRequest;
use App\Models\Task;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TaskRepository implements TaskInterface {
    
    public function __construct(public Task $model){}

    public function findAll($filterBy) {
        $perPage = config('app.per_page');
        
        $query = $this->model
        ->select(['id', 'title', 'description', 'status']);
        
        if ($filterBy->title) {
            $query = $query->where('title', 'like', $filterBy->title . '%');
        }
    
        if ($filterBy->status) {
            $query = $query->where('status', $filterBy->status);
        }

        if($filterBy->per_page) {
           $perPage = (int) $filterBy->per_page;
        }

        return $query
        ->paginate($perPage);
    }

    public function store($request) {
       return $this->model->create($request);
    }

    public function findTask($taskId) {
        $task = $this->model->find($taskId);
        if(!$task) {
            throw new NotFoundHttpException();
        }
        return $task;
    }

    public function update($data, $taskId) {
      $task = $this->findTask($taskId);
      $task->update($data);
      return $task;
    }

    public function destroy($taskId) {
        $task = $this->findTask($taskId);
        return $task->delete();
    }
}