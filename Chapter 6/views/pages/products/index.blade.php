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
                                Daftar Barang
                            </h4>
                        </div>

                        <div class="input-group mb-3 col-md-2 offset-md-6">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modalSearch">
                                <i class="fa fa-info-circle"></i>
                              </button>
                            </div>
                            <input type="text" class="form-control" id="filter" placeholder="Search" aria-label="" aria-describedby="basic-addon1">
                          </div>

                          <div class="input-group col-md-3 offset-md-10">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-info" type="button" data-toggle="modal" data-target="#modalSort">
                                    <i class="fa fa-info-circle"></i>
                                </button>
                              </div>
                              <div>
                                <select name="sort_by" id="sort_by" class="custom-select">
                                    <option value="">Sort By</option>
                                    <option value="name">Nama</option>
                                    <option value="type">Type</option>
                                    <option value="price">Price</option>
                                    <option value="quantity">Quantity</option>
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
                                    <th data-sort="name">Nama</th>
                                    <th data-sort="type">Type</th>
                                    <th data-sort="price">Price</th>
                                    <th data-sort="quantity">Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="searchable">
                                <?php $no = 1; ?>
                                @forelse ($items as $item)
                                <tr>
                                    {{-- <td>{{ $item->id }}</td> --}}
                                    <td>{{ $no++ }}</td>
                                    <td data-sort="name">{{ $item->name }}</td>
                                    <td data-sort="type">{{ $item->categories->category_name }}</td>
                                    <td data-sort="price" >Rp. {{ number_format($item->price)}}</td>
                                    <td data-sort="quantity" >{{ $item->quantity }}</td>
                                    <td>

                                        <a href="{{ route('product.gallery', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fa fa-picture-o"></i>
                                        </a>
                                        <a href="{{ route('product.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <form action="{{ route('product.destroy', $item->id) }}"
                                            id="deleteForm{{ $item->id }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="hapusProduk({{ $item->id }}); return false;"
                                                class="btn btn-danger delete-product btn-sm">
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
