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
        $today = Carbon::today();

        // ==========================================
        // 1. DATA TAB PENJUALAN HARIAN (Hari Ini)
        // ==========================================
        $dailyTransactions = Transaction::whereDate('created_at', $today)->get();
        $dailyStats = [
            'total_trx' => $dailyTransactions->count(),
            'total_sales' => $dailyTransactions->sum('paid'),
            'dp_count' => $dailyTransactions->where('status', 'Belum Lunas')->count(),
            'lunas_count' => $dailyTransactions->where('status', 'Lunas')->count(),
        ];

        // ==========================================
        // 2. DATA TAB LAPORAN BULANAN (Bulan Ini)
        // ==========================================
        $currentMonthTrx = Transaction::whereMonth('created_at', date('m'))
                                      ->whereYear('created_at', date('Y'))
                                      ->get();
        $monthlyStats = [
            'total_trx' => $currentMonthTrx->count(),
            'dp_count' => $currentMonthTrx->where('status', 'Belum Lunas')->count(),
            'lunas_count' => $currentMonthTrx->where('status', 'Lunas')->count(),
        ];

        // Data untuk Grafik (Contoh dummy trend 12 bulan)
        $chartData = [0, 0, 0, $monthlyStats['total_trx'], 0, 0, 0, 0, 0, 0, 0, 0]; // Index 3 = April

        // ==========================================
        // 3. DATA TAB STOK BAHAN BAKU
        // ==========================================
        $materials = Material::all();
        $stokKurang = $materials->filter(function($mat) { return $mat->stock <= $mat->min_stock; })->count();
        $stokAman = $materials->filter(function($mat) { return $mat->stock > $mat->min_stock; })->count();

        $materialHistories = MaterialHistory::orderBy('created_at', 'desc')->limit(50)->get();

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
            'dailyTransactions', 'dailyStats',
            'monthlyStats', 'chartData',
            'materials', 'stokKurang', 'stokAman', 'materialHistories',
            'allTransactions', 'rekapStats'
        ));
    }
}
