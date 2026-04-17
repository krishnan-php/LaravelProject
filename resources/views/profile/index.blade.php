<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 2rem; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 1.5rem; color: #333; }
        .profile-image { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; }
        .info { margin-bottom: 1rem; }
        .info label { font-weight: bold; color: #555; }
        .info p { margin-top: 0.25rem; color: #333; }
        .actions { display: flex; gap: 1rem; margin-top: 2rem; }
        .btn { padding: 0.75rem 1.5rem; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; text-align: center; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn:hover { opacity: 0.9; }
        .success { background: #d4edda; color: #155724; padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container">
        <h2>My Profile</h2>
        
        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($user->profile_image)
            @php
                $url = Storage::disk('s3')->temporaryUrl($user->profile_image, now()->addMinutes(10));
            @endphp
            <img src="{{ $url }}" alt="Profile" class="profile-image">
        @endif

        <div class="info">
            <label>Name:</label>
            <p>{{ $user->name }}</p>
        </div>

        <div class="info">
            <label>Email:</label>
            <p>{{ $user->email }}</p>
        </div>

        <div class="actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
            <a href="{{ route('products.index') }}" class="btn btn-success">Products</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
</body>
</html>
