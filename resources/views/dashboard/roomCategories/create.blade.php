@extends('layouts.main')
@section('title', 'Kategori Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('roomCategories.store') }}" method="post" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Kategori Ruangan</button>
                <a href="{{ route('roomCategories.index') }}" class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection

