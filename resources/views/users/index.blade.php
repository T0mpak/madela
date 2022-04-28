@extends('layouts.layout')

@section('custom-css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">

    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #BA68C8
        }

        .profile-button {
            background: rgb(99, 39, 120);
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: #682773
        }

        .profile-button:focus {
            background: #682773;
            box-shadow: none
        }

        .profile-button:active {
            background: #682773;
            box-shadow: none
        }

        .back:hover {
            color: #682773;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: #BA68C8;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
@endsection

@section('custom-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js	"></script>

@endsection

@section('content')

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{ $user->name }}</span><span class="text-black-50">{{ $user->email }}</span><span> </span></div>
            </div>
            <div class="col-md-8 border-right">
                <div class="p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right" style="text-align: center;">{{ auth()->user()->name }}'s Orders</h4>
                    </div>
                    <div class="row mt-3">
                        @if(gettype($orders) =="string")
                            <p>{!! $orders !!}</p>
                        @else
                            <table style="margin: 25px;">
                                <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer name</th>
                                    <th>Destiny address</th>
                                    <th>Total price</th>
                                    <th>Is approved?</th>
                                    <th>Is canceled?</th>
                                    <th>Is finished?</th>
                                    <th>Cancel order</th>
                                    <th>Finish order</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->price }} tenge</td>
                                        <td>{{ $order->is_approved }}</td>
                                        <td>{{ $order->is_canceled }}</td>
                                        <td>{{ $order->is_finished }}</td>
                                        <td>
                                            @if($order->is_canceled == 1 or $order->is_approved == 1)
                                                @if($order->is_canceled == 1)
                                                    Order is already canceled
                                                @elseif($order->is_approved == 1)
                                                    Order is approved
                                                @endif
                                            @else
                                                <form action="{{ route('users.cancel') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $order->id }}" name="order_id">
                                                    <input type="submit" value="Cancel!">
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->is_approved == 1 and $order->is_canceled == 0 and $order->is_finished == 0)
                                                <form action="{{ route('users.finish') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $order->id }}" name="order_id">
                                                    <input type="submit" value="Finish!">
                                                </form>
                                            @else
                                                @if($order->is_approved == 0)
                                                    Can't finish unapproved order!
                                                @elseif($order->is_canceled == 1)
                                                    Can't finish canceled order!
                                                @elseif($order->is_finished == 1)
                                                    Order is already finished!
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection