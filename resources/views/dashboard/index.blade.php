@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.main')
@section('title')
    Halaman Dashboard
@endsection

@section('main')
    @if(App\Enums\Role::ADMIN)
        <div class="py-14 pt-2">
            <div class="px-9 py-8 dashbaord-banner">
                <p class="text-sm text-white">Hi, {{ auth()->user()->username  }}
                    sebagai {{ auth()->user()->role->label() }}</p>
                <h4 class="text-3xl text-white font-semibold max-w-[450px]">
                    Selamat datang di sistem pengecekan ruangan
                </h4>
            </div>

            <div class="grid lg:grid-cols-2 mt-[20px] md:grid-cols-2 grid-cols-1 gap-8">
                <div class="card-dashboard flex justify-between items-start">
                    <div class="">
                        <p class="mb-0 capitalize text-sm font-medium desc">Total Post</p>
                        <h1 class="m-0 text-3xl font-semibold text-main">{{ $posts_count }}</h1>
                    </div>
                    <div class="">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_379_1406)">
                                <path
                                    d="M12.5626 4.72069e-05C12.9593 0.0757035 13.3612 0.13125 13.752 0.230156C16.5441 0.936891 18.6359 3.39539 18.9006 6.26789C19.2244 9.78309 16.939 12.9369 13.4845 13.7077C12.9784 13.8206 12.4481 13.8607 11.928 13.8682C9.92925 13.8972 7.977 14.1678 6.10688 14.9047C5.0475 15.322 4.05385 15.8578 3.18839 16.6066C2.32472 17.3539 1.89235 18.3083 1.8765 19.4486C1.86867 20.0109 1.8728 20.5735 1.87575 21.1359C1.87884 21.7268 2.27053 22.1239 2.85928 22.124C8.95247 22.1255 15.0456 22.1254 21.1388 22.1241C21.7277 22.1239 22.1265 21.7273 22.1229 21.1376C22.1183 20.404 22.1405 19.6668 22.0743 18.9381C21.9913 18.0239 21.551 17.2635 20.8661 16.6531C20.1663 16.0296 19.3661 15.5634 18.5163 15.1755C18.0258 14.9517 17.8111 14.5012 17.952 14.0291C18.1012 13.5299 18.6391 13.2078 19.1158 13.4104C20.6193 14.0493 21.9995 14.8757 22.9809 16.2317C23.5313 16.9921 23.8457 17.851 23.9575 18.7837C23.9638 18.8359 23.9855 18.8863 24 18.9375C24 19.8125 24 20.6875 24 21.5625C23.9836 21.6124 23.9629 21.6614 23.9514 21.7125C23.7158 22.7577 23.0996 23.4732 22.0945 23.847C21.9221 23.9112 21.7401 23.9497 21.5625 24C15.1875 24 8.8125 24 2.4375 24C2.38753 23.9836 2.33855 23.9625 2.28745 23.9515C1.46077 23.7733 0.806531 23.3371 0.393328 22.5983C0.214968 22.2795 0.128297 21.9093 0 21.5625C0 20.6875 0 19.8125 0 18.9375C0.0136406 18.8938 0.0344995 18.851 0.039937 18.8063C0.224109 17.3025 0.905251 16.0688 2.06428 15.0991C3.34617 14.0267 4.815 13.3028 6.40078 12.8046C6.83606 12.6679 7.27936 12.5566 7.71975 12.4335C7.71187 12.4079 7.71164 12.3899 7.70255 12.3809C7.67484 12.3535 7.64363 12.3299 7.614 12.3045C5.75156 10.7093 4.89314 8.69222 5.10394 6.24436C5.34291 3.46922 7.38305 1.02455 10.068 0.281954C10.5162 0.158016 10.9806 0.0925312 11.4375 0C11.8126 4.6875e-05 12.1876 4.72069e-05 12.5626 4.72069e-05ZM17.0624 6.94598C17.0665 4.16264 14.8059 1.88653 12.0263 1.87533C9.23105 1.86408 6.94641 4.12758 6.93783 6.91673C6.9292 9.71081 9.19552 11.9931 11.9853 11.9999C14.7778 12.0066 17.0582 9.73664 17.0624 6.94598Z"
                                    fill="#141414" fill-opacity="0.32"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_379_1406">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
                <div class="card-dashboard flex justify-between items-start">
                    <div class="">
                        <p class="mb-0 capitalize text-sm font-medium desc">Total Category</p>
                        <h1 class="m-0 text-3xl font-semibold text-main">{{ $tags_count }}</h1>
                    </div>
                    <div class="">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_379_1406)">
                                <path
                                    d="M12.5626 4.72069e-05C12.9593 0.0757035 13.3612 0.13125 13.752 0.230156C16.5441 0.936891 18.6359 3.39539 18.9006 6.26789C19.2244 9.78309 16.939 12.9369 13.4845 13.7077C12.9784 13.8206 12.4481 13.8607 11.928 13.8682C9.92925 13.8972 7.977 14.1678 6.10688 14.9047C5.0475 15.322 4.05385 15.8578 3.18839 16.6066C2.32472 17.3539 1.89235 18.3083 1.8765 19.4486C1.86867 20.0109 1.8728 20.5735 1.87575 21.1359C1.87884 21.7268 2.27053 22.1239 2.85928 22.124C8.95247 22.1255 15.0456 22.1254 21.1388 22.1241C21.7277 22.1239 22.1265 21.7273 22.1229 21.1376C22.1183 20.404 22.1405 19.6668 22.0743 18.9381C21.9913 18.0239 21.551 17.2635 20.8661 16.6531C20.1663 16.0296 19.3661 15.5634 18.5163 15.1755C18.0258 14.9517 17.8111 14.5012 17.952 14.0291C18.1012 13.5299 18.6391 13.2078 19.1158 13.4104C20.6193 14.0493 21.9995 14.8757 22.9809 16.2317C23.5313 16.9921 23.8457 17.851 23.9575 18.7837C23.9638 18.8359 23.9855 18.8863 24 18.9375C24 19.8125 24 20.6875 24 21.5625C23.9836 21.6124 23.9629 21.6614 23.9514 21.7125C23.7158 22.7577 23.0996 23.4732 22.0945 23.847C21.9221 23.9112 21.7401 23.9497 21.5625 24C15.1875 24 8.8125 24 2.4375 24C2.38753 23.9836 2.33855 23.9625 2.28745 23.9515C1.46077 23.7733 0.806531 23.3371 0.393328 22.5983C0.214968 22.2795 0.128297 21.9093 0 21.5625C0 20.6875 0 19.8125 0 18.9375C0.0136406 18.8938 0.0344995 18.851 0.039937 18.8063C0.224109 17.3025 0.905251 16.0688 2.06428 15.0991C3.34617 14.0267 4.815 13.3028 6.40078 12.8046C6.83606 12.6679 7.27936 12.5566 7.71975 12.4335C7.71187 12.4079 7.71164 12.3899 7.70255 12.3809C7.67484 12.3535 7.64363 12.3299 7.614 12.3045C5.75156 10.7093 4.89314 8.69222 5.10394 6.24436C5.34291 3.46922 7.38305 1.02455 10.068 0.281954C10.5162 0.158016 10.9806 0.0925312 11.4375 0C11.8126 4.6875e-05 12.1876 4.72069e-05 12.5626 4.72069e-05ZM17.0624 6.94598C17.0665 4.16264 14.8059 1.88653 12.0263 1.87533C9.23105 1.86408 6.94641 4.12758 6.93783 6.91673C6.9292 9.71081 9.19552 11.9931 11.9853 11.9999C14.7778 12.0066 17.0582 9.73664 17.0624 6.94598Z"
                                    fill="#141414" fill-opacity="0.32"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_379_1406">
                                    <rect width="24" height="24" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card-dashboard-wrapper mt-[20px]">
                <div class="flex sm:flex-row flex-col gap-3 justify-between">
                    <h6 class="text-2xl font-semibold text-second mb-0">Grafik Total Post</h6>
                    <div class="category1 item">
                        <button id="dropdownDefaultButton" onclick="showItems('category1')"
                                data-dropdown-toggle="dropdown"
                                class="flex rounded-full w-max btn-dropdown category-name active" type="button">
                            Tahun ini
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown"
                             class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <button onclick="showItems('category2')" class="link-dropdown category-name">Bulan
                                        ini
                                    </button>
                                </li>
                                <li>
                                    <button onclick="showItems('category3')" class="link-dropdown category-name">Minggu
                                        ini
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="category2 item" style="display: none">
                        <button id="dropdownDefaultButton2" onclick="showItems('category2')"
                                data-dropdown-toggle="dropdown2"
                                class="flex rounded-full btn-dropdown category-name active" type="button">
                            Bulan ini
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown2"
                             class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton2">
                                <li>
                                    <button onclick="showItems('category3')" class="link-dropdown category-name">Minggu
                                        ini
                                    </button>
                                </li>
                                <li>
                                    <button onclick="showItems('category1')" class="link-dropdown category-name">Tahun
                                        ini
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="category3 item" style="display: none">
                        <button id="dropdownDefaultButton3" onclick="showItems('category3')"
                                data-dropdown-toggle="dropdown3"
                                class="flex btn-dropdown rounded-full category-name active" type="button">
                            Minggu ini
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown3"
                             class="z-30 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm ps-0" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <button onclick="showItems('category1')" class="link-dropdown category-name">Tahun
                                        ini
                                    </button>
                                </li>
                                <li>
                                    <button onclick="showItems('category2')" class="link-dropdown category-name">Bulan
                                        ini
                                    </button>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
                <div class="category-content mt-[32px]">
                    <div class="category1 item">
                        <div class="" id="chart1"></div>
                    </div>
                    <div class="category2 item" style="display: none">
                        <div class="" id="chart2"></div>
                    </div>
                    <div class="category3 item" style="display: none">
                        <div class="" id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>

        @else
        <div class="px-9 py-8 dashbaord-banner">
            <p class="text-sm text-white">Hi, {{ auth()->user()->username  }}
                sebagai {{ auth()->user()->role->label() }}</p>
            <h4 class="text-3xl text-white font-semibold max-w-[350px]">
                Segera Lakukan Pengecekan Ruangan
            </h4>
        </div>

    @endif

