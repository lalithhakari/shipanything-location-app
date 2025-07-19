<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    /**
     * Get user's location history
     */
    public function getUserLocations(Request $request): JsonResponse
    {
        // Get user context from middleware
        $userId = $request->attributes->get('user_id');
        $userEmail = $request->attributes->get('user_email');

        if (!$userId) {
            return response()->json([
                'error' => 'User context not found'
            ], 400);
        }

        // Mock location data - replace with actual database queries
        $locations = [
            [
                'id' => 1,
                'user_id' => $userId,
                'latitude' => 37.7749,
                'longitude' => -122.4194,
                'address' => 'San Francisco, CA',
                'timestamp' => now()->subHours(2)->toISOString(),
            ],
            [
                'id' => 2,
                'user_id' => $userId,
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'address' => 'New York, NY',
                'timestamp' => now()->subDays(1)->toISOString(),
            ]
        ];

        return response()->json([
            'message' => 'Location data retrieved successfully',
            'user' => [
                'id' => $userId,
                'email' => $userEmail,
            ],
            'locations' => $locations,
            'total' => count($locations),
        ]);
    }

    /**
     * Create a new location entry
     */
    public function createLocation(Request $request): JsonResponse
    {
        $userId = $request->attributes->get('user_id');

        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string|max:255',
        ]);

        // Mock creation - replace with actual database logic
        $location = [
            'id' => rand(1000, 9999),
            'user_id' => $userId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'address' => $request->address,
            'timestamp' => now()->toISOString(),
        ];

        return response()->json([
            'message' => 'Location created successfully',
            'location' => $location,
        ], 201);
    }
}
