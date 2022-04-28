@extends('admin.layout')

@section('title', 'Comments Index')

@section('header', 'All Users Index')

@section('main-content')

    @if(session('status-update'))
        <div class="alert alert-info" role="alert">
            <strong>Success!</strong> {{ session('status-update') }}!
        </div>
    @endif

    @if(session('status-delete'))
        <div class="alert alert-info" role="alert">
            <strong>Success!</strong> {{ session('status-delete') }}!
        </div>
    @endif

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Body</th>
                    <th>Creation date</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>
                            <a href="{{ route('admin.news.show', $comment->id) }}">{{ $comment->id }}</a>
                        </td>
                        <td>
                            {{ $comment->user_id }}
                        </td>
                        <td>
                            @if(strlen($comment->body) >= 30)
                                {{ substr($comment->body, 0, 25) . '...' }}
                            @else
                                {{ $comment->body }}
                            @endif
                        </td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.comment.edit', $comment->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('admin.comment.destroy', $comment->id) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf

                                <button type="submit">Delete</button>
                            </form>
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
        {{ $comments->links() }}
    </div>

@endsection
