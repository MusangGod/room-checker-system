@extends('layouts.main')
@section('title', 'Tambah Data Pengecekan Ruangan')
@section('main')
    @php
        date_default_timezone_set('Asia/Makassar');
    @endphp
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('roomCheckers.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="room_id" value="{{$room->id}}">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama Ruangan</label>
                <input disabled type="text" class="input-crud" id="name" value="{{ $room->name }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Tanggal</label>
                <input type="date" class="input-crud" name="date" id="date" value="{{ date("Y-m-d") }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Jam</label>
                <input type="time" class="input-crud" name="time" id="date" value="{{ date("H:i") }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Status Ruangan</label>
                <select name="status" id="room_category_id" required>
                    <option selected disabled>Pilih Status</option>
                    <option value="done">Selesai</option>
                    <option value="on_progress">Sedang Berlangsung</option>
                </select>
                @error('tag_ids')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Keterangan</label>
                <textarea type="text" class="input-crud" name="description" id="description" value="{{ old('description') }}"
                          placeholder="Masukkan Nama Kategori Ruangan..." required></textarea>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image" class="text-second mb-1">Foto Ruangan</label>
                <label for="image" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-room-preview-img border"
                         width="300" alt="">
                </label>
                <input type="file" id="image" name="image"
                       class="input-crud py-0 create-room-input hidden" />
                <label for="image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Pengecekan</button>
                <a href="{{ route('roomCheckers.index') }}" class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        previewImg("create-room-input", "create-room-preview-img")
        $("#status").select2()
        $("#room_category_id").select2()
    </script>
@endpush

