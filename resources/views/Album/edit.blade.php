@extends('album.album-layout')
@section('title')
    Album | Edit
@endsection
@section('header')
    <div class="container px-4 px-lg-5">
        <div class="">
            <h1 class="display-4 fw-bolder">Edit Album</h1>
            <p class="section-lead">
                On this page you can Edit an album.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <form method="post" action="{{route('albums.update',$album->id)}}" enctype="multipart/form-data" id="uploadForm">
            @csrf
            @method('put')

            <!-- Album Name -->
            <div class="form-group mb-5">
                <label class="mb-3" for="name">Album Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name',$album->name)}}">
                <div class="text-danger mt-2">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
            </div>

            <!-- Album Images -->
            <div class="form-group mb-5">
                <label class="mb-3" for="name">Album Images</label>
                <div class="w-100">
                    <div class="image-preview">
                        <label for="imageUpload" id="image-label">Choose File</label>
                        <input type="file" name="images[]" id="imageUpload" accept="*/*" multiple >
                    </div>
                </div>
                <div class="text-danger mt-2">
                    @error('images')
                    {{$message}}
                    @enderror
                </div>

                <!-- gallery view of uploaded images -->
                <div id="imagesPreview" class="gallery image-container mt-4">
                    @if(count($album->images) > 0)
                        @foreach($album->images as $index => $image)
                            <div class='image-child'>
                                <img src="{{asset('uploads/albums/'.$album->id.'/'.$image->name)}}" alt="alt">
                            </div>
                        @endforeach
                    @else
                        <div class='text-center'>
                            This Album has no images
                        </div>
                    @endif
                </div>


            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script type="text/javascript">
        $("#imageUpload").change(function(){
            $('#imagesPreview').html("");
            var total_file=document.getElementById("imageUpload").files.length;
            for(var i=0;i<total_file;i++)
            {
                $('#imagesPreview').append("<div class='image-child'><img src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
            }
        });
    </script>
@endsection
