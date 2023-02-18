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
                                    Daftar Kategori
                                </h4>
                            </div>


                            <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="filter" placeholder="Cari Disini...">
                                </div>
                            </div>
                            <form action="{{ route('categories.store')}}" method="POST">
                                @csrf
                                @method('post')

                                <div class="input-group ml-3">
                                    <input name="category_name" class="form-control text-black @error('category_name') is-invalid @enderror" id="category_name" value="{{ old('category_name') }}" type="text" placeholder="Masukkan nama kategori" aria-label="default input example">
                                    @error('category_name') <div class="text-muted">{{ $message }}</div> @enderror
                                    <button class="btn btn-info" type="submit" id="inputGroupFileAddon04">Tambahkan</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="card-body--">

                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Action</th>

                              </tr>
                            </thead>
                            <tbody class="searchable">
                                <?php $no = 1; ?>
                                @forelse ($items as $item)
                              <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $item->category_name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $item->id) }}" id="deleteCategory{{ $item->id }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="hapusCategory({{ $item->id }}); return false;" class="btn btn-danger btn-sm">
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
@endsection
