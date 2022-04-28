@extends('admin.layout')

@section('title', 'News Edit')

@section('header', 'Edit the News')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit <i>News</i></h3>
        </div>
        <form action="{{ route('admin.news.update', $new->id) }}" enctype="multipart/form-data" method="post">
            @method('PUT')
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>News</i> TITLE</label>
                    <input name="title" type="text" class="form-control" placeholder="TITLE" value="{{ $new->title}}" required>
                    @error('title')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>News</i> TEXT</label>
                    <textarea name="text" type="text" class="form-control" placeholder="TEXT" rows="5" required>{{ $new->text }}</textarea>
                    @error('text')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputFile"><i>News</i> IMAGE</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="imgInp" accept="image/*">
                            <label class="custom-file-label" for="imgInp">Choose Image</label>
                        </div>
                    </div>

                    <img id="imgId" src="{{ asset("/uploads/$new->file_path") }}" style="width: 50px; margin-top: 0.5em; border: 1px dashed lightskyblue; border-radius: 1.25rem;">
                    <div id="fileName" class="text-small"></div>

                    @error('file')
                    <span class="text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Добавить НОВОСТЬ</button>
            </div>
        </form>
    </div>

    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                imgId.src = URL.createObjectURL(file);
                var input = document.getElementById('imgInp').value;
                var output = document.getElementById('fileName');
                output.innerHTML = '<span>' + input.split(/(\\|\/)/g).pop() + '</span>';
            }
        }
    </script>
@endsection
