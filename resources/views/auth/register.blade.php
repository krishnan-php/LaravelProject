<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 2rem 0; }
        .container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        h2 { margin-bottom: 1.5rem; color: #333; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #555; }
        input { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; }
        button { width: 100%; padding: 0.75rem; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1rem; }
        button:hover { background: #218838; }
        .error { color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; }
        .link { text-align: center; margin-top: 1rem; }
        .link a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="profile_image" accept="image/*">
                @error('profile_image')<div class="error">{{ $message }}</div>@enderror
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="link">
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
    </div>
</body>
</html>
