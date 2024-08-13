@extends('layouts.main')
@section('title', 'Edit Tag')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('tags.update', $tag->id) }}" method="post" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name', $tag->name) }}"
                    placeholder="Masukkan Nama Tag..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Update Tag</button>
                <a href="{{ route('tags.index') }}" class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection
