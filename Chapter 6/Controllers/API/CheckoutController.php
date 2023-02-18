<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Customers;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout(CheckoutRequest $request){

        //variabel $data ini yang nantinya akan disimpen dalam tabel transaction
        $data = $request->except('transaction_details','quantities');


        //penambahan uuid untuk identifier transaksi agar nantinya data yang didapat berupa angka yang random
        $data['uuid'] = 'TRX' . mt_rand(10000, 99999) . mt_rand(100,999);

        //membuat data transaksi ke dalam table transaction
        $transaction = Transaction::create($data);

        $transaction->update($data);

        //foreach untuk memasukan array untuk memasukan transaction detail dan juga membuat pengurangan untuk setiap transaksi atau barang yang telah dibeli.
        $i = 0;
        foreach ($request->transaction_details as $product)
        {
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction->id,
                'products_id' => $request->transaction_details[$i],
                'quantity' => $request->quantities[$i]
            ]);

            //pengurangan barang ketika produk dibeli
            Product::find($product)->decrement('quantity', $request->quantities[$i]);
            $i++;
        }

        //menyimpan hasil transaksi
        $transaction->details()->saveMany($details);

        //mengembalikan hasil transaksi dengan response formater
        $result = [
            'transaction_id' => $transaction->id
        ];
        return ResponseFormatter::success($result);

    }
}
