<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customers;
use App\Models\TransactionDetail;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Transaction::with('customer')->get();
        // $items = Customers::all();

        return view('pages.transactions.index')->with([
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Transaction::with('details.product')->findOrFail($id);
        $item = Transaction::with('customer.transaction')->findOrFail($id);

        return view('pages.transactions.show')->with([
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view('pages.transactions.edit')->with([
           'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();


        $item = Transaction::findOrFail($id);
        $item->update($data);

        Alert::alert('Update', 'Berhasil Mengubah Data Transaksi', 'success');
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $transaction = Transaction::findOrFail($id);
        $transactionDetails = TransactionDetail::where('id', $transaction->id)->get();

        // Hapus semua data pada tabel transaction_details yang terkait dengan transaksi ini
        foreach ($transactionDetails as $detail) {
        $detail->delete();
        }
        $item->delete();

        Alert::alert('Delete', 'Berhasil Mengahapus Data Transaksi', 'success');
        return redirect()->route('transactions.index');
    }

    public function setStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:PENDING,CANCEL,SUCCESS'
        ]);

        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;

        $item->save();

        Alert::alert('Ubah Status', 'Berhasil Mengubah Status Transaksi', 'success');
        return redirect()->route('transactions.index');
    }

    public function history(){
        $items = Transaction::get();
        return view('pages.transactions.history')->with([
            'items' => $items
        ]);
    }
}
