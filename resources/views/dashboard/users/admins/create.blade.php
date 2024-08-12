@extends('layouts.main')
@section('title', 'Tambah Pengguna')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
            @csrf
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="username" class="text-second mb-1">Username</label>
                <input type="text" class="input-crud" name="username" id="username" value="{{ old('username') }}"
                    placeholder="Masukkan Nama..." required />
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="email" name="email"
                    placeholder="Masukkan Email..." value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="password" name="password"
                    placeholder="Masukkan Password..." required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" name="status" checked>
                    <span class="slider round"></span>
                </label>

                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image_path" class="text-second mb-1">Foto Profil</label>
                <label for="image_path" class="d-block mb-3">
                    <img src="{{ asset('assets/img/upload-image.jpg') }}" class="create-admin-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="image_path" name="image_path"
                    class="input-crud py-0 create-admin-input hidden" />
                <label for="image_path" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image_path')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Tambah Pengguna</button>
                <a href="{{ route('admins.index') }}" class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg("create-admin-input", "create-admin-preview-img")
    </script>
@endpush
