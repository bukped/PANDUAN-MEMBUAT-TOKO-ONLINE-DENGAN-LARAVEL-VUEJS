@extends('layouts.default')

@section('content')
<div class="orders">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="box-title">
                                Daftar Transaksi Masuk
                            </h4>
                        </div>

                        <div class="input-group mb-3 col-md-2 offset-md-6">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modalSearch">
                                <i class="fa fa-info-circle"></i>
                              </button>
                            </div>
                            <input type="text" class="form-control" id="filter" placeholder="Cari Disini..." aria-label="" aria-describedby="basic-addon1">
                          </div>

                        <div class="input-group col-md-8 offset-md-10">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modalSort">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                              </div>
                              <div>
                                <select name="sort_by" id="sort_by" class="custom-select">
                                    <option value="">Sort By</option>
                                    <option value="name">Nama</option>
                                    <option value="email">Email</option>
                                    <option value="nomor">Nomor Hp</option>
                                    <option value="total">Total</option>
                                    <option value="status">Status</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-body--">
                    <div class="table table-hover">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th data-sort="name">Nama Pembeli</th>
                                    <th data-sort="optional">Nama Penerima</th>
                                    <th data-sort="email">Email</th>
                                    <th data-sort="nomor">Nomor</th>
                                    <th data-sort="total">Total Transaksi</th>
                                    <th data-sort="status">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="searchable">
                                <?php $no = 1; ?>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td data-sort="name">{{ $item->customer->customer_name }}</td>
                                    <td data-sort="optional" >{{ $item->customer->customer_optional ? $item->customer->customer_optional : $item->customer->customer_name }}</td>
                                    <td data-sort="email">{{ strtolower($item->customer->email) }}</td>
                                    <td data-sort="nomor">{{ $item->customer->number }}</td>
                                    <td data-sort="total">Rp. {{ number_format($item->transaction_total) }}</td>
                                    <td data-sort="status">
                                        @if($item->transaction_status == 'PENDING')
                                        <span class="badge badge-warning"> {{ $item->transaction_status }} </span> -
                                        Pembayaran Sedang Diproses

                                        @elseif($item->transaction_status == 'SUCCESS')
                                        <span class="badge badge-success">{{ $item->transaction_status }} </span> -
                                        Pembayaran Telah Diterima

                                        @elseif($item->transaction_status == 'CANCEL')
                                        <span class="badge badge-danger">{{ $item->transaction_status }} </span> -
                                        Pembayaran Dibatalkan
                                        @else
                                        <span>
                                            @endif

                                        </span>
                                    </td>
                                    <td>
                                        {{-- @if($item->transaction_status == 'PENDING')
                                        <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i>
                                        </a>

                                        <a href="{{ route('transactions.status', $item->id) }}?status=FAILED"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                        </a> --}}

                                        {{-- @elseif($item->transaction_status == 'SUCCESS')
                                        <label class="badge badge-success">Pembayaran Telah Diterima</label>

                                        @elseif($item->transaction_status == 'FAILED')
                                        <label class="badge badge-danger">Pembayaran Dibatalkan</label> --}}

                                        {{-- @endif --}}
                                        <a href="#mymodal" data-remote="{{ route('transactions.show', $item->id) }}"
                                            data-toggle="modal" data-target="#mymodal"
                                            data-title="Detail Transaksi {{ $item->uuid }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        {{-- <a href="{{ route('transactions.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a> --}}

                                        <form action="{{ route('transactions.destroy', $item->id) }}"
                                            id="deleteTrans{{ $item->id }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="hapusTrans({{ $item->id }}); return false;"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center p-5">
                                        Data Tidak Tersedia
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Penjelasan Fitur Search -->
                <div class="modal fade" id="modalSearch" tabindex="-1" role="dialog" aria-labelledby="modalSearchLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalSearchLabel">Penjelasan Fitur Search</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Fitur search memungkinkan pengguna untuk melakukan pencarian data dari nama, email,
                                nomor, total transaksi, dan status. Pengguna dapat memasukkan kata kunci yang dicari
                                pada kolom search, lalu hasil pencarian akan ditampilkan sesuai dengan kata kunci yang
                                dimasukkan.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Penjelasan Fitur Sort By -->
                <div class="modal fade" id="modalSort" tabindex="-1" role="dialog" aria-labelledby="modalSortLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalSortLabel">Penjelasan Fitur Sort By</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Fitur sort by memungkinkan pengguna untuk mengurutkan data sesuai dengan kolom yang
                                dipilih. Caranya cukup dengan mengklik header kolom pada tabel, maka data akan terurut
                                secara ascending atau descending sesuai dengan header kolom yang dipilih.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
