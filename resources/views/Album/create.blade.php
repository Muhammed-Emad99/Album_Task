@extends('album.album-layout')
@section('title')
    Album | Create
@endsection
@section('header')
    <div class="container px-4 px-lg-5">
        <div class="">
            <h1 class="display-4 fw-bolder">Create Album</h1>
            <p class="section-lead">
                On this page you can create a new album and fill in all fields.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <form method="post" action="" enctype="multipart/form-data">
            @csrf

            <!-- Album Name -->
            <div class="form-group mb-5">
                <label class="mb-3" for="name">Album Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
                <div class="invalid-feedback fa-1x">
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
                        <input type="file" name="image[]" id="imageUpload"/>
                    </div>
                </div>
                <div class="image-container mt-4">

{{--                    <div class="image-child">--}}
{{--                        <img src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" id="imagePreview">--}}
{{--                    </div>--}}
                </div>
                <div class="text-danger mt-2">
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    {{--    <script type="text/javascript">--}}
    {{--        const dropdown = document.getElementById("status-dropdown");--}}

    {{--        dropdown.addEventListener("change", function () {--}}

    {{--            document.getElementById("myForm").submit();--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection
