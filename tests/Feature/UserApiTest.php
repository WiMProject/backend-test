<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_users(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08123456789',
            'department' => 'IT',
            'is_active' => true,
        ]);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => [
                        '*' => ['id', 'name', 'email', 'phone', 'is_active', 'department', 'created_at', 'updated_at']
                    ]
                ]);
    }

    public function test_can_create_user(): void
    {
        $userData = [
            'name' => 'Wildan Miladji',
            'email' => 'wildan@example.com',
            'phone' => '08123456789',
            'department' => 'Backend Developer',
            'password' => 'password123',
            'is_active' => true,
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => ['id', 'name', 'email', 'phone', 'is_active', 'department', 'created_at', 'updated_at']
                ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Wildan Miladji',
            'email' => 'wildan@example.com',
            'phone' => '08123456789',
            'department' => 'Backend Developer',
        ]);
    }

    public function test_validates_user_creation(): void
    {
        $response = $this->postJson('/api/users', [
            'name' => '',
            'email' => 'invalid-email',
            'phone' => '123',
            'password' => 'short',
        ]);

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['name', 'email', 'phone', 'password', 'department']);
    }

    public function test_can_show_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08123456789',
            'department' => 'IT',
        ]);

        $response = $this->getJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => ['id', 'name', 'email', 'phone', 'is_active', 'department', 'created_at', 'updated_at']
                ]);
    }

    public function test_can_update_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08123456789',
            'department' => 'IT',
        ]);

        $updateData = [
            'name' => 'Updated User',
            'department' => 'HR',
        ];

        $response = $this->putJson("/api/users/{$user->id}", $updateData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'success',
                    'message',
                    'data' => ['id', 'name', 'email', 'phone', 'is_active', 'department', 'created_at', 'updated_at']
                ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User',
            'department' => 'HR',
        ]);
    }

    public function test_can_delete_user(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '08123456789',
            'department' => 'IT',
        ]);

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    'message' => 'Pengguna berhasil dihapus'
                ]);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}