{{-- Create Admin Modal --}}
<x-base-modal>
    <x-slot name="type">Create</x-slot>
    <x-slot name="modalId">createAdmin</x-slot>
    <x-slot name="route">{{ route('admins.store') }}</x-slot>
    <x-slot name="body">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="username" class="text-second mb-1">Username</label>
                <input type="text" class="input-crud" name="username" id="username" value="{{ old('username') }}"
                    placeholder="Masukkan Nama..." required />
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="email" name="email"
                    placeholder="Masukkan Email..." value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
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
        </div>
    </x-slot>
</x-base-modal>

{{-- Detail Admin Modal --}}
<x-base-modal>
    <x-slot name="type">Detail</x-slot>
    <x-slot name="modalId">detailAdmin</x-slot>
    <x-slot name="route"></x-slot>
    <x-slot name="body">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" disabled class="input-crud" id="detail_name"/>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="username" class="text-second mb-1">Username</label>
                <input type="text" disabled class="input-crud" id="detail_username"/>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="text" disabled class="input-crud" id="detail_email" />
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" disabled id="detail_status">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col-span-12 flex flex-col">
                <label class="text-second mb-1">Foto Profil</label>
                <label class="d-block mb-3">
                    <img id="detail_image" src="{{ asset('assets/img/upload-image.jpg') }}" class="border"
                        width="300" alt="">
                </label>
            </div>
        </div>
    </x-slot>
</x-base-modal>

{{-- Edit Admin Modal --}}
<x-base-modal>
    <x-slot name="type">Edit</x-slot>
    <x-slot name="modalId">editAdmin</x-slot>
    <x-slot name="formId">edit_form</x-slot>
    <x-slot name="body">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 flex flex-col">
                <label for="name" class="text-second mb-1">Nama</label>
                <input type="text" class="input-crud" name="name" id="edit_name"
                    placeholder="Masukkan Nama..." required />
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="username" class="text-second mb-1">Username</label>
                <input type="text" class="input-crud" name="username" id="edit_username"
                    placeholder="Masukkan Nama..." required />
                @error('username')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="email" class="text-second mb-1">Email</label>
                <input type="email" class="input-crud" id="edit_email" name="email"
                    placeholder="Masukkan Email..." required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="password" class="text-second mb-1">Password</label>
                <input type="password" class="input-crud" id="edit_password" name="password"
                    placeholder="Masukkan Password...">
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <p class="text-second mb-1">Status Akun</p>
                <label class="switch">
                    <input type="checkbox" id="edit_status" name="status" checked>
                    <span class="slider round"></span>
                </label>

                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="edit_image_path" class="text-second mb-1">Foto Profil</label>
                <label for="edit_image_path" class="d-block mb-3">
                    <img id="edit_image" src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-admin-preview-img border"
                        width="300" alt="">
                </label>
                <input type="file" id="edit_image_path" name="image_path"
                    class="input-crud py-0 edit-admin-input hidden" />
                <label for="edit_image_path" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image_path')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </x-slot>
</x-base-modal>

{{-- Delete Admin Modal --}}
<x-modal-delete>
    <x-slot name="name">admin</x-slot>
    <x-slot name="modalId">Admin</x-slot>
    <x-slot name="formId">delete_admin_form</x-slot>
</x-modal-delete>