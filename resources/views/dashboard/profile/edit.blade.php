@extends('layouts.main')
@section('title')
    Edit Profile Pengguna
@endsection

@section('main')
    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class=" mt-[20px] p-0 rounded-b-[0px] flex gap-5 items-start lg:flex-row flex-col">
        @csrf
        @method('PUT')
        <div class="table-wrapper relative w-full md:max-w-[300px]">
            <div class="profile-wrapper w-full">
                <label for="image_path" class="profile-image w-full">
                    @if (isset($user->user->image_path))
                        <img src="{{ asset($user->user->image_path) }}" alt="Profile Image" class="rounded-full w-full brightness-50 edit-profile-preview-img aspect-square object-cover object-center h-auto"/>
                    @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Profile Image" class="edit-profile-preview-img rounded-full w-full aspect-square object-cover object-center h-auto brightness-50"/>
                    @endif

                    <svg class="duration-200 hover:scale-110 w-10 h-10 absolute top-[40%] right-[43%] cursor-pointer" viewBox="0 0 718 650" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M212.281 74.5553C221.175 30.8927 260.029 0 304.543 0H413.457C457.97 0 496.823 30.8927 505.72 74.5553C507.773 84.6347 516.903 92.0287 526.4 92.0287H526.947L527.493 92.0523C574.273 94.098 610.207 99.839 640.207 119.519C659.107 131.919 675.363 147.872 688.033 166.488C703.797 189.649 710.747 216.231 714.08 248.382C717.333 279.793 717.333 319.167 717.333 369.037V371.873C717.333 421.743 717.333 461.117 714.08 492.527C710.747 524.677 703.797 551.26 688.033 574.42C675.363 593.037 659.107 608.99 640.207 621.39C616.757 636.773 589.873 643.557 557.267 646.813C525.343 650 485.3 650 434.447 650H283.552C232.699 650 192.656 650 160.732 646.813C128.126 643.557 101.244 636.773 77.7951 621.39C58.8941 608.99 42.6351 593.037 29.9664 574.42C14.2041 551.26 7.25209 524.677 3.92075 492.527C0.666088 461.117 0.666421 421.743 0.666755 371.873V369.037C0.666421 319.167 0.666088 279.793 3.92075 248.382C7.25209 216.231 14.2041 189.649 29.9664 166.488C42.6351 147.872 58.8941 131.919 77.7951 119.519C107.794 99.839 143.727 94.098 190.508 92.0523L191.054 92.0287H191.6C201.096 92.0287 210.228 84.635 212.281 74.5553ZM304.543 50C283.174 50 265.302 64.7663 261.275 84.5357C254.753 116.553 226.367 141.729 192.211 142.026C147.257 144.023 123.179 149.545 105.221 161.326C91.7698 170.151 80.2508 181.47 71.3021 194.619C62.0971 208.145 56.5654 225.442 53.6544 253.535C50.6981 282.07 50.6668 318.853 50.6668 370.453C50.6668 422.057 50.6981 458.84 53.6544 487.373C56.5654 515.467 62.0971 532.763 71.3021 546.29C80.2508 559.44 91.7698 570.76 105.221 579.583C119.139 588.713 136.948 594.187 165.701 597.06C194.85 599.97 232.398 600 284.926 600H433.073C485.603 600 523.15 599.97 552.3 597.06C581.053 594.187 598.86 588.713 612.78 579.583C626.23 570.76 637.75 559.44 646.697 546.29C655.903 532.763 661.433 515.467 664.347 487.373C667.303 458.84 667.333 422.057 667.333 370.453C667.333 318.853 667.303 282.07 664.347 253.535C661.433 225.442 655.903 208.145 646.697 194.619C637.75 181.47 626.23 170.151 612.78 161.326C594.82 149.545 570.743 144.023 525.79 142.026C491.633 141.729 463.247 116.553 456.727 84.5357C452.697 64.7663 434.827 50 413.457 50H304.543ZM359 233.333C372.807 233.333 384 244.526 384 258.333V333.333H459C472.807 333.333 484 344.527 484 358.333C484 372.14 472.807 383.333 459 383.333H384V458.333C384 472.14 372.807 483.333 359 483.333C345.193 483.333 334 472.14 334 458.333V383.333H259C245.193 383.333 234 372.14 234 358.333C234 344.527 245.193 333.333 259 333.333H334V258.333C334 244.526 345.193 233.333 359 233.333ZM534 258.333C534 244.526 545.193 233.333 559 233.333H592.333C606.14 233.333 617.333 244.526 617.333 258.333C617.333 272.14 606.14 283.333 592.333 283.333H559C545.193 283.333 534 272.14 534 258.333Z" fill="#EEEEEE"/>
                    </svg>
                </label>
            </div>
            <input type="file" name="image_path" id="image_path" class="hidden edit-profile-input">
            @error('image_path')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="table-wrapper w-full">
            <div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label for="name" class="text-second">Nama Lengkap</label>
                        <input required type="text" name="name" class="input-crud"
                            value="{{ $user->name }}" />
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label for="username" class="text-second">Username</label>
                        <input required type="text" name="username" class="input-crud"
                            value="{{ $user->user->username }}" />
                        @error('username')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label for="email" class="text-second">Email</label>
                        <input required type="email" name="email" class="input-crud"
                            value="{{ $user->user->email }}" />
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-12 mb-4 flex flex-col">
                        <label for="password" class="text-second">Password</label>
                        <input type="password" name="password" class="input-crud" />
                        @error('password')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 flex items-center gap-2 mt-5">
                        <button class="button btn-main" type="submit">Edit Profile</button>
                        <a href="{{ route('profile.index') }}" class="button text-white btn-second" type="reset">Batal
                            Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        previewImg("edit-profile-input", "edit-profile-preview-img")
    </script>
@endpush
