<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #D82A97; padding-bottom: 10px; }
        .header h1 { color: #80153B; margin: 0; font-size: 24px; }
        .header p { margin: 5px 0 0 0; color: #666; }
        table { w-full; border-collapse: collapse; margin-top: 20px; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; color: #80153B; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .total-row { background-color: #fff0f5; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <h3>Detail Transaksi Hari Ini</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Produk</th>
                <th>Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($transactions as $index => $trx)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $trx->created_at->format('H:i') }} WIB</td>
                <td>
                    @foreach($trx->details as $detail)
                        {{ $detail->product->name }} (x{{ $detail->qty }})<br>
                    @endforeach
                </td>
                <td class="text-right">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
            </tr>
            @php $grandTotal += $trx->total_price; @endphp
            @empty
            <tr>
                <td colspan="4" style="text-align: center;">Belum ada transaksi hari ini</td>
            </tr>
            @endforelse

            <tr class="total-row">
                <td colspan="3" class="text-right font-bold">TOTAL PENDAPATAN HARI INI</td>
                <td class="text-right font-bold" style="color: #D82A97;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
