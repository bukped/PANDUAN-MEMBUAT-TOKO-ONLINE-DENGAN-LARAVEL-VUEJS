<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>{{ $item->customer->customer_name }}</th>
    </tr>
    <tr>
        <th>Email</th>
        <th>{{ $item->customer->email }}</th>
    </tr>
    <tr>
        <th>Nomor</th>
        <th>{{ $item->customer->number }}</th>
    </tr>
    <tr>
        <th>Alamat</th>
        <th>{{ $item->customer->address }}</th>
    </tr>
    <tr>
        <th>Total Transaksi</th>
        <th>Rp. {{ number_format($item->transaction_total)  }}</th>
    </tr>
    <tr>
        <th>Status Transaksi</th>
        <th>
            @if ($item->transaction_status === 'CANCEL')
                <span class="badge badge-danger">{{ $item->transaction_status }}</span> - Pembayaran Dibatalkan
            @elseif ($item->transaction_status === 'PENDING')
                <span class="badge badge-warning">{{ $item->transaction_status }}</span> - Pembayaran Sedang Diproses, Mohon Ditunggu
            @elseif ($item->transaction_status === 'SUCCESS')
                <span class="badge badge-success">{{ $item->transaction_status }}</span> - Pembayaran Berhasil, Barang sedang dalam proses pengiriman
            @endif
        </th>
    </tr>
    <tr>
        <th>Pembelian Produk</th>
        <td>
            <table class="table table-bordered w-100">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Tanggal pembelian</th>
                    <th>Bukti</th>
                    <th>Harga</th>
                </tr>
                @foreach ($item->details as $detail )
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->categories->category_name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->created_at }}</td>
                        <td><img src="{{ url($item->transaction_proof) }}"></td>
                        <td>Rp. {{ number_format($detail->product->price)  }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>

<div class="row">
    <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-block">
            <i class="fa fa-check"></i> Set Success
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=CANCEL" class="btn btn-danger btn-block">
            <i class="fa fa-times"></i> Set Cancel
        </a>
    </div>
    <div class="col-4">
        <a href="{{ route('transactions.status', $item->id) }}?status=PENDING" class="btn btn-warning btn-block">
            <i class="fa fa-spinner"></i> Set On Proses
        </a>
    </div>
</div>
