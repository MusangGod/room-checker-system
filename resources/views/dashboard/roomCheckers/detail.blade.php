@extends('layouts.main')
@section('title', 'Detail Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px] input-teacher">
        <x-viewRoomChecker
            room_id="{{$room->id}}"
            :rooms="$roomChecker"
        />
        <div class="col-span-12 flex items-center gap-3 mt-2">
            <a href="{{ route('roomCheckers.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
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

