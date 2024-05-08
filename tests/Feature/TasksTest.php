<?php

namespace Tests\Feature\Api\V1;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_list_all_tasks()
    {
        Task::factory()->count(3)->create();

        // GET request to the listing endpoint
        $response = $this->getJson('/api/v1/tasks');

        // Assert response is successful
        $response->assertSuccessful();

        // Assert response contains task data
        $response->assertJsonStructure([
            'data' => [
                'data' => [
                    '*' => ['id', 'title', 'description', 'status']
                ]
            ]
        ]);
    }

    public function test_show_a_task()
    {
        $task = Task::factory()->create();
        $response = $this->getJson("/api/v1/tasks/{$task->id}");

        // Assert response is successful
        $response->assertSuccessful();

        // Assert response contains task data
        $response->assertJsonFragment(['id' => $task->id]);
    }

    public function test_create_a_task()
    {
        $taskData = Task::factory()->raw();

        $response = $this->postJson('/api/v1/tasks', $taskData);

        // Assert response is successful
        $response->assertSuccessful();

        // Assert task is created
        $this->assertDatabaseHas('tasks', $taskData);
    }

    public function test_update_a_task()
    {
        $task = Task::factory()->create();
        $updatedData = ['title' => 'Disrupt', 'description' => 'Disrupt Description', 'status' => 'completed'];

        $response = $this->putJson("/api/v1/tasks/{$task->id}", $updatedData);

        // Assert response is successful
        $response->assertSuccessful();

        // Assert task is updated
        $this->assertDatabaseHas('tasks', $updatedData);
    }

     public function test_delete_a_task()
     {
         $task = Task::factory()->create();
         // DELETE request to the destroy endpoint
         $response = $this->deleteJson("/api/v1/tasks/{$task->id}");

         // Assert Task is deleted
         $response->assertSuccessful();
         $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
