<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 100%; max-width: 480px; }
        h2 { color: #1a1a2e; margin-bottom: 1.5rem; font-size: 1.5rem; }
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; margin-bottom: 0.4rem; color: #555; font-size: 0.9rem; font-weight: 600; }
        input, textarea { width: 100%; padding: 0.7rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; transition: border 0.2s; }
        input:focus, textarea:focus { outline: none; border-color: #6c63ff; }
        textarea { resize: vertical; min-height: 80px; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .error { color: #e74c3c; font-size: 0.8rem; margin-top: 0.3rem; }
        .btn { width: 100%; padding: 0.8rem; background: #6c63ff; color: white; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; margin-top: 0.5rem; transition: background 0.2s; }
        .btn:hover { background: #574fd6; }
        .link { text-align: center; margin-top: 1rem; font-size: 0.9rem; }
        .link a { color: #6c63ff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <h2>➕ Add New Product</h2>
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Wireless Headphones">
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label>Description <span style="color:#aaa;font-weight:400">(optional)</span></label>
                <textarea name="description" placeholder="Brief product description...">{{ old('description') }}</textarea>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Price ($)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00">
                    @error('price')<div class="error">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="0" placeholder="0">
                    @error('quantity')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>
            <button type="submit" class="btn">Add Product</button>
        </form>
        <div class="link">
            <a href="{{ route('products.index') }}">← Back to Products</a>
        </div>
    </div>
</body>
</html>
