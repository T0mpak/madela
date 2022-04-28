@extends('admin.layout')

@section('title', 'Add new product')

@section('header', 'Add new product')

@section('main-content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add <i>product</i></h3>
        </div>
        <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="post">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label><i>Product</i> name</label>
                    <input name="name" type="text" class="form-control" placeholder="Product name" value="" required>
                    @error('name')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Product</i> description</label>
                    <textarea name="description" type="text" class="form-control" placeholder="Product description" rows="5" required></textarea>
                    @error('description')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Product</i> category</label>
                    <select class="form-control" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Product</i> manufacturer</label>
                    <select class="form-control" name="manufacturer_id" required>
                        @foreach($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                        @endforeach
                    </select>
                    @error('manufacturer')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label><i>Product</i> price</label>
                    <input name="price" type="number" class="form-control" placeholder="Product price" value="" required>
                    @error('price')
                    <span class="text-danger mt-2"></span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputFile"><i>Product</i> IMAGE</label>
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
                    <button type="submit" class="btn btn-primary">Add product</button>
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
