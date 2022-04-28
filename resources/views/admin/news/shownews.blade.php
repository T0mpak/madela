@extends('admin.layout')

@section('title', 'News Index')

@section('header', 'All News Index')

@section('main-content')

    @if(session('status-create'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ session('status-create') }}!
        </div>
    @endif

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
                    <th>Title</th>
                    <th>Body</th>
                    <th>Image path</th>
                    <th>Creation date</th>
                    <th>Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $new)
                    <tr>
                        <td>
                            <a href="{{ route('admin.news.show', $new->id) }}">{{ $new->id }}</a>
                        </td>
                        <td>
                            @if(strlen($new->title) >= 20)
                                {{ substr($new->title, 0, 15) . '...' }}
                            @else
                                {{ $new->title }}
                            @endif
                        </td>
                        <td>
                            @if(strlen($new->text) >= 30)
                                {{ substr($new->text, 0, 25) . '...' }}
                            @else
                                {{ $new->text }}
                            @endif
                        </td>
                        <td>{{ substr($new->file_path, 12) }}</td>
                        <td>{{ $new->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $new->id) }}">
                                <button>Edit</button>
                            </a>
                            <form action="{{ route('admin.news.destroy', $new->id) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf

                                <button>Delete</button>
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
        {{ $news->links() }}
    </div>

@endsection
