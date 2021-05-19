<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Classroom;
use App\Meeting;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Asia/Makassar');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $role_id = Auth::user()->role_id;

        if ($role_id == 1) {
            return view('admin.beranda');
        } elseif ($role_id == 2) {
            $kelas =  Classroom::where('dosen_id', Auth::user()->id)->get();
            return view('dosen.beranda', ['kelas' => $kelas]);
        } elseif ($role_id == 3) {
            $pertemuan =  Meeting::where('kelas_id', Auth::user()->kelas_id)->get();
            return view('mhs.beranda', ['pertemuan' => $pertemuan]);
        } else {
            return abort(404);
        }
    }

    public function pengumuman()
    {

        $role_id = Auth::user()->role_id;

        if ($role_id == 2) {
            return view('dosen.pengumuman');
        } elseif ($role_id == 3) {
            $pengumuman = Announcement::where('kelas_id', Auth::user()->kelas_id)->get();
            return view('mhs.pengumuman', ['pengumuman' => $pengumuman]);
        } else {
            return abort(404);
        }
    }
}
