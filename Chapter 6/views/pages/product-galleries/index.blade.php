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
                                    Daftar Foto Barang
                                </h4>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                <input type="text" class="form-control" id="filter" placeholder="Cari Disini...">
                              </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body--">

                        <div class="table-stats table-hover">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Foto</th>
                                        <th>Default</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                    <?php $no = 1; ?>
                                    @forelse ($items as $item)
                                        <tr>
                                            {{-- <td>{{ $item->id }}</td> --}}
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>
                                                <img src="{{ url($item->photo) }}" alt="" />
                                            </td>
                                            <td>{{ $item->is_default ? 'Ya' : 'Tidak' }}</td>
                                            <td>
                                                <form action="{{ route('product-galleries.destroy', $item->id) }}" id="deletePhoto{{ $item->id }}"
                                                    method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="hapusPhoto({{ $item->id }}); return false;" class="btn btn-danger btn-sm">
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
                </div>
            </div>
        </div>
    </div>
@endsection
