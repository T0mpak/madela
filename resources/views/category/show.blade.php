@extends('layouts.layout')

@section('custom-css')
    <style>
        .quantity {
            display: inline-block;
        }
    </style>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function(){
            $.ajax({
                type: 'GET',
                url: '{{ route('basket.already') }}',
                dataType: 'json',
                success: function(data_from_server){
                    let products_id = data_from_server.products_id;
                    for (let product_id of products_id) {
                        let str = ".basket_add_input_product_id[value='"+product_id+"']";
                        $(str).parent().css('display', 'none');
                        $(str).parent().prev().css('display', 'none');
                        $(str).parent().next().css('display', 'inline-block');
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $(".plus").click(function(){
                var $plus_button = $(this);
                var val = parseInt($plus_button.siblings(".number").val());
                val++;
                if(val >= 1){
                    $plus_button.siblings(".number").attr("value", val);
                }
            });
            $(".minus").click(function(){
                var $minus_button = $(this);
                var val= parseInt($minus_button.siblings(".number").val());
                val--;
                if(val >= 1){
                    $minus_button.siblings(".number").attr("value", val);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $( ".add_basket" ).submit(function( event ) {
                var $this = $(this);
                $this.next(".remove_basket").css('display', 'inline-block');
                $this.css('display', 'none');
                $this.prev(".quantity").css('display', 'none');
                var $quantity = parseInt($this.prev(".quantity").find(".number").val());
                var data = $this.serializeArray();
                data.push({name: "quantity", value: $quantity});
                $.ajax({
                    type: 'POST',
                    url: '{{ route('basket.add') }}',
                    data: data,
                    dataType: 'json',
                    success: function(data_from_server){
                        $('#count_basket').text(data_from_server.overall_count_basket);
                    }
                }).done(function(data_from_server) {
                    console.log(data_from_server);
                });
                event.preventDefault();
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $( ".remove_basket" ).submit(function( event ) {
                var $this = $(this);
                $this.css('display', 'none');
                $this.prev(".add_basket").css('display', 'inline-block');
                $this.prev(".add_basket").prev(".quantity").css('display', 'inline-block');
                var data = $this.serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('basket.remove') }}',
                    data: data,
                    dataType: 'json',
                    success: function(data_from_server){
                        $('#count_basket').text(data_from_server.overall_count_basket);
                    }
                }).done(function(data_from_server) {
                    console.log(data_from_server.message);
                });
                event.preventDefault();
            });
        });
    </script>
@endsection

@section('content')

    <div style="text-align: right;">
        <h3 style="margin-right: 180px;">Filter Products</h3>
        <form action="{{ route('filter.products') }}" method="get">
            <label for=""><i>Filter by price</i></label>
            <input type="number" id="price_from" name="price_min" placeholder="Minimum">
            <input type="number" id="price_until" name="price_max" placeholder="Maximum">
            <br>
            <label for=""><i>Filter by manufacturers</i></label>
            @foreach($manufacturers as $manufacturer)
                <label><input type="checkbox" name="manufacturers[]" value="{{ $manufacturer->id }}">{{$manufacturer->name}}</label>
            @endforeach
            <br><br>
            <input type="hidden" name="category" value="{{ $category->id }}">
            <input type="submit" value="Filter!">
        </form>
    </div>
    <br>
    <hr>
    <br>

    {{ $category->name }}
    <img src="{{ asset($category->get_first_photo_path()) }}" alt="{{ $category->get_first_photo_path() }}" height="100px">
    {{ $category->description }}
    {{ $category->code }}
    <hr>
    <br>
    @foreach($products as $product)
        <b>{{ $product->id }}</b>
        <img src="{{ asset($product->get_first_photo_path()) }}" alt="{{ $product->get_first_photo_path() }}" height="100px">
        <b>{{ $product->name }}</b>
        {{ $product->description }}
        {{ $product->manufacturer->name }}
        {{ $product->category->name }}
        {{ $product->code }}
        {{ $product->price }}tenge


        <div class="quantity">
            <button class="minus">-</button>
            <input class="number" type="number" value="1" readonly>
            <button class="plus">+</button>
        </div>
        <form action="{{ route('basket.add') }}" class="add_basket" method="post" style="display: inline-block; margin: 0;">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id" class="basket_add_input_product_id">
            <button type="submit">Add to basket</button>
        </form>

        <form action="{{ route('basket.remove') }}" class="remove_basket" method="post" style="display: none; margin: 0;">
            @csrf
            <input type="hidden" value="{{$product->id}}" name="product_id">
            <button type="submit">Remove from basket</button>
        </form>


        {{--        <form action="{{ route('comparison.add') }}" method="post" style="display: inline-block; margin: 0;">--}}
        {{--            @csrf--}}
        {{--            <input type="hidden" value="{{$product->id}}" name="id">--}}
        {{--            <button type="submit">Add to comparison</button>--}}
        {{--        </form>--}}
        <br><br>
    @endforeach

    {!! $products->render() !!}

@endsection
