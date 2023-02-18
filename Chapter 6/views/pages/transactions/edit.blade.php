@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">
        <strong>
            Ubah Transaksi
        </strong>
        <small>{{ $item->uuid }}</small>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('transactions.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="customer_name" class="form-control-label">Nama Pemesan</label>
                <input
                type="text"
                name="customer_name"
                {{-- tanda '?' dan ':' ini merupakan pengkondisian untuk sebuah variable yang memiliki data atau tidak, jika true maka data yang ditampilkan adalah old('name') jika tidak ada tampilkan data dari $item->name --}}
                value="{{ old('customer_name') ? old('customer_name') : $item->customer->customer_name }}" class="form-control @error('customer_name') is-invalid @enderror"/>
            @error('customer_name') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-control-label">Email</label>
                <input
                type="text"
                name="email"
                value="{{ old('email') ? old('email') : $item->customer->email }}"
                class="form-control @error('email') is-invalid @enderror"/>
            @error('email') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="number" class="form-control-label">Nomor HP</label>
                <input
                type="text"
                name="number"
                value="{{ old('number') ? old('number') : $item->customer->number }}"
                class="form-control @error('number') is-invalid @enderror"/>
            @error('number') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="address" class="form-control-label">Alamat</label>
                <input
                type="text"
                name="address"
                value="{{ old('address') ? old('address') : $item->customer->address }}" class="form-control @error('address') is-invalid @enderror"/>
            @error('address') <div class="text-muted">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Ubah Transaksi
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
