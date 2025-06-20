<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
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

            if (auth()->user()->student) {
                if ($request->hasFile('profile_image')) {

                    $request->validate([
                        'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
                    ]);

                    // Delete old image if exists
                    if ($user->profile_image && file_exists(public_path('student_photos/' . $user->profile_image))) {
                        unlink(public_path('student_photos/' . $user->profile_image));
                    }

                    $photoPath = $request->file('profile_image')->store('student_photos', 'public');
                    $user->profile_image = $photoPath;
                    auth()->user()->student->update([
                        'image' =>  $photoPath
                    ]);
                }
                auth()->user()->student->update([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'date_of_birth' => $request->date_of_birth,
                 ]);

            } else {
                // Handle profile image upload
                if ($request->hasFile('profile_image')) {
                    $request->validate([
                        'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg',
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
            }

            // Save user once after all changes
            $user->save();

            return Redirect::back()->with('status', 'Profile Updated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Ensure the directory exists
        $directory = public_path('uploads/profile_images');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Generate a unique filename
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move($directory, $filename);

        // Update the student's image path in the database (relative path)
        $path = 'uploads/profile_images/' . $filename;
        Auth::user()->student->update(['image' => $path]);

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        Auth::user()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function updateDob(Request $request)
    {
        $request->validate([
            'date_of_birth' => 'required|date',
        ]);

        Auth::user()->student->update([
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->back()->with('success', 'Date of birth updated successfully.');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        Auth::user()->update([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Email updated successfully.');
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        Auth::user()->update([
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Phone number updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
