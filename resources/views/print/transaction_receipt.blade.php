<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi - {{ $transaction->code }}</title>
    <style>
        /* Style dasar untuk tampilan di browser */
        body {
            font-family: 'Courier New', Courier, monospace;
            color: #000;
        }

        /* --- PENGATURAN UNTUK PRINT --- */
        @media print {
            /* Sembunyikan elemen yang tidak perlu dicetak */
            @page {
                /* Atur margin halaman cetak */
                margin: 0;
                size: auto;
            }

            body {
                /* Hapus margin default body saat print */
                margin: 0;
            }

            .receipt {
                /* Ganti nilai variabel ini sesuai lebar kertas printer Anda.
                  Pilihan umum: 58mm atau 80mm.
                  Nilai di bawah ini sudah dikurangi sedikit untuk memberi ruang (padding).
                */
                --receipt-width: 57mm; /* Untuk kertas 58mm */
                /* --receipt-width: 78mm; */ /* Untuk kertas 80mm (gunakan ini jika perlu) */

                width: var(--receipt-width);
                font-size: 10pt; /* Gunakan 'pt' untuk hasil cetak yang lebih konsisten */
            }
        }

        /* Style untuk tampilan struk di browser (agar bisa di-preview) */
        .receipt {
            width: 320px; /* Lebar untuk preview di browser */
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        
        .header, .footer {
            text-align: center;
        }

        .header h1 {
            font-size: 1.2em; /* Gunakan 'em' agar ukuran relatif terhadap font-size parent */
            margin: 0;
            padding: 0;
        }

        .header p, .transaction-details p {
            font-size: 0.9em;
            margin: 3px 0;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .items-table table, .total-section table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
        }
        
        .items-table th, .items-table td {
            padding: 3px 0;
        }

        .text-right {
            text-align: right;
        }

        .total-section td {
            padding: 2px 0;
        }
    </style>
</head>
<body>

    <div class="receipt">
        <div class="header">
            <h1>Kassa Kaffee</h1>
            <p>Jl. Rajawali No. 194 Bendungan, Kec. Cilegon</p>
        </div>

        <div class="divider"></div>

        <div class="transaction-details">
            <p>Tanggal : {{ $transaction->created_at->format('d/m/Y H:i:s') }}</p>
            <p>Faktur  : {{ $transaction->code }}</p>
            <p>Meja    : {{ $transaction->barcodes?->table_number ?? 'N/A' }}</p>
            {{-- PERBAIKAN: Relasi ke user biasanya tunggal (user), bukan jamak (users) --}}
            <p>Kasir   : {{ auth()->user()?->name ?? 'Admin' }}</p>        </div>

        <div class="divider"></div>

        <div class="items-table">
            <table>
                @foreach($transaction->items as $item)
                    <tr>
                        <td colspan="2">{{ $item->food->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                @if($transaction->discount > 0)
                    <tr>
                        <td colspan="2">Disc.</td>
                        <td class="text-right">({{ number_format($transaction->discount, 0, ',', '.') }})</td>
                    </tr>
                @endif
            </table>
        </div>

        <div class="divider"></div>

        <div class="total-section">
            <table>
                <tr>
                    <td>Subtotal :</td>
                    <td class="text-right">{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>PPN :</td>
                    <td class="text-right">{{ number_format($transaction->ppn, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>TOTAL :</strong></td>
                    <td class="text-right"><strong>{{ number_format($transaction->total, 0, ',', '.') }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="divider"></div>

        <div class="footer">
            <p>Terima Kasih atas kunjungan anda</p>
            <p>Barang yg sudah dibeli tdk dpt tukar</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>

</body>
</html>