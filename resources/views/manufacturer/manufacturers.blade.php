@extends('layouts.layout')

@section('content')

    @foreach($manufacturers as $manufacturer)
        {{ $manufacturer->id }}
        {{ $manufacturer->name }}
        rating - {{ $manufacturer->rating }}
        <br><br>
    @endforeach

@endsection
