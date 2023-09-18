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
        return view('album.index',['albums' => $albums]);
    }

    public function store(AlbumRequest $request)
    {
        $data = $request->validated();
        $album = Album::create($data);
//        dd(count($_FILES['images']['error']));
        if (isset($_FILES['images']) && count($_FILES['images']['error']) == 0) {
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

    public function show($id)
    {
        $album = Album::with('images')->findOrFail($id);
        return view('album.show',['album' => $album]);
    }
    public function destroy($id)
    {
        $album = Album::with('images')->findOrFail($id);
        $album->delete();
        return redirect()->route('albums.index');
    }
    public function move(Request $request ,$id)
    {
        $images = Image::where('album_id',$id)->update(['album_id'=>$request->album]);
        return redirect()->route('albums.index');
    }


}
