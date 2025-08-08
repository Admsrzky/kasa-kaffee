<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Menampilkan halaman print untuk transaksi tertentu.
     */
    public function printTransaction(Transaction $transaction)
    {
        // Ubah dari 'product' menjadi 'food' sesuai nama relasi Anda
        $transaction->load('items.food', 'barcodes');

        return view('print.transaction_receipt', compact('transaction'));
    }
}
