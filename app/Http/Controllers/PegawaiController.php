<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    public function index()
    {
        $active = "Pegawai";
        return view('Pegawai.index', compact('active'));
    }

    public function getPegawai()
    {
        $data = Pegawai::with('opd');

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $active = "Pegawai";
        $opd = Opd::all();
        return view('Pegawai.create', compact('active', 'opd'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
            ],
        ]);

        Pegawai::create([
            'nip'       => $request->input('nip'),
            'nama'      => $request->input('nama'),
            'opd_id'    => $request->input('opd_id'),
            'golongan'  => $request->input('golongan')
        ]);

        return redirect()->route('Pegawai.index');
    }

    public function destroy($id)
    {
        Pegawai::find($id)->delete();
        return redirect()->route('Pegawai.index')
            ->with('success', 'Data Pegawai berhasil dihapus!');
    }
}
