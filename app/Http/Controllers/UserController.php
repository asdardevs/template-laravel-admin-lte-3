<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id = Auth::user()->role_id;

        if ($role_id == 2) {
            return view('dosen.profil');
        } elseif ($role_id == 3) {
            $peserta = Student::with('kelas')->where('nim', Auth::user()->username)->first();
            return view('mhs.profil', ['peserta' => $peserta]);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');

        if ($file) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $extension = $file->getClientOriginalExtension();
            $filename = Auth::user()->username . ' ' . time() . '.' . $extension;
            $file->move('profile/', $filename);


            User::where('id', Auth::user()->id)
                ->update([
                    'profil' => $filename,
                ]);


            if (Auth::user()->profil != 'profil.png') {
                $path = 'profile/' . Auth::user()->profil;
                if (is_file($path)) {
                    unlink($path);
                }
            }
        } else {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ]);
            User::where('id', Auth::user()->id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
        }
        echo 1;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
