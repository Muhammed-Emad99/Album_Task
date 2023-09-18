@extends('album.album-layout')
@section('title')
    Album | List
@endsection

@section('header')
    <div class="container px-4 px-lg-5">
        <div class="">
            <h1 class="display-4 fw-bolder">All Albums</h1>
            <p class="section-lead">
                You can see and manage all albums.
            </p>
        </div>
    </div>
@endsection

@section('content')
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 row-cols-2">
            @foreach($albums as $album)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{$album->name}}</h5>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="d-flex justify-content-between my-2">
                            <div class="text-center"><a class="btn btn-outline-transparent text-info mt-auto"
                                                        href="{{route('albums.show',['id'=>$album->id])}}"><i
                                        class="fa fa-info-circle me-2"></i>View</a></div>

                            @if(count($album->images) > 0)

                                <div class="text-center">
                                    <button type="button" class="btn btn-outline-transparent text-secondary mt-auto"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-right-left me-2"></i> Move to another album
                                    </button>
                                </div>

                                <!-- Vertically centered modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> Move images of this album to another album</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{route('albums.move',['id'=>$album->id])}}">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('patch')
                                                    <label for="album" class="form-label">Parent Album</label>
                                                    <select name="album" id="album" class="form-select">
                                                        @foreach($albums as $album)
                                                            <option value="{{$album->id}}">{{$album->id}} - {{$album->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-outline-transparent text-secondary">Save changes</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            @endif
                            <div class="text-center">
                                <form method="post" action="{{route('albums.destroy',['id'=>$album->id])}}">
                                    @csrf
                                    @method('delete')
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-transparent text-danger mt-auto">
                                            <i class="fa fa-trash me-2"></i> Delete
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted text-start">{{$album->created_at}}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection

