@extends('layouts.main')
@section('title', 'Detail Kategori Ruangan')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form class="grid grid-cols-12 gap-4">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" value="{{ $roomCategory->name }}" disabled />
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <a href="{{ route('roomCategories.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
            </div>
        </form>
    </div>
@endsection
