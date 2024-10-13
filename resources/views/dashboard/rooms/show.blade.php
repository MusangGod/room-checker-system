@extends('layouts.main')
@section('title', 'Detail Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <div class="grid grid-cols-12 gap-4">
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
            <div class="md:col-span-6 col-span-12 flex flex-col">
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
            </div>
            <div class="md:col-span-6 col-span-12 flex flex-col">
                <label for="image" class="text-second mb-1">QR Code Ruangan</label>
                <label for="image" class="d-block mb-3">
                    @if ( asset('storage/qrcodes/room-' . $room->id . '.png'))
                        <img src="{{  asset('storage/qrcodes/room-' . $room->id . '.png') }}"
                             class="preview-img border" alt="" id="qrImage">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="preview-img border"
                             width="300" alt="">
                    @endif
                </label>
                <button type="button" class="button btn-main" id="downloadBtn">Download Qr</button>
            </div>
        </div>
        <div class="col-span-12 flex items-center gap-3 mt-5">
            <a href="{{ route('rooms.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
        </div>
    </div>
@endsection
@push('js')
    <script>
        previewImg("input", "preview-img")
        $("#status").select2()
        $("#room_category_id").select2()

        document.getElementById('downloadBtn').addEventListener('click', () => {
            const imgElement = document.getElementById('qrImage');
            const imgUrl = imgElement.src;
            const downloadImage = (url, fileName) => {
                const a = document.createElement('a');
                a.href = url;
                a.download = fileName;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            };

            downloadImage(imgUrl, 'Qr Code Ruangan {{$room->name}}.png');
        });

    </script>
@endpush

