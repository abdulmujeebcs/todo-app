<?php

namespace App\Eloquent\Interface;

use App\Http\Requests\V1\TaskRequest;
use Illuminate\Console\View\Components\Task;

interface TaskInterface {
    public function findAll($filters);

    public function store(TaskRequest $request);

    public function findTask($taskId);

    public function update(TaskRequest $request, $taskId);

    public function destroy($taskId);
}