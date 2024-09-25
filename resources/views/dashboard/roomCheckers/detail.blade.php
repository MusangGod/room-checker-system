@extends('layouts.main')
@section('title', 'Detail Pengecekan Ruangan')
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
    {{-- Delete Tag Modal --}}
    <x-modal-delete>
        <x-slot name="name">Pengecekan Ruangan</x-slot>
        <x-slot name="modalId">roomCheckers</x-slot>
        <x-slot name="formId">delete_room_checker_form</x-slot>
    </x-modal-delete>
@endsection
@push('js')
    <script>
        // delete tag
        $(".btn-delete-modal").attr("disabled", true)
        $(".delete-room-checker-data").on("click", function() {
            const item_id = $(this).closest('.table-body').find('.item_id').val()
            $("#delete_room_checker_form").attr("action", `/dashboard/roomCheckers/${item_id}`)

            $(".btn-delete-modal").attr("disabled", false)
        })
    </script>
@endpush

