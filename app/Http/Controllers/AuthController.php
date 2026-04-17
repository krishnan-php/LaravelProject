<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use function Illuminate\Log\log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('profile.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:2',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // $file = $request->file('profile_image');
        // if (!$file) {
        //     return back()->withErrors(['profile_image' => 'No file was received by the server.']);
        // }
        // if (!$file->isValid()) {
        //     Log::error('Upload invalid.', [
        //         'error_code' => $file->getError(),
        //         'error_message' => $file->getErrorMessage(),
        //         'client_name' => $file->getClientOriginalName(),
        //         'client_size' => $file->getSize(),
        //     ]);
        //     return back()->withErrors(['profile_image' => 'Upload failed: ' . $file->getErrorMessage()]);
        // }

        // // Upload to S3 (private bucket)
        // try {
        //     $path = $file->store('profiles', 's3');
        // } catch (\Throwable $e) {
        //     Log::error('S3 upload exception.', [
        //         'email' => $request->email,
        //         'error' => $e->getMessage(),
        //     ]);
        //     return back()->withErrors(['profile_image' => 'Profile image upload failed.']);
        // }
        // if (!$path) {
        //     Log::error('S3 upload failed (empty path).', [
        //         'email' => $request->email,
        //     ]);
        //     return back()->withErrors(['profile_image' => 'Profile image upload failed.']);
        // }

        // Generate temporary URL to view it (valid for 10 minutes)
        // Log::error($path);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => "",
        ]);

        Auth::login($user);
        return redirect()->route('profile.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
