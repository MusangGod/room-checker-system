@extends('layouts.main')
@section('title', 'Detail Staff')
@section('main')

	<div class="table-wrapper mt-[20px] input-teacher">
		<form class="grid grid-cols-12 gap-4">
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="nama" class="text-second mb-1">Nama</label>
				<input
					type="text"
				 	class="input-crud"
					value="{{ $staff->name }}"
					disabled
				/>
			</div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
            <label for="nama" class="text-second mb-1">Nomor Pegawai</label>
				<input
					type="text"
				 	class="input-crud"
					value="{{ $staff->name }}"
					disabled
				/>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="username" class="text-second mb-1">Username</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $staff->user->username }}"
					disabled
				>
			</div>
			<div class="col-span-12 md:col-span-6 flex flex-col">
				<label for="email" class="text-second mb-1">Email</label>
				<input
					type="text"
					class="input-crud"
					value="{{ $staff->user->email }}"
					disabled
				>
			</div>
			<div class="col-span-12 flex flex-col">
				<p class="text-second mb-1">Status Akun</p>
				<label class="switch">
					<input type="checkbox" disabled @checked($staff->user->status ? 'on' : '')>
					<span class="slider round"></span>
				</label>
			</div>
			<div class="col-span-12 flex flex-col">
				<label for="image_path" class="text-second mb-1">Foto Profil</label>
				<label for="image_path" class="d-block mb-3">
					@if ($staff->user->image_path)
						<img src="{{ asset($staff->user->image_path) }}" class="border" width="300" alt="">
					@else
						<img src="{{ asset('assets/img/upload-image.jpg') }}" class="border" width="300" alt="">
					@endif
				</label>
			</div>
			<div class="col-span-12 flex items-center gap-3 mt-2">
				<a href="{{ route('staffs.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
			</div>
		</form>
	</div>
@endsection
