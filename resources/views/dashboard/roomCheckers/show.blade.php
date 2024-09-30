@extends('layouts.main')
@section('title', 'Ubah Data Pengecekan Ruangan')
@section('main')
    @php
        date_default_timezone_set('Asia/Makassar');
    @endphp
    <div class="table-wrapper mt-[20px] input-teacher">
        <form class="grid grid-cols-12 gap-4" enctype="multipart/form-data">
            <input type="hidden" name="room_id" value="{{$room->id}}">
            <div class="col-span-12 flex flex-col">
                <label for="user" class="text-second mb-1">Pengguna</label>
                <input disabled type="text" class="input-crud" id="user" value="{{ $roomChecker->user_data->email }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="user" class="text-second mb-1">Waktu Diubah</label>
                <input disabled type="{{$roomChecker->updated_at == $roomChecker->created_at ? 'text' : 'datetime-local'}}" class="input-crud" id="user" value="{{ $roomChecker->updated_at == $roomChecker->created_at ? '-' : $roomChecker->updated_at }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama Ruangan</label>
                <input disabled type="text" class="input-crud" id="name" value="{{ $room->name }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Tanggal</label>
                <input disabled type="date" class="input-crud" name="date" id="date" value="{{ $roomChecker->date }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Jam</label>
                <input disabled type="time" class="input-crud" name="time" id="date" value="{{ $roomChecker->time }}"
                       placeholder="Masukkan Nama Kategori Ruangan..." required />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Status Pengecekan</label>
                <select disabled name="status" id="status" required>
                    <option selected disabled>Pilih Status</option>
                    <option value="done" {{collect(old('status', $roomChecker->status))->contains('done') ? 'selected' : ''}}>Selesai</option>
                    <option value="on_progress" {{collect(old('status', $roomChecker->status))->contains('on_progress') ? 'selected' : ''}}>Sedang Berlangsung</option>
                </select>
                @error('tag_ids')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Keterangan</label>
                <textarea disabled type="text" class="input-crud" name="description" id="description"
                          placeholder="Masukkan Nama Kategori Ruangan..." required>{{ $roomChecker->description }}</textarea>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image" class="text-second mb-1">Foto Ruangan</label>
                <label for="image" class="d-block mb-3">
                    @if ($roomChecker->image)
                        <img src="{{ asset($roomChecker->image) }}"
                             class="preview-img border" width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="preview-img border"
                             width="300" alt="">
                    @endif
                </label>
                @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <a href="{{ route('roomCheckers.detail', $room->id) }}" class="button btn-second text-white" type="reset">Kembali</a>
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

