<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','download']);
        
    }

    public function create(Request $request,Photo $photo)
    {
        $extension = $request->photo->extension();

        $photo->filename = $photo->id . '.' . $extension;
        $request->file('photo')->storeAs('public/photo', $photo->filename);

        DB::beginTransaction();

        try {
            Auth::user()->photos()->save($photo);

        } catch (\Exception $e) {
            Db::rollBack();
            Storage::disk('local')->delete('public/photo/' . $photo->filename);
            throw $e;
        }

        return response($photo,201);
    }

    public function index()
    {
        $photos = Photo::with(['owner'])
            ->orderBy(Photo::CREATED_AT, 'desc')->paginate();

        return $photos;
    }

    public function download(Photo $photo)
    {
        // 写真の存在チェック
        if (!Storage::disk('locak')->exists($photo->filename)) {
            abort(404);
        }

        $disposition = 'attachment; filename="' . $photo->filename . '"';
        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => $disposition,
        ];

        return response(Storage::disk('locak')->get($photo->filename), 200, $headers);
    }
}
