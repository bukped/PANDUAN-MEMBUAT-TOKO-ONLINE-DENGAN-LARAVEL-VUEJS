@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>
            Tambah Barang
        </strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            @method('post')

            <div class="form-group">
                <label for="name" class="form-control-label">Nama Barang</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"/>
            @error('name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>


            <div class="form-group">
                <label for="categories_id" class="form-control-label">Kategori Barang</label>
               <select
               name="categories_id"
               class="form-control @error('categories_id') is-invalid @enderror">
                @foreach ($category as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                @endforeach

                </select>
            @error('categories_id') <div class="text-muted">{{ $message }}</div> @enderror
            </div>


            <div class="form-group">
                <label for="description" class="form-control-label">Deskripsi Barang</label>
                <textarea name="description" class="ckeditor form-control @error('description') is-invalid @enderror">
                    {{ old('description') }}
                </textarea>
            @error('description') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="price" class="form-control-label">Harga Barang</label>
                <input type="text" name="price" value="{{ old('price') }}" class="form-control @error('price') is-invalid @enderror"/>
            @error('price') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="quantity" class="form-control-label">Stok Barang</label>
                <input type="text" name="quantity" value="{{ old('quantity') }}" class="form-control @error('quantity') is-invalid @enderror"/>
            @error('quantity') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Tambah Barang
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
