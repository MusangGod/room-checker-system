@extends('layouts.main')
@section('title', 'Profile Pengguna')
@section('main')
    <div class="mt-[20px] p-0 flex gap-5 lg:flex-row flex-col">
        <div class="table-wrapper p-[18px] w-full h-fit md:max-w-[300px]">
        @if (isset($user->user->image_path))
            <img src="{{ asset($user->user->image_path) }}" alt="Profile Image" class="rounded-full w-full edit-profile-preview-img aspect-square object-cover object-center h-auto"/>
        @else
            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Image" class="edit-profile-preview-img rounded-full w-full aspect-square object-cover object-center h-auto"/>
        @endif
    </div>
        <div class="table-wrapper w-full">
            <div class="row">
                <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Nama Lengkap</label>
                    <input type="text" class="input-crud" value="{{ $user->name }}" disabled />
                </div>
                  <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Username</label>
                    <input type="text" class="input-crud" value="{{ $user->user->username }}" disabled />
                </div>
               <div class="col-md-6 col-12 mb-4 flex flex-col">
                    <label class="text-second">Email</label>
                    <input type="text" class="input-crud" value="{{ $user->user->email }}" disabled />
                </div>
                <div class="col-12 mt-5">
                    <a href="{{ route('profile.edit') }}" class="button btn-main">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
