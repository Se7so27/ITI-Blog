@extends('layouts.app')

@section('title', $post['title']) 

@section('content') 
<div class="card mb-4">
    <div class="card-header">
        <h2>{{ $post['title'] }}</h2>
    </div>
    <div class="card-body">
        <p>{{ $post['description'] }}</p>
    </div>
</div>

@endsection