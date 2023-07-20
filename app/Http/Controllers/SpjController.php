<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Spj;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpjController extends Controller
{
    public function index()
    {
        $active = "SPJ";
        return view('Spj.index', compact('active'));
    }

    public function getSpj()
    {
        $data = Spj::with('pegawai.opd')
            ->orderBy('created_at', 'desc') // Order by latest input (assuming you have a 'created_at' column)
            ->orderBy('no_st', 'asc')       // Order by 'no_st' in ascending order
            ->get();

        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                //
            })
            ->editColumn('tanggal', function ($data) {
                return $data->tanggal_pelaksanaan . ' - ' . $data->tanggal_selesai;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $active = "SPJ";
        $pegawai = Pegawai::all();
        return view('Spj.create', compact('active', 'pegawai'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'no_st' => [
                'required',
            ],
        ]);

        if ($request->input('lokasi_check') === 'Dalam Kota') {
            $lokasi = "Dalam Kota";
        } else {
            $lokasi = $request->input('lokasi');
        }

        if ($request->input('kendaraan') === 'Mobil') {
            $tiket = '-';
        } else {
            $tiket = $request->input('tiket');
        }

        if ($request->input('penginapan') === 'Tidak') {
            $hotel = '-';
            $uang_hotel = 0;
        }

        Spj::create([
            'no_st'                 => $request->input('no_st'),
            'no_sppd'               => $request->input('no_sppd'),
            'pegawai_id'            => $request->input('pegawai_id'),
            'tanggal_pelaksanaan'   => $request->input('tanggal_pelaksanaan'),
            'tanggal_selesai'       => $request->input('tanggal_selesai'),
            'tujuan'                => $lokasi,
            'uang_harian'           => $request->input('uang_harian'),
            'kendaraan'             => $request->input('kendaraan'),
            'tiket'                 => $tiket,
            'hotel'                 => $hotel,
            'uang_hotel'            => $uang_hotel,
        ]);

        return redirect()->route('Spj.index');
    }

    public function destroy($id)
    {
        Spj::find($id)->delete();
        return redirect()->route('Spj.index')
            ->with('success', 'Data SPJ berhasil dihapus!');
    }
}