@endsection

@push('js')
    <script>
        let post_yearly = <?= json_encode($post_yearly); ?>;
        let post_monthly = <?= json_encode($post_monthly); ?>;
        let post_weekly = <?= json_encode($post_weekly); ?>;

        document.addEventListener('DOMContentLoaded', function () {
            var showCategory = 'category1';
            var showAllCategory = document.querySelector(`.category-name[data-category="${showCategory}"]`);
            showAllCategory.classList.add('active');
            showCategory.style.display = 'flex';
            showItems(showCategory); // Panggil fungsi showItems() dengan kategori 'category1' sebagai default
        });

        function showItems(category) {
            // Menghapus kelas "active" dari semua kategori
            var categories = document.getElementsByClassName('.category-name');
            for (var i = 0; i < categories.length; i++) {
                categories[i].classList.remove('active');
            }

            // Menambahkan kelas "active" ke kategori yang dipilih
            var selectedCategory = event.target;
            if (!selectedCategory.classList.contains('active')) {
                selectedCategory.classList.add('active');
            }

            // Menampilkan item-item yang memiliki kategori yang sama dengan kategori yang dipilih
            var items = document.getElementsByClassName('item');
            for (var j = 0; j < items.length; j++) {
                items[j].style.display = 'none';
                if (items[j].classList.contains(category)) {
                    items[j].style.display = 'block';
                }
            }
        }

        let options1 = {
            chart: {
                type: 'bar',
                height: 215
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: 26,
                    endingShape: 'rounded',
                    startingShape: 'rounded',
                    rounded: '50%',
                    borderRadius: 5,
                    // borderRadiusApplication: 'end',
                },
            },
            colors: ['#6562E8', '#7D7AFF'],

            series: [{
                name: 'Postingan',
                data: post_yearly
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des']
            },
            yaxis: {
                categories: [10, 20, 30, 40, 50]
            }
        }

        let options2 = {
            chart: {
                type: 'bar',
                height: 215
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: 26,
                    endingShape: 'rounded',
                    startingShape: 'rounded',
                    rounded: '50%',
                    borderRadius: 5,
                    // borderRadiusApplication: 'end',
                },
            },
            colors: ['#6562E8', '#7D7AFF'],

            series: [{
                name: 'Postingan',
                data: post_monthly
            }],
            xaxis: {
                categories: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4']
            },
            yaxis: {
                categories: [10, 20, 30, 40, 50]
            }
        }

        let options3 = {
            chart: {
                type: 'bar',
                height: 215
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: 26,
                    endingShape: 'rounded',
                    startingShape: 'rounded',
                    rounded: '50%',
                    borderRadius: 5,
                    // borderRadiusApplication: 'end',
                },
            },
            colors: ['#6562E8', '#7D7AFF'],

            series: [{
                name: 'Postingan',
                data: post_weekly
            }],
            xaxis: {
                categories: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']
            },
            yaxis: {
                categories: [10, 20, 30, 40, 50]
            }
        }

        let chart = new ApexCharts(document.querySelector("#chart1"), options1);
        let chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        let chart3 = new ApexCharts(document.querySelector("#chart3"), options3);

        chart.render();
        chart2.render();
        chart3.render();
    </script>
@endpush
