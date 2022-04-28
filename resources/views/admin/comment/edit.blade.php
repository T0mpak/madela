@extends('admin.layout')

@section('title', 'Comment Edit')

@section('header', 'Edit the Comment')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit <i>Comment</i></h3>
        </div>
        <form action="{{ route('admin.comment.update', $comment->id) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>Comment</i> Body</label>
                    <input name="body" type="text" class="form-control" placeholder="Body Text" value="{{ $comment->body}}" required>
                    @error('body')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Изменить КОММЕНТАРИЙ</button>
            </div>
        </form>
    </div>
@endsection
