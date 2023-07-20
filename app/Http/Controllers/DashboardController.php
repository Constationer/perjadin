<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Models\Pegawai;
use App\Models\Spj;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $active = "Dashboard";
        $monthlyTotals = $this->getMonthlyTotals();
        $total_pegawai  = Pegawai::count();
        $total_opd      = Opd::count();
        $total_spj      = Spj::count();

        $overlap = DB::select('
            SELECT pegawais.nama, COUNT(DISTINCT sp1.id) as total_overlap
            FROM pegawais
            INNER JOIN spjs as sp1 ON pegawais.id = sp1.pegawai_id
            INNER JOIN spjs as sp2 ON sp1.pegawai_id = sp2.pegawai_id
            WHERE sp1.id <> sp2.id
            AND sp1.tanggal_pelaksanaan <= sp2.tanggal_selesai
            AND sp1.tanggal_selesai >= sp2.tanggal_pelaksanaan
            GROUP BY pegawais.nama
        ');

        $overlapCollection = collect($overlap);
        $total_overlap = $overlapCollection->sum('total_overlap');

        return view('dashboard', compact('active', 'overlap', 'total_pegawai', 'total_opd', 'total_spj', 'total_overlap', 'monthlyTotals'));
    }

    public function getMonthlyTotals()
    {
        // Get the data from the database
        $spjsData = DB::table('spjs')
            ->select('tanggal_pelaksanaan', 'tanggal_selesai')
            ->get();

        // Process the data to get monthly totals
        $monthlyTotals = [];

        foreach ($spjsData as $row) {
            $startDate = new DateTime($row->tanggal_pelaksanaan);
            $endDate = new DateTime($row->tanggal_selesai);

            // Loop through each month and add the count to the corresponding month
            while ($startDate <= $endDate) {
                $monthYear = $startDate->format('M-Y'); // Format as "Mon-Year"

                if (!isset($monthlyTotals[$monthYear])) {
                    $monthlyTotals[$monthYear] = 0;
                }

                $monthlyTotals[$monthYear]++;

                // Move to the next month
                $startDate->modify('first day of next month');
            }
        }

        // Sort the array by the actual date values in ascending order
        uksort($monthlyTotals, function ($a, $b) {
            return strtotime($a) - strtotime($b);
        });

        return $monthlyTotals;
    }
}
