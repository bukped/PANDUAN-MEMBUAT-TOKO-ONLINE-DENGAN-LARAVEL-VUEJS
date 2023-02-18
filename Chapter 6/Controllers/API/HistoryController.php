<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Customers;
use Illuminate\Http\Request;

class HistoryController extends Controller{
    public function history($id){
        $items = Transaction::with(['customer','details.product'])
        ->where('customer_id',$id)
        ->get();
        if($items)
            return ResponseFormatter::success($items, 'Data transaksi berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data transaksi tidak ada');
    }

    public function historyDetail($id) {
        $items = TransactionDetail::with([ 'transaction.details' ,'product.galleries', 'product.categories'])
        ->where('transactions_id',$id)
        ->get();
        if($items)
            return ResponseFormatter::success($items, 'Data detail transaksi berhasil diambil');
        else
            return ResponseFormatter::error(null, 'Data detail transaksi tidak ada');
    }
}
