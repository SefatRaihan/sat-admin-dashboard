<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{

    public static $visiblePermissions = [
        'update' => 'Update Profile',
    ];

    /**
     * Update the user's profile information.
     */

    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        try {
            $user = $request->user();

            // Fill user with validated data
            $user->fill($request->validated());

            // If email changed, reset email verification
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Handle password update
            if ($request->filled('password')) {
                $validated = $request->validateWithBag('updatePassword', [
                    'current_password' => ['required', 'current_password'],
                    'password' => ['required', Password::defaults()], // No confirmation needed
                ]);

                $user->password = Hash::make($validated['password']);
            }

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $request->validate([
                    'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                // Delete old image if exists
                if ($user->profile_image && file_exists(public_path('uploads/profile_images/' . $user->profile_image))) {
                    unlink(public_path('uploads/profile_images/' . $user->profile_image));
                }

                // Save new image
                $imageName = time() . '.' . $request->profile_image->extension();
                $request->profile_image->move(public_path('uploads/profile_images'), $imageName);

                $user->profile_image = $imageName;
            }

            // Save user after all changes
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Profile Updated Successfully',
                'user' => $user
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}
