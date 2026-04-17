<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 2rem; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 1.5rem; color: #333; }
        .profile-image { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; color: #555; font-weight: bold; }
        input { width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; }
        .error { color: #dc3545; font-size: 0.875rem; margin-top: 0.25rem; }
        .actions { display: flex; gap: 1rem; margin-top: 2rem; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>

        @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" class="profile-image">
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Profile Image</label>
                <input type="file" name="profile_image" accept="image/*">
                @error('profile_image')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('profile.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
