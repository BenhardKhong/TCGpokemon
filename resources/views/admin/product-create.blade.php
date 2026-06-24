@extends('layouts.app')

@section('content')

<h1>Add Product</h1>

<form action="/admin/products" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Image filename (in public/products)</label>
        <input name="image" class="form-control" required>
    </div>

    <button class="btn btn-primary">Save</button>
</form>

@endsection
