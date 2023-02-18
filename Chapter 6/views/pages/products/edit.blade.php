@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>
            Ubah Barang
        </strong>
        <small>{{ $item->name }}</small>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('product.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-control-label">Nama Barang</label>
                <input
                type="text"
                name="name"
                {{-- tanda '?' dan ':' ini merupakan pengkondisian untuk sebuah variable yang memiliki data atau tidak, jika true maka data yang ditampilkan adalah old('name') jika tidak ada tampilkan data dari $item->name --}}
                value="{{ old('name') ? old('name') : $item->name }}" class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="categories_id" class="form-control-label">Kategori Barang</label>
               <select
               name="categories_id"
               class="form-control @error('categories_id') is-invalid @enderror">
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @if (old('categories_id', optional($item)->categories_id) == $cat->id) selected @endif>{{ $cat->category_name }} </option>
                @endforeach

                </select>
            @error('categories_id') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi Barang</label>
                <textarea
                name="description"
                class="ckeditor form-control @error('description') is-invalid @enderror">
                {{ old('description') ? old('description') : $item->description }}
            </textarea>
            @error('description') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-control-label">Harga Barang</label>
                <input
                type="text"
                name="price"
                value="{{ old('price') ? old('price') : $item->price }}"
                class="form-control @error('price') is-invalid @enderror"/>
            @error('price') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="quantity" class="form-control-label">Stok Barang</label>
                <input
                type="text"
                name="quantity"
                value="{{ old('quantity') ? old('quantity') : $item->quantity }}" class="form-control @error('quantity') is-invalid @enderror"/>
            @error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
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
