@extends('admin.layout')

@section('title', 'Create new category')

@section('header', 'Create new category')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create <i>category</i></h3>
        </div>
        <form action="{{ route('categories.store') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>Category</i> name</label>
                    <input name="name" type="text" class="form-control" placeholder="Category name" value="" required>
                    @error('title')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Category</i> description</label>
                    <textarea name="description" type="text" class="form-control" placeholder="Category description" rows="5" required></textarea>
                    @error('text')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputFile"><i>Category</i> IMAGE</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="imgInp" accept="image/*">
                            <label class="custom-file-label" for="imgInp">Choose Image</label>
                        </div>
                    </div>

                    <img id="imgId" src="" style="width: 50px; margin-top: 0.5em; border: 1px dashed lightskyblue; border-radius: 1.25rem;">
                    <div id="fileName" class="text-small"></div>

                    @error('file')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add category</button>
                </div>
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
