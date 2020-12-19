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
        $this->middleware('auth');
    }

    public function create(Request $request,Photo $photo)
    {
        $extension = $request->photo->extension();

        $photo->filename = $photo->id . '.' . $extension;
        $request->file('photo')->storeAs('public/photo', $photo->filename);

        DB::beginTransaction();

        try {
            Auth::user()->photo()->save($photo);

        } catch (\Exception $e) {
            Db::rollBack();
            Storage::disk('local')->delete('public/photo/' . $photo->filename);
            throw $e;
        }

        return response($photo,201);
    }
}
