@extends('layouts.layout')

@section('custom-js')

    <script>
        $(document).ready(function(){
            $( ".add_promocode" ).submit(function( event ) {
                var $this = $(this);
                var data = $this.serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('orders.discount') }}',
                    data: data,
                    dataType: 'json',
                    success: function(data_from_server){
                        $( "#discount" ).text(data_from_server.discount);
                        $('.total_price').each(function() {
                            var total_price = parseInt($(this).text());
                            var total_price = total_price - (total_price * (data_from_server.discount / 100));
                            $(this).text(total_price);

                            $("#promocode_hidden").val($("#promocode_input").val());
                        });
                    }
                }).done(function(data_from_server) {
                    $this.css('display', 'none');
                    $( "#discount_p" ).css('display', 'block');
                });
                event.preventDefault();
            });
        });
    </script>

@endsection

@section('content')

    @php
        $total_price = 0;
    @endphp

    <h1>Basket Page</h1>

    @if($products_in_basket->count() != 0)
<div style="display: flex; justify-content: space-between;">
    <div style="width: 50%;">
        @foreach($products_in_basket as $product)
            <p>
                {{ $product->id }}
                {{ $product->name }}
                {{ $product->code }}
            </p>
        @endforeach
    </div>

    <div style="text-align: left; width: 25%;">
        @foreach($products as $product)
            <p style="text-align: left; width: 50%;">
                quantity - {{ $product['quantity'] }}
            </p>
        @endforeach
    </div>

    <div style="text-align: center; width: 25%;">
        @foreach($products as $product)
            <p style="text-align: left; width: 50%;">
                price - <span class="total_price">{{ $total_price = $product['price']*$product['quantity'] }}</span> tenge
            </p>
        @endforeach
    </div>
</div>

<div>
    <p>Total price is => <span class="total_price">{{ $total_price }}</span></p>
</div>

<div style="display: flex; justify-content: space-between;">

    <div style="width: 50%;">
        @if(auth()->check())
            <form action="{{ route('orders.store') }}" method="post" style="display: inline-block;">
                <input type="text" placeholder="Adress" value="" required name="adress">
                <br>
                <input type="text" placeholder="Telephone number" value="" required name="telephone">
                <br>
                <input type="text" placeholder="E-mail" value="" required name="email">
                <br>
                <input id="promocode_hidden" type="hidden" value="" name="promocode">
                <br>
                @csrf
                <input type="submit" value="Order as {{ auth()->user()->name }}">
            </form>
        @else
            <form action="{{ route('orders.store') }}" method="post" style="display: inline-block;">
                <input type="text" placeholder="Adress" value="" required name="adress">
                <br>
                <input type="text" placeholder="Telephone number" value="" required name="telephone">
                <br>
                <input type="text" placeholder="E-mail" value="" required name="email">
                <br>
                <input id="promocode_hidden" type="hidden" value="" name="promocode">
                <br>
                @csrf
                <input type="submit" value="Order as a guest">
            </form>
        @endif

            <form action="{{ route('orders.discount') }}" method="post" style="display: inline-block;" class="add_promocode">
                @csrf
                <input id="promocode_input" name="promocode" type="text" placeholder="If you have promocode, put it here">
                <input type="submit" value="Check promocode">
            </form>
            <p id="discount_p" style="display: none;">You have <span style="color: red;" id="discount">0</span> percent discount! Your total price is updated.</p>
    </div>

    <div style="width: 50%;">
        <form action="{{ route('basket.clear') }}" method="post">
            @csrf
            <input type="submit" value="Clear Basket" onclick="return confirm('Are you sure?')">
        </form>
    </div>
</div>

<div>
    @else
        <p>Basket is empty</p>
    @endif
</div>

@endsection
