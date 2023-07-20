<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index()
    {
        $active = "OPD";
        return view('opd.index', compact('active'));
    }

    public function getOpd()
    {
        $data = Opd::all();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $active = "OPD";
        return view('Opd.create', compact('active'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
            ],
        ]);

        Opd::create([
            'nama'   => $request->input('nama')
        ]);

        return redirect()->route('Opd.index');
    }

    public function destroy($id)
    {
        Opd::find($id)->delete();
        return redirect()->route('Opd.index')
            ->with('success', 'Data OPD berhasil dihapus!');
    }
}
