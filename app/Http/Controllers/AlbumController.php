<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\Image;
use Dotenv\Util\Str;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('images')->get();
        return view('album.index', ['albums' => $albums]);
    }

    public function store(AlbumRequest $request)
    {
        $data = $request->validated();
        $album = Album::create($data);
        if (isset($_FILES['images'])) {
            for ($i = 0; $i < count($request->images); $i++) {
                $album->images()->create([
                    'name' => upload_image('albums/' . $album->id, $request->images[$i]),
                ]);
            }
        }
        return redirect()->route('albums.index');
    }

    public function create()
    {
        return view('album.create');
    }

    public function edit($album)
    {
        $album = Album::with('images')->findOrFail($album);
        return view('album.edit', ['album' => $album]);
    }

    public function show($album)
    {
        $album = Album::with('images')->findOrFail($album);
        return view('album.show', ['album' => $album]);
    }

    public function destroy($album)
    {
        $album = Album::with('images')->findOrFail($album);
        if (count($album->images) == 0) {
            \File::deleteDirectory(public_path('uploads/albums/' . $album->id));
        }
        $album->delete();
        return redirect()->route('albums.index');
    }

    public function move(Request $request, $album)
    {
        $images = Image::where('album_id', $album)->update(['album_id' => $request->album]);
        return redirect()->route('albums.index');
    }

    public function update(AlbumRequest $request ,$album)
    {
        $data = $request->validated();
        $album = Album::with('images')->findOrFail($album);
        $album->name = $request->name;
        if (isset($_FILES['images']) && count($_FILES['images']['error']) == 0) {
            for ($i = 0; $i < count($request->images); $i++) {
                $album->images()->update([
                    'name' => upload_image('albums/' . $album->id, $request->images[$i]),
                ]);
            }
        }

        if (count($album->images) > 0 && public_path('uploads/albums/' . $album->id)) {
            \File::deleteDirectory(public_path('uploads/albums/' . $album->id));
            $album->images()->delete();
        }
        $album->save();

        return redirect()->route('albums.index');
    }


}
