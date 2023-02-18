@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>
            Tambah Foto Barang <small>{{ $products->name }}</small>
        </strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('product-galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="form-group">
                <input type="hidden" name="products_id" value="{{ $products->id }}">
            </div>
            <div class="form-group">
                <label for="photo" class="form-control-label">Foto Barang</label>
                <input
                type="file"
                name="photo"
                value="{{ old('photo') }}"
                class="form-control @error('photo') is-invalid @enderror"/>
            @error('photo') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="is_default" class="form-control-label">Jadikan Default</label>
                <br>
                <label>
                    <input
                        type="radio"
                        name="is_default"
                        value="1"
                        class="form-control @error('is_default') is-invalid @enderror"/> Yes
                </label>
                &nbsp;
                <label>
                    <input
                        type="radio"
                        name="is_default"
                        value="0"
                        class="form-control @error('is_default') is-invalid @enderror"/> No
                </label>
            @error('is_default') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Tambah Foto Barang
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
