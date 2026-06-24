@extends('layouts.app')

@section('content')

<h1>Edit Product</h1>

<form action="/admin/products/{{ $product->id }}/update" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price</label>
        <input name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input name="stock" class="form-control" value="{{ $product->stock }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Image filename (in public/products)</label>
        <input name="image" class="form-control" value="{{ $product->image }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
</form>

<form action="/admin/products/{{ $product->id }}/delete" method="POST" class="mt-3">
    @csrf
    <button class="btn btn-danger">Delete</button>
</form>

@endsection
