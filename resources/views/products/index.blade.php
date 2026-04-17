<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 2rem; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        h2 { color: #1a1a2e; font-size: 1.6rem; }
        .btn-add { background: #6c63ff; color: white; padding: 0.6rem 1.2rem; border-radius: 8px; text-decoration: none; font-size: 0.9rem; transition: background 0.2s; }
        .btn-add:hover { background: #574fd6; }
        .success { background: #d4edda; color: #155724; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.2rem; }
        .empty { background: white; text-align: center; padding: 3rem; border-radius: 12px; color: #aaa; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .empty span { font-size: 3rem; display: block; margin-bottom: 0.5rem; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.2rem; }
        .card { background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,0.06); transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
        .card-name { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 0.4rem; }
        .card-desc { font-size: 0.85rem; color: #888; margin-bottom: 1rem; min-height: 36px; }
        .card-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f0f0f0; padding-top: 0.8rem; }
        .price { font-size: 1.2rem; font-weight: 700; color: #6c63ff; }
        .badge { background: #eef; color: #6c63ff; padding: 0.25rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
        .date { font-size: 0.75rem; color: #bbb; margin-top: 0.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🛍️ Products</h2>
            <a href="{{ route('products.create') }}" class="btn-add">+ Add Product</a>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if($products->isEmpty())
            <div class="empty">
                <span>📦</span>
                No products yet. <a href="{{ route('products.create') }}" style="color:#6c63ff;">Add your first one!</a>
            </div>
        @else
            <div class="grid">
                @foreach($products as $product)
                    <div class="card">
                        <div class="card-name">{{ $product->name }}</div>
                        <div class="card-desc">{{ $product->description ?: 'No description provided.' }}</div>
                        <div class="card-footer">
                            <span class="price">${{ number_format($product->price, 2) }}</span>
                            <span class="badge">Qty: {{ $product->quantity }}</span>
                        </div>
                        <div class="date">Added {{ $product->created_at->diffForHumans() }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
