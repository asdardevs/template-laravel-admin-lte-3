<?php

namespace App\Http\Controllers\Menu;

use App\Accessubmenu;
use App\Http\Controllers\Controller;
use App\Submenu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SubMenuController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Submenu::with('menu')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                    <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-primary " onclick="edit(\'' . $row->id . '\'); return false;"  ><i
                            class="fas fa-pen" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-outline-danger " onclick="hapus(\'' . $row->id . '\'); return false;"  ><i
                            class="fas fa-trash" aria-hidden="true"></i></button>
                </div>

                ';
                    return $btn;
                })
                ->addColumn('aktif', function ($row) {
                    if ($row->is_active == '1') {
                        return 'Aktif';
                    } else {
                        return 'Tidak Aktif';
                    }
                })
                ->rawColumns(['action', 'aktif'])
                ->make(true);
        }
        return view('admin.menu.submenu');
    }


    public function store(Request $request)
    {

        $request->validate([
            'menu' => 'required',
            'submenu' => 'required',
            'sub_url' => 'required',
            'urutan' => 'required|numeric',
        ]);




        Submenu::updateOrCreate(
            ['id' => $request->kode],
            [
                'menu_id' => $request->menu,
                'sub' => $request->submenu,
                'sub_url' => $request->sub_url,
                'urut_sub' => $request->urutan,
                'is_active' => $request->is_active,
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
        $unit = Submenu::find($id);
        return response()->json($unit);
    }



    public function destroy($id)
    {
        $deleted = Submenu::destroy($id);
        Accessubmenu::where('sub_menu_id', $id)->delete();
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
