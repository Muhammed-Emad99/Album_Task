@extends('album.album-layout')
@section('title')
    Album | Details
@endsection

@section('header')
    <div class="container px-4 px-lg-5">
        <div class="">
            <h1 class="display-4 fw-bolder">{{$album->name}}</h1>
            <p class="section-lead">
                You can see and manage all <b>{{$album->name}}</b> data.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 ">
            @if(count($album->images) > 0)
                @foreach($album->images as $image)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="">
                                    <!-- Product name-->
                                    <img class="card-img-top" alt="..."
                                         src="{{ asset('uploads/albums/'.$album->id.'/'.$image->name) }}" height="200">
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer">
                                <small class="text-muted text-start">{{$album->created_at}}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-self-center w-100">There is no images at this album.</div>
            @endif
        </div>
    </div>
@endsection
