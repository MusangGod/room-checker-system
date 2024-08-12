@extends('layouts.main')
@section('title', 'Edit Admin')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('admins.update', $admin->id) }}" method="post" enctype="multipart/form-data"
            class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ $admin->name }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="username" class="text-second mb-1">Username</label>
                <input type="text" class="input-crud" placeholder="Masukkan Username..." required
                    id="username" name="username" value="{{ $admin->user->username }}">
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="email" name="email"
                    placeholder="Masukkan Email..." value="{{ $admin->user->email }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="password" name="password"
                    placeholder="Masukkan Password...">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" name="status" @checked($admin->user->status ? 'on' : '')>
                    <span class="slider round"></span>
                </label>

                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image_path" class="text-second mb-1">Foto Profil</label>
                <label for="image_path" class="d-block mb-3">
                    @if ($admin->user->image_path)
                        <img src="{{ asset($admin->user->image_path) }}"
                            class="edit-admin-preview-img border" width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-admin-preview-img border"
                            width="300" alt="">
                    @endif
                </label>
                <input type="file" id="image_path" name="image_path"
                    class="input-crud py-0 edit-admin-input hidden" />
                <label for="image_path" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image_path')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Edit Pengguna</button>
                <a href="{{ route('admins.index') }}" class="button btn-second text-white" type="reset">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg("edit-admin-input", "edit-admin-preview-img")
    </script>
@endpush
