<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            font-size: 10pt;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table td {
            padding: 0;
            vertical-align: top;
        }
        .header-table .company-name-section {
            text-align: left;
            width: 30%; /* Berikan lebar agar tidak terlalu melebar */
        }
        .header-table .company-name-section h2 {
            margin: 0;
            padding: 0;
            font-size: 20pt;
            color: #333;
            line-height: 1.2;
        }
        .header-table .title-section {
            text-align: left;
            padding-left: 20px; /* Spasi dari nama perusahaan */
            flex-grow: 1; /* Biarkan mengambil sisa ruang */
        }
        .header-table .title-section h1 {
            margin: 0;
            padding: 0;
            font-size: 24pt;
            color: #4CAF50;
            line-height: 1.2;
        }
        .header-table .info-section {
            text-align: right;
            font-size: 9pt;
            color: #666;
            line-height: 1.4;
            width: 40%; /* Berikan lebar agar tidak tumpang tindih */
        }
        .header-table .info-section p {
            margin: 0;
            padding: 0;
        }

        /* Border bottom untuk header */
        .header-separator {
            width: 100%;
            height: 2px;
            background-color: #eee;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #555;
            font-size: 9pt;
        }
        td {
            font-size: 8.5pt;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
            padding-right: 10px;
            font-size: 12pt;
        }
        .total-section h3 {
            margin: 0;
            padding: 10px 0;
            border-top: 1px solid #ccc;
            border-bottom: 2px solid #4CAF50;
            display: inline-block;
            padding-left: 20px;
            padding-right: 10px;
            background-color: #e8f5e9;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="company-name-section">
                <h2>Kasa Kaffee</h2>
            </td>
            <td class="title-section">
                <h1>Laporan Penjualan</h1>
            </td>
            <td class="info-section">
                <p><strong>Kasa Kaffee</strong></p>
                <p>Alamat: Jl. Ciwaduk Cilik No. 123, Cilegon, Banten</p>
                <p>Telepon: (021) 123-4567</p>
                <p>Email: info@kasakafe.com</p>
                <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</p>
            </td>
        </tr>
    </table>
    <div class="header-separator"></div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Transaksi</th>
                <th>Jumlah Item</th>
                <th>Subtotal</th>
                <th>PPN</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                {{-- Pastikan urutan dan jumlah TD sesuai dengan TH --}}
                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                <td>{{ $transaction->code }}</td>
                <td>{{ $transaction->items_sum_quantity }}</td> {{-- Ini adalah TD yang hilang/tergeser --}}
                <td>Rp{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($transaction->ppn, 0, ',', '.') }}</td>
                <td>Rp{{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <h3>Total Pendapatan: Rp{{ number_format($totalGrandAmount, 0, ',', '.') }}</h3>
    </div>

    <div class="footer">
        Laporan Penjualan dibuat oleh Sistem Manajemen Transaksi Kasa Kaffe.
    </div>
</body>
</html>