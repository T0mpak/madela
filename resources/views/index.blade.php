@extends('layouts.layout')

@section('content')
<!-- Main background page starts -->
<div class="main">
    <img src="{{ asset('/images/bg.png') }}" alt="background image">
    <form action="{{ route('search') }}" style="padding: 0; margin: 0;">
        <input class="search" type="text" placeholder="Search..." name="s">
        <input type="submit" style="display: none;">
    </form>
</div>
<!-- Main background page ends -->

<!-- Categories starts-->
<div class="categories-title">
    <a href="#">CATEGORIES</a>
</div>

<!-- Category list starts-->
<div class="container">
    <div class="category-row">
        <div class="category-card">
            <a href="{{ route('categories.show', 1) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/mouse.png') }}" alt="mouse">
                </div>
            </a>
            <a href="{{ route('categories.show', 1) }}">
                <div class="category-name">
                    Gaming Mice
                </div>
            </a>
        </div>

        <div class="category-card">
            <a href="{{ route('categories.show', 2) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/keyboard.png') }}" alt="keyboard">
                </div>
            </a>
            <a href="{{ route('categories.show', 2) }}">
                <div class="category-name">
                    Keyboards
                </div>
            </a>
        </div>

        <div class="category-card">
            <a href="{{ route('categories.show', 3) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/headphone.png') }}" alt="headphone">
                </div>
            </a>
            <a href="{{ route('categories.show', 3) }}">
                <div class="category-name">
                    Headphones
                </div>
            </a>
        </div>
    </div>

    <div class="category-row">
        <div class="category-card">
            <a href="{{ route('categories.show', 4) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/mousepad.png') }}" alt="mousepad">
                </div>
            </a>
            <a href="{{ route('categories.show', 4) }}">
                <div class="category-name">
                    Mouse pads
                </div>
            </a>
        </div>

        <div class="category-card">
            <a href="{{ route('categories.show', 5) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/monitor.png') }}" alt="monitor">
                </div>
            </a>
            <a href="{{ route('categories.show', 5) }}">
                <div class="category-name">
                    Monitors
                </div>
            </a>
        </div>

        <div class="category-card">
            <a href="{{ route('categories.show', 6) }}">
                <div class="category-image">
                    <img src="{{ asset('/images/categories/webcamera.png') }}" alt="webcamera">
                </div>
            </a>
            <a href="{{ route('categories.show', 6) }}">
                <div class="category-name">
                    Others Devices
                </div>
            </a>
        </div>
    </div>
</div>
<!-- Category list ends -->
<!-- Categories ends -->

<!-- Promotion starts -->
<div class="promotion-title">
    <a href="{{ route('promotions.index') }}">PROMOTIONS</a>
</div>

<div class="container-of-promotionsANDfooter">
    <div class="promoes">
        <div class="promo">
            <a href="{{ route('promotions.show', $promotions[0]->id) }}"><img src="{{ $promotions[0]->get_first_photo_path() }}" alt="buket"></a>
        </div>

        <!-- ------------------------------------------- -->

        <div class="promo">
            <a href="{{ route('promotions.show', $promotions[1]->id) }}"><img src="{{ $promotions[1]->get_first_photo_path() }}" alt="sale"></a>
        </div>
    </div>
</div>
<!-- Promotion ends -->
@endsection
