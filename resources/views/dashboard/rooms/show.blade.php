@extends('layouts.main')
@section('title', 'Detail Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <form method="post" class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input disabled type="text" class="input-crud" name="name" id="name" value="{{ old('name', $room->name) }}"
                       placeholder="Masukkan Nama Ruangan..." required />
                @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Kategori Ruangan</label>
                <input disabled type="text" class="input-crud" name="name" id="name" value="{{ old('name', $room->room_category->name) }}"
                       placeholder="Kategori Ruangan..." required />
                @error('room_category_id')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Ruangan</p>
                <label class="switch">
                    <input disabled type="checkbox" @checked($room->status=='active' ? 'on' : '')>
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
                <input disabled type="file" id="image" name="image"
                       class="input-crud py-0 input hidden" />
                <label for="image" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </form>
        <x-viewRoomChecker
            room_id="{{$room->id}}"
            :rooms="$roomChecker"
        />
        <div class="col-span-12 flex items-center gap-3 mt-2">
            <a href="{{ route('rooms.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
        </div>
    </div>
@endsection
@push('js')
    <script>
        previewImg("input", "preview-img")
        $("#status").select2()
        $("#room_category_id").select2()
    </script>
@endpush

