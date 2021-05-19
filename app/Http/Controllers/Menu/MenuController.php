<?php

namespace App\Http\Controllers\Menu;

use App\Accessmenu;
use App\Http\Controllers\Controller;
use App\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Menu::get();
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
        return view('admin.menu.menu');
    }


    public function store(Request $request)
    {



        $request->validate([
            'menu' => 'required',
            'urutan' => 'required|numeric',
            'icon' => 'required',
            // 'url' => 'required',
        ]);




        Menu::updateOrCreate(
            ['id' => $request->kode],
            [
                'menu' => $request->menu,
                'urut' => $request->urutan,
                'icon' => $request->icon,
                'is_active' => $request->is_active,
                'url' => $request->url,
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
        $unit = Menu::find($id);
        return response()->json($unit);
    }



    public function destroy($id)
    {
        $deleted = Menu::destroy($id);
        Accessmenu::where('menu_id', $id)->delete();
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
