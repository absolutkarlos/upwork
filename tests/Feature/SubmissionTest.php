<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Submission;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_submission()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.'
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(202); // Check for 202 Accepted
        $this->assertDatabaseHas('submissions', $data); // Verify data is in the database
    }
}