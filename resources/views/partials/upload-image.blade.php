<div class="form-group">
    <label>
        <span class="label label-default" style="font-size:22px;">Subir im&aacute;genes</span>
        <span>(opcional)</span>
    </label>

    <h3 class="text-center mb-5"></h3>


    <form action="{{route('imageUpload')}}" method="post" enctype="multipart/form-data">
        @csrf
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="user-image mb-3 text-center">
            <div class="imgPreview"> </div>
        </div>            

        <div class="custom-file">
            <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple">
            <label class="custom-file-label" for="images">Seleccionar im&aacute;genes</label>
        </div>

        <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
            Subir im&aacute;genes
        </button>
    </form>
</div>