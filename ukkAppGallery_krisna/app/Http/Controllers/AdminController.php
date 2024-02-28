<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function postlogin(Request $request)
    {
        $email = User::where('email', $request->email)->first();
        if (!$email) {
            return back()->with('erroremail', '* That email isnt registered yet');
        }
        if ($email->status == "pending") {
            return back()->with('erroremail', '* That email is on pending state, please wait for admin to verify your account');
        }
        if ($email->role == "user") {
            return back()->with('erroremail', '* Your not admin, u cant use admin power');
        }
        if ($email->status == "blocked") {
            return back()->with('erroremail', '* That email was blocked, contact admin for detail');
        }

        if (!Hash::check($request->password, $email->password)) {
            return back()->with('errorpassword', '* That password is wrong');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('adminpage');
        } else {
            return redirect('admin');
        }
    }

    public function userdata()
    {
        if (Auth::user()->role == "user") {
            Auth::logout();
            return redirect('/')->with('erroremail', '* Your not admin, yo cant use admin power!');
        }

        $user = User::orderByRaw("FIELD(status,'pending','blocked','active')")->get();
        return view('admin.userdata', compact('user'));
    }

    public function edituserdata(Request $request)
    {
        if (Auth::user()->role == "user") {
            Auth::logout();
            return redirect('/')->with('erroremail', '* Your not admin, yo cant use admin power!');
        }
        foreach ($request->id as $v) {
            User::where('id', $v)->update([
                'status' => $request->status,
            ]);
        }
        return back();
    }

    public function userupload()
    {
        if (Auth::user()->role == "user") {
            Auth::logout();
            return redirect('/')->with('erroremail', '* Your not admin, yo cant use admin power!');
        }

        $upload = Gallery::join('users', 'users.id', 'galleries.id_user')
            ->orderByRaw("FIELD(galleries.status,'pending','declined','accept')")
            ->select('galleries.*', 'users.username')
            ->get();
        return view('admin.userupload', compact('upload'));
    }

    public function edituserupload(Request $request)
    {
        if (Auth::user()->role == "user") {
            Auth::logout();
            return redirect('/')->with('erroremail', '* Your not admin, yo cant use admin power!');
        }

        foreach ($request->id_gallery as $v) {
            Gallery::where('id_gallery', $v)->update([
                'status' => $request->status,
            ]);
        }
        return back();
    }
}
