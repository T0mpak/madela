@extends('layouts.layout')

@section('content')
@if(gettype($orders) =="string")
    <p>{!! $orders !!}</p>
@else
    <h2 style="text-align: center;">{{auth()->user()->name}}'s all orders</h2>
    <table style="margin: 20px;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Customer name</th>
                <th>Customer e-mail</th>
                <th>Customer telephone</th>
                <th>Destiny address</th>
                <th>Total price</th>
                <th>Promotion id</th>
                <th>Used promocode</th>
                <th>Promotion discount</th>
                <th>Is approved?</th>
                <th>Is canceled?</th>
                <th>Is finished?</th>
                <th>Order made datetime</th>
                <th>Order last status change datetime</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->id }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->telephone }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->price }} tenge</td>
                <td>{{ $order->promotion->id ?? NULL }}</td>
                <td>{{ $order->promotion->promocode ?? NULL }}</td>
                <td>{{ $order->promotion->discount ?? 0 }} percents off</td>
                <td>{{ $order->is_approved }}</td>
                <td>{{ $order->is_canceled }}</td>
                <td>{{ $order->is_finished }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
@endsection
