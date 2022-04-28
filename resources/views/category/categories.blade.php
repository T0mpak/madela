@extends('layouts.layout')

@section('content')

@foreach($categories as $category)
    {{ $category->name }}
    <img src="{{ asset($category->get_first_photo_path()) }}" alt="{{ $category->get_first_photo_path() }}" height="100px">
    {{ $category->description }}
    {{ $category->code }}
    <a href="{{ route('categories.show', $category->id) }}">Show all prodcuts for {{ $category->name }}'s category</a>
    <br><br>
@endforeach

@endsection
