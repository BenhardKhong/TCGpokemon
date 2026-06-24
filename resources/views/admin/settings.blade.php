@extends('layouts.app')

@section('content')

<h1>Admin Settings</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="/admin/settings" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Epic Chance (%)</label>
        <input name="epic_chance" class="form-control" value="{{ $setting?->epic_chance ?? 1 }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price Normal</label>
        <input name="price_50" class="form-control" value="{{ $setting?->price_50 ?? 50000 }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price Elite</label>
        <input name="price_150" class="form-control" value="{{ $setting?->price_150 ?? 150000 }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Price Premium</label>
        <input name="price_300" class="form-control" value="{{ $setting?->price_300 ?? 300000 }}" required>
    </div>

    <button class="btn btn-primary">Save</button>
</form>

@endsection
