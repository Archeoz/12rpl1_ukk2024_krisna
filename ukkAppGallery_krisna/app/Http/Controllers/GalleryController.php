<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function mainpage()
    {
        $tglterbaru = Gallery::where('id_user', Auth::user()->id)->where('status', 'accept')->latest()->first();
        $fototerbaru = Gallery::where('id_user', Auth::user()->id)->where('status', 'accept')->orderBy('created_at', 'desc')->paginate(5);
        $gallery = Gallery::where('id_user', Auth::user()->id)->where('status', 'accept')->orderBy('created_at', 'desc')->get();
        $pendingfoto = Gallery::where('id_user', Auth::user()->id)->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $declinedfoto = Gallery::where('id_user', Auth::user()->id)->where('status', 'declined')->orderBy('created_at', 'desc')->get();
        return view('mainpage', compact('tglterbaru', 'fototerbaru', 'gallery', 'pendingfoto', 'declinedfoto'));
    }

    public function upload(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if ($valid->fails()) {
            return back()->with('errorupload', '* The photo format must be Png,Jpeg,or Jpeg');
        }

        $namafto = Auth::user()->id . date('YmdHis') . $request->foto->getClientOriginalName();
        $request->foto->move(public_path('foto'), $namafto);

        Gallery::create([
            'id_user' => Auth::user()->id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $namafto,
        ]);

        return back();
    }

    public function edit(Request $request, $id_gallery)
    {
        if ($request->foto == null) {
            Gallery::where('id_gallery', $id_gallery)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect('mainpage');
        } else {
            $valid = Validator::make($request->all(), [
                'foto' => 'required|image|mimes:png,jpg,jpeg',
            ]);
            if ($valid->fails()) {
                return back()->with('errorupload', '* The photo format must be Png,Jpeg,or Jpeg');
            }

            $namafto = Auth::user()->id . date('YmdHis') . $request->foto->getClientOriginalName();
            $request->foto->move(public_path('foto'), $namafto);

            Gallery::where('id_gallery', $id_gallery)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'foto' => $namafto,
            ]);
            return redirect('mainpage');
        }
    }

    public function hapus($id_gallery)
    {
        Gallery::where('id_gallery', $id_gallery)->delete();
        return redirect('mainpage');
    }
}
