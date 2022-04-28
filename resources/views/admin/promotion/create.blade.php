@extends('admin.layout')

@section('title', 'Add new promotion')

@section('header', 'Add new promotion')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add <i>promotion</i></h3>
        </div>
        <form action="{{ route('promotions.store') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>Promotion</i> promocode</label>
                    <input name="promocode" type="text" class="form-control" placeholder="Promotion promocode" value="{{ $promocode }}" required readonly>
                    @error('promocode')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Promotion</i> discount</label>
                    <input name="discount" type="number" class="form-control" placeholder="Promotion discount" value="" required>
                    @error('discount')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputFile"><i>Promotion</i> IMAGE</label>
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
                    <button type="submit" class="btn btn-primary">Add promotion</button>
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
promotion