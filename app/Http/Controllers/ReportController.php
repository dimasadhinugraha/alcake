<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Material;
use App\Models\MaterialHistory;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // ==========================================
        // 1. DATA TAB PENJUALAN HARIAN (Dynamic Date)
        // ==========================================
        $selectedDailyDateStr = $request->input('daily_date', Carbon::today()->toDateString());
        $selectedDailyDate = Carbon::parse($selectedDailyDateStr);

        $dailyTransactions = Transaction::whereDate('created_at', $selectedDailyDate)->get();
        $dailyStats = [
            'total_trx' => $dailyTransactions->count(),
            'total_sales' => $dailyTransactions->sum('paid'),
            'dp_count' => $dailyTransactions->where('status', 'Belum Lunas')->count(),
            'lunas_count' => $dailyTransactions->where('status', 'Lunas')->count(),
        ];

        // ==========================================
        // 2. DATA TAB LAPORAN BULANAN (Dynamic Month & Year)
        // ==========================================
        $selectedMonth = (int)$request->input('month', date('m'));
        $selectedYear = (int)$request->input('year', date('Y'));

        $currentMonthTrx = Transaction::whereMonth('created_at', $selectedMonth)
                                      ->whereYear('created_at', $selectedYear)
                                      ->get();
        $monthlyStats = [
            'total_trx' => $currentMonthTrx->count(),
            'dp_count' => $currentMonthTrx->where('status', 'Belum Lunas')->count(),
            'lunas_count' => $currentMonthTrx->where('status', 'Lunas')->count(),
        ];

        // 12 Months dynamic calculation for current selected year
        $monthlyData = [];
        $monthsIndo = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Des'
        ];

        for ($m = 1; $m <= 12; $m++) {
            $monthTrx = Transaction::whereYear('created_at', $selectedYear)->whereMonth('created_at', $m)->get();
            $monthlyData[$m] = [
                'month_num' => $m,
                'label' => $monthsIndo[$m],
                'total_trx' => $monthTrx->count(),
                'dp_count' => $monthTrx->where('status', 'Belum Lunas')->count(),
                'lunas_count' => $monthTrx->where('status', 'Lunas')->count(),
                'total_sales' => $monthTrx->sum('paid'),
            ];
        }

        // Compute aggregate KPIs for selected year
        $totalYearlySales = collect($monthlyData)->sum('total_sales');
        $averageMonthlySales = $totalYearlySales / 12;
        
        $highestMonthItem = collect($monthlyData)->sortByDesc('total_sales')->first();
        $highestSalesMonth = $highestMonthItem['label'] ?? '-';
        $highestSalesValue = $highestMonthItem['total_sales'] ?? 0;

        // Data arrays for Chart JS
        $chartTrxData = [];
        $chartSalesData = [];
        foreach ($monthlyData as $data) {
            $chartTrxData[] = $data['total_trx'];
            $chartSalesData[] = $data['total_sales'];
        }

        // ==========================================
        // 3. DATA TAB STOK BAHAN BAKU
        // ==========================================
        $materials = Material::all();
        $stokKurang = $materials->filter(function($mat) { return $mat->stock <= $mat->min_stock; })->count();
        $stokAman = $materials->filter(function($mat) { return $mat->stock > $mat->min_stock; })->count();

        $materialHistories = MaterialHistory::orderBy('created_at', 'desc')->get();

        // ==========================================
        // 4. DATA TAB REKAP SEMUA TRANSAKSI
        // ==========================================
        $allTransactions = Transaction::orderBy('created_at', 'desc')->get();
        $rekapStats = [
            'total_trx' => $allTransactions->count(),
            'total_sales' => $allTransactions->sum('paid'),
            'dp_count' => $allTransactions->where('status', 'Belum Lunas')->count(),
            'lunas_count' => $allTransactions->where('status', 'Lunas')->count(),
        ];

        return view('reports.index', compact(
            'dailyTransactions', 'dailyStats', 'selectedDailyDateStr',
            'selectedMonth', 'selectedYear', 'monthlyStats', 'monthlyData',
            'totalYearlySales', 'averageMonthlySales', 'highestSalesMonth', 'highestSalesValue',
            'chartTrxData', 'chartSalesData',
            'materials', 'stokKurang', 'stokAman', 'materialHistories',
            'allTransactions', 'rekapStats'
        ));
    }
}
