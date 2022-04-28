@extends('layouts.layout')

@section('content')
    <div class="container-of-promotionsANDfooter">
        @foreach($promotions as $promotion)
            @if ($loop->odd)
                <div class="promoes" style="margin: 50px 0px;">
            @endif
                <div class="promo">
                    <a href="{{ route('promotions.show', $promotion->id) }}"><img src="{{ asset($promotion->get_first_photo_path()) }}" alt="{{ $promotion->get_first_photo_path() }}" height="100px"></a>
                </div>
            @if ($loop->even or $loop->last)
                </div>
            @endif
        @endforeach
    </div>
@endsection
