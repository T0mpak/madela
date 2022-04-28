@extends('admin.layout')

@section('title', 'Add new manufacturer')

@section('header', 'Add new manufacturer')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add <i>manufacturer</i></h3>
        </div>
        <form action="{{ route('manufacturers.store') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>Manufacturer's</i> name</label>
                    <input name="name" type="text" class="form-control" placeholder="Manufacturer's name" value="" required>
                    @error('name')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add manufacturer</button>
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
