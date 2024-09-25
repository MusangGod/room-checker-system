@extends('layouts.main')
@section('title', 'Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('rooms.store') }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
            @csrf
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Kategori Ruangan</label>
                <select name="room_category_id" id="room_category_id" required>
                    <option selected disabled>Pilih Kategori Ruangan</option>
                    @foreach ($roomCategories as $item)
                        <option value="{{ $item->id }}"
                            {{ (collect(old('room_category_id'))->contains($item->id)) ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('tag_ids')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Ruangan</p>
                <label class="switch">
                    <input type="checkbox" name="status" checked>
                    <span class="slider round"></span>
                </label>

                @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
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
                <button class="button btn-main" type="submit">Tambah Ruangan</button>
                <a href="{{ route('rooms.index') }}" class="button btn-second text-white" type="reset">Batal
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

