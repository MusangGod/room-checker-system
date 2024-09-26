{{--@dd($staffRooms)--}}
@php
    function changeStatus($status): string
    {
//        $newStatus = '';
        if ($status == 'done'){
            $newStatus = 'selesai';
        } else if ($status == 'on_progress') {
            $newStatus = 'sedang pengecekan';
        } else {
            $newStatus = 'belum di cek';
        }
        return $newStatus ;
    }
@endphp
@extends('layouts.main')
@section('title', 'Halaman Pengecekan Ruangan')
@section('main')
    <div class="table-wrapper mt-[20px]">
        @if(auth()->user()->role == App\Enums\Role::ADMIN)
            <div class="flex justify-between items-center gap-3">
                <div class="input-wrapper flex gap-2 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M9.75 4.875C9.75 5.95078 9.40078 6.94453 8.8125 7.75078L11.7797 10.7203C12.0727 11.0133 12.0727 11.4891 11.7797 11.782C11.4867 12.075 11.0109 12.075 10.718 11.782L7.75078 8.8125C6.94453 9.40312 5.95078 9.75 4.875 9.75C2.18203 9.75 0 7.56797 0 4.875C0 2.18203 2.18203 0 4.875 0C7.56797 0 9.75 2.18203 9.75 4.875ZM4.875 8.25C5.31821 8.25 5.75708 8.1627 6.16656 7.99309C6.57603 7.82348 6.94809 7.57488 7.26149 7.26149C7.57488 6.94809 7.82348 6.57603 7.99309 6.16656C8.1627 5.75708 8.25 5.31821 8.25 4.875C8.25 4.43179 8.1627 3.99292 7.99309 3.58344C7.82348 3.17397 7.57488 2.80191 7.26149 2.48851C6.94809 2.17512 6.57603 1.92652 6.16656 1.75691C5.75708 1.5873 5.31821 1.5 4.875 1.5C4.43179 1.5 3.99292 1.5873 3.58344 1.75691C3.17397 1.92652 2.80191 2.17512 2.48851 2.48851C2.17512 2.80191 1.92652 3.17397 1.75691 3.58344C1.5873 3.99292 1.5 4.43179 1.5 4.875C1.5 5.31821 1.5873 5.75708 1.75691 6.16656C1.92652 6.57603 2.17512 6.94809 2.48851 7.26149C2.80191 7.57488 3.17397 7.82348 3.58344 7.99309C3.99292 8.1627 4.43179 8.25 4.875 8.25Z"
                              fill="#282421" fill-opacity="0.52"/>
                    </svg>
                    <input type="search" class="searchInputTable w-full focus:ring-0 focus:outline-none" placeholder="Cari data ruangan ...">
                </div>
            </div>
            <div class="mt-[32px]">
                <table class="dataTable w-full ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($rooms as $item)
                        <tr class="table-body">
                            <input type="hidden" class="item_id" value="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->room_category->name }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('roomCheckers.detail', $item->id) }}"  class="icon-table icon-detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                            <g clip-path="url(#clip0_7909_2017)">
                                                <path d="M0 7.78109C0.212656 6.95097 0.740438 6.29931 1.24125 5.6395C2.12616 4.47366 3.19309 3.50834 4.50056 2.82897C5.7475 2.18103 7.07422 1.89766 8.4775 1.98525C10.5819 2.11656 12.3039 3.05512 13.7758 4.51181C14.561 5.28887 15.2174 6.16656 15.7538 7.13109C15.8652 7.33144 15.9194 7.56362 16 7.78112C16 7.92697 16 8.07278 16 8.21862C15.8249 8.97666 15.3426 9.56675 14.9142 10.1839C14.7143 10.472 14.3293 10.5169 14.0539 10.3173C13.7778 10.1172 13.7147 9.75144 13.9047 9.45662C14.1583 9.06322 14.4121 8.66997 14.664 8.27553C14.7712 8.10766 14.7799 7.93334 14.6796 7.75862C13.9052 6.40959 12.9389 5.23069 11.6377 4.35347C10.4538 3.55537 9.14866 3.16141 7.71775 3.22531C6.30425 3.28844 5.05559 3.80041 3.94309 4.65969C2.85125 5.50303 2.00934 6.55978 1.32541 7.74953C1.23597 7.90512 1.21938 8.06566 1.30903 8.22512C2.15775 9.73437 3.23072 11.0487 4.76469 11.8967C7.13203 13.2055 9.46419 13.0716 11.7278 11.601C11.865 11.5118 12.0125 11.4158 12.168 11.3827C12.4535 11.3219 12.7262 11.4948 12.8329 11.7585C12.9426 12.0291 12.8587 12.3243 12.6085 12.5059C11.8959 13.023 11.1268 13.4367 10.2803 13.683C7.68197 14.4388 5.30903 13.9606 3.16566 12.3297C1.92459 11.3854 0.971719 10.1891 0.22 8.83041C0.116406 8.64316 0.071875 8.42331 0 8.21859C0 8.07275 0 7.92694 0 7.78109Z" fill="#547DE2" fill-opacity="0.72"/>
                                                <path d="M8.0061 4.3125C10.036 4.31416 11.6898 5.97288 11.6872 8.00463C11.6847 10.0346 10.0251 11.6891 7.99442 11.6862C5.96438 11.6833 4.31129 10.0247 4.31348 7.99294C4.31567 5.96275 5.97304 4.31084 8.0061 4.3125ZM5.56332 7.99266C5.56117 9.33472 6.65157 10.4327 7.99017 10.4363C9.33235 10.4399 10.4326 9.35031 10.4374 8.01275C10.4422 6.66231 9.35004 5.56328 8.00245 5.56247C6.66035 5.56169 5.56548 6.65253 5.56332 7.99266Z" fill="#547DE2" fill-opacity="0.72"/>
                                                <path d="M8.00165 9.24923C7.4749 9.24976 6.99381 8.90895 6.81996 8.41211C6.64699 7.91773 6.8044 7.3608 7.20984 7.03167C7.32752 6.93614 7.45071 6.86733 7.60934 6.93083C7.77293 6.99633 7.8179 7.12973 7.83421 7.29023C7.8854 7.7938 8.20712 8.11601 8.70849 8.16561C8.86902 8.18148 9.00259 8.22561 9.06846 8.38926C9.13227 8.54776 9.06418 8.67076 8.96859 8.78886C8.73612 9.07592 8.37409 9.24886 8.00165 9.24923Z" fill="#547DE2" fill-opacity="0.72"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_7909_2017">
                                                    <rect width="16" height="16" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <form method="get" class="flex gap-3 items-center">
                <input value="{{$date ?? '' }}" name="date" type="date" class="input-crud w-[250px]">
                <button class="button btn-main" type="submit">Cari</button>
            </form>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4 mt-4">
                @forelse($staffRooms as $item)
                    <div class="card-room px-5 py-4 shadow-lg rounded border-t-[10px] border-t-main">
                        <h6 class="text-center text-second mb-0">Ruangan {{$item->category}}</h6>
                        <h3 class="text-center text-second mt-2">{{$item->name}}</h3>
                        <div class="flex gap-3 justify-center">
                            <h5 class="text-second capitalize">Status :
                                <span class="{{$item->status == 'done' ? 'text-green-600' : ($item->status == 'on_progress' ? 'text-yellow-600' : 'text-red-600')}} font-semibold">
                                    {{changeStatus($item->status)}}
                                </span>
                            </h5>
                        </div>
                        @if($item->status != 'belum')
                            <div class="mt-6">
                                <a href="{{route('roomCheckers.edit', $item->room_check_id)}}" class="">
                                    <button class="button btn-main w-full">Edit</button>
                                </a>
                            </div>
                        @endif
                    </div>
                @empty
                    <h2 class="text-center">data kosong</h2>
                @endforelse
            </div>
        @endif
    </div>

    {{-- Delete Tag Modal --}}
    <x-modal-delete>
        <x-slot name="name">Ruangan</x-slot>
        <x-slot name="modalId">Room</x-slot>
        <x-slot name="formId">delete_room_form</x-slot>
    </x-modal-delete>
@endsection

@push('js')
    <script>
        // delete tag
        $(".btn-delete-modal").attr("disabled", true)
        $(".delete-tag-data").on("click", function() {
            const item_id = $(this).closest('.table-body').find('.item_id').val()
            $("#delete_room_form").attr("action", `/dashboard/rooms/${item_id}`)

            $(".btn-delete-modal").attr("disabled", false)
        })
    </script>
@endpush
