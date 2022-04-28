@extends('admin.layout')

@section('title', 'Users Index')

@section('header', 'All Users Index')

@section('main-content')

    @if(session('status-user'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('status-user') }}
        </div>
    @endif

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>Is Admin</th>
                    <th>Date of registration</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->admin)
                            <span class="text-danger">Yes</span>
                        @else
                            <span class="text-gray-dark">No</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format("Y F j") }}</td>
                    <td>
                        @if($user->admin)
                            <span class="text-danger">Admin</span>
                        @else
                            <form action="{{ route('admin.deleteuser', $user->id) }}" method="post">
                                @csrf

                                <button type="submit">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection
