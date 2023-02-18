@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>
            Ubah Kategori
        </strong>
        <small>{{ $item->category_name }}</small>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('categories.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_name" class="form-control-label">Nama Kategori</label>
                <input
                type="text"
                name="category_name"
                {{-- tanda '?' dan ':' ini merupakan pengkondisian untuk sebuah variable yang memiliki data atau tidak, jika true maka data yang ditampilkan adalah old('category_name') jika tidak ada tampilkan data dari $item->category_name --}}
                value="{{ old('category_name') ? old('category_name') : $item->category_name }}" class="form-control @error('category_name') is-invalid @enderror"/>
            @error('category_name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Ubah Barang
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
