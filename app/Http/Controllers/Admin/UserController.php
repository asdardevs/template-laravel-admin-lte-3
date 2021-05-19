<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {


                    $btn = '
                        <div class="btn-group ">
                        <button type="button" onclick="edit(\'' . $row->id . '\'); return false;" class="btn btn-default btn-sm" >Edit</button>
                        <button type="button" onclick="hapus(\'' . $row->id . '\'); return false;" class="btn btn-danger btn-sm">Hapus</button>
                        </div>
                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.master.dosen');
    }


    public function store(Request $request)
    {


        if ($request->kode != null) {
            $request->validate([
                'nidn' =>  'required|digits:10|unique:teachers,nidn,' . $request->kode,
                'nama' => 'required',
            ]);
        } else {
            $request->validate([
                'nidn' =>  'required|numeric|digits:10|unique:teachers,nidn',
                'nama' => 'required',
            ]);
        }



        User::updateOrCreate(
            ['id' => $request->kode],
            [
                'nidn' => $request->nidn,
                'nama' => $request->nama,
            ]
        );
        $return = array(
            'status'    => true,
            'message'    => 'Data berhasil disimpan..',
        );


        return response()->json($return);
    }



    public function edit($id)
    {
        $unit = User::find($id);
        return response()->json($unit);
    }



    public function destroy($id)
    {
        $deleted = User::destroy($id);
        if ($deleted) {
            $return = array(
                'status' => true,
                'message' => 'Data berhasil dihapus..'
            );
        } else {
            $return = array(
                'status' => false,
                'message' => 'Gagal dihapus..'
            );
        }

        return response()->json($return);
    }

    // public function buat_user()
    // {
    //     $data = Teacher::get();

    //     foreach ($data as $value) {
    //         $dosen = User::where('username', $value->nidn)->first();
    //         if (!$dosen) {
    //             User::create([
    //                 'username' => $value->nidn,
    //                 'name' => $value->nama,
    //                 'password' => Hash::make('#tikSelaluDihati'),
    //                 'role_id' => 2
    //             ]);
    //         }
    //     }
    //     return  redirect('dosen');
    // }
}
