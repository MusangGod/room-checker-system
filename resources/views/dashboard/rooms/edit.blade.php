@extends('layouts.main')
@section('title', 'Edit Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('rooms.update', $room->id) }}" method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name', $room->name) }}"
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
                            {{ (collect(old('room_category_id', $room->room_category_id))->contains($item->id)) ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('room_category_id')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Ruangan</p>
                <label class="switch">
                    <input type="checkbox" name="status" @checked($room->status=='active' ? 'on' : '')>
                    <span class="slider round"></span>
                </label>

                @error('status')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image" class="text-second mb-1">Foto Ruangan</label>
                <label for="image" class="d-block mb-3">
                    @if ($room->image)
                        <img src="{{ asset($room->image) }}"
                             class="preview-img border" width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="preview-img border"
                             width="300" alt="">
                    @endif
                </label>
                <input type="file" id="image" name="image"
                       class="input-crud py-0 input hidden" />
                <label for="image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Ruangan</button>
                <a href="{{ route('rooms.index') }}" class="button btn-second text-white" type="reset">Batal
                    Ubah</a>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        previewImg("input", "preview-img")
        $("#status").select2()
        $("#room_category_id").select2()
    </script>
@endpush

