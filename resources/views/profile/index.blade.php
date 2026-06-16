<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }

        .card { background: white; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.08); width: 100%; max-width: 480px; overflow: hidden; }

        .card-header { background: linear-gradient(135deg, #6c63ff, #48c6ef); padding: 2.5rem 2rem; text-align: center; position: relative; }
        .avatar-wrap { position: relative; display: inline-block; margin-bottom: 1rem; }
        .avatar { width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        .avatar-placeholder { width: 100px; height: 100px; border-radius: 50%; background: rgba(255,255,255,0.3); border: 4px solid white; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: white; }
        .card-header h2 { color: white; font-size: 1.4rem; font-weight: 700; }
        .card-header p { color: rgba(255,255,255,0.85); font-size: 0.9rem; margin-top: 0.25rem; }

        .card-body { padding: 2rem; }

        .success { background: #d4edda; color: #155724; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; border-left: 4px solid #28a745; }

        .info-row { display: flex; align-items: center; gap: 1rem; padding: 0.9rem 0; border-bottom: 1px solid #f5f5f5; }
        .info-row:last-of-type { border-bottom: none; }
        .info-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }
        .icon-name { background: #eef0ff; }
        .icon-email { background: #fff0f0; }
        .info-text label { display: block; font-size: 0.75rem; color: #aaa; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
        .info-text p { color: #333; font-size: 0.95rem; margin-top: 0.15rem; font-weight: 500; }

        .divider { height: 1px; background: #f0f0f0; margin: 1.5rem 0; }

        .actions { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; }
        .actions .full { grid-column: span 2; }
        .btn { padding: 0.7rem 1rem; border: none; border-radius: 10px; cursor: pointer; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 0.4rem; font-size: 0.88rem; font-weight: 600; transition: transform 0.15s, box-shadow 0.15s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
        .btn-primary { background: #6c63ff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-secondary { background: #f0f2f5; color: #555; }
        .btn-danger { background: #fff0f0; color: #dc3545; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="avatar-wrap">
                @if($user->profile_image)
                    @php $url = Storage::disk('s3')->temporaryUrl($user->profile_image, now()->addMinutes(10)); @endphp
                    <img src="{{ $url }}" alt="Profile" class="avatar">
                @else
                    <div class="avatar-placeholder">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
            </div>
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="success">✓ {{ session('success') }}</div>
            @endif

            <div class="info-row">
                <div class="info-icon icon-name">👤</div>
                <div class="info-text">
                    <label>Full Name</label>
                    <p>{{ $user->name }}</p>
                </div>
            </div>
            <div class="info-row">
                <div class="info-icon icon-email">✉️</div>
                <div class="info-text">
                    <label>Email Address</label>
                    <p>{{ $user->email }}</p>
                </div>
            </div>

            <div class="divider"></div>

            <div class="actions">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">✏️ Edit Profile</a>
                <a href="{{ route('products.index') }}" class="btn btn-success">🛍️ Products</a>
                <form method="POST" action="{{ route('logout') }}" style="display:contents">
                    @csrf
                    <button type="submit" class="btn btn-secondary">🚪 Logout</button>
                </form>
                <form method="POST" action="{{ route('profile.destroy') }}" style="display:contents" onsubmit="return confirm('Delete your account? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑️ Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
