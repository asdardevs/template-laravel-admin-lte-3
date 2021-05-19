<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Student::latest()->get();
            $data = Student::get();
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


    public function destroy($id)
    {
        $deleted = Student::destroy($id);
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
}
