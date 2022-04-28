@extends('layouts.layout')

@section('content')
    <div style="text-align: center;">
    ID - {{ $promotion->id }}
    <br>
    Promocode - <b>{{ $promotion->promocode }}</b>
    <br>
    Discount - {{ $promotion->discount }}
    </div>
    <br>
    <div class="promo" style="align-content: center; width: 100%; align-items: center;">
        <a href="#"><img src="{{ asset($promotion->get_first_photo_path()) }}" alt="{{ $promotion->get_first_photo_path() }}" height="100px"></a>
    </div>
@endsection
