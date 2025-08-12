<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     title="User Management API",
 *     version="1.0.0",
 *     description="API RESTful untuk manajemen pengguna - Backend Skill Test",
 *     @OA\Contact(
 *         name="Wildan Miladji",
 *         email="wildan@example.com"
 *     )
 * )
 * @OA\Server(
 *     url="http://localhost:8000",
 *     description="Development Server"
 * )
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Wildan Miladji"),
 *     @OA\Property(property="email", type="string", format="email", example="wildan@example.com"),
 *     @OA\Property(property="phone", type="string", example="08123456789"),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="department", type="string", example="Backend Developer"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00Z")
 * )
 */
abstract class Controller
{
    //
}