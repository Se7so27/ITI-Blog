@extends('layouts.app')

@section('title', $post['title']) 

@section('content') 
<div class="card mb-4">
    <div class="card-header">
        <h2>{{ $post['title'] }}</h2>
        <small class="text-muted">Slug: {{ $post['slug'] }}</small>
    </div>
    <div class="card-body">
        <p>{{ $post['body'] }}</p>
    </div>
</div>

@endsection