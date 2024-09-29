<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Pencarian KIB C</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!--CSS-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js'])
    <style>
        @media (max-width: 768px) {
            .pagination li:nth-child(n+5):not(:last-child) {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <x-upbsidebar></x-upbsidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class= "header">
                    <div class="custom-select-container">
                        <form action="{{ route('search-upb-c', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}">
                            <label for="custom-select1" class="form-label perintah">Masukkan Kata Kunci</label>
                            <div class="search-box" method="GET">
                                <div class="icon-container">
                                    <svg viewBox="0 0 20 20" aria-hidden="true" class="icon">
                                        <path
                                            d="M16.72 17.78a.75.75 0 1 0 1.06-1.06l-1.06 1.06ZM9 14.5A5.5 5.5 0 0 1 3.5 9H2a7 7 0 0 0 7 7v-1.5ZM3.5 9A5.5 5.5 0 0 1 9 3.5V2a7 7 0 0 0-7 7h1.5ZM9 3.5A5.5 5.5 0 0 1 14.5 9H16a7 7 0 0 0-7-7v1.5Zm3.89 10.45 3.83 3.83 1.06-1.06-3.83-3.83-1.06 1.06ZM14.5 9a5.48 5.48 0 0 1-1.61 3.89l1.06 1.06A6.98 6.98 0 0 0 16 9h-1.5Zm-1.61 3.89A5.48 5.48 0 0 1 9 14.5V16a6.98 6.98 0 0 0 4.95-2.05l-1.06-1.06Z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" class="search-input" name="keyword" placeholder="Search..."
                                    value="{{ request('keyword') }}">
                                <button class="search-button" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row my-2">
                <div class="col-md">
                    @if (request()->has('keyword') && request()->input('keyword') != '')
                        <h3 class="fw-bold text-uppercase">Hasil Pencarian : {{ request()->input('keyword') }}
                        </h3>
                    @else
                        <h3 class="fw-bold text-uppercase">Data KIB C</h3>
                    @endif
                    <hr>
                </div>
            </div>
            <div class="row my-3">
                <div class="table-responsive col-md">
                    Showing {{ $kibc->count() }} of {{ $kibc->total() }} data
                    <table class="table table-striped text-center mb-0">
                        <thead>
                            <tr>
                                <th class="no">No.</th>
                                <th class="fixed-width-column">Nama Barang</th>
                                <th class="fixed-width-column">Letak/Alamat</th>
                                <th class="fixed-width-column">Keterangan</th>
                                <th class="action-column">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kibc as $kibcs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kibcs->NAMA_BARANG }}</td>
                                    <td>{{ $kibcs->LETAK_ALAMAT }}</td>
                                    <td>{{ $kibcs->KETERANGAN }}</td>
                                    <td>
                                        <a href="{{ route('detail-upb-c', ['KODE_UPB' => $kibcs->KODE_UPB, 'id' => $kibcs->id]) }}"
                                            class="btn btn-sm d-block d-md-inline-block mb-2 mb-md-0 detail"
                                            data-id="nis1" style="font-weight: 600; margin-top:0px;">
                                            <i class="bi bi-info-circle-fill"></i>&nbsp;Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan atau Data tidak
                                        ada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mt-3">
                                    {{ $kibc->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            function updatePagination() {
                if ($(window).width() <= 768) {
                    $('.pagination li').not(':nth-child(-n+4), :last-child, .active').hide();
                } else {
                    $('.pagination li').show();
                }
            }

            $(window).resize(function() {
                updatePagination();
            });

            updatePagination();
        });
    </script>
</body>

</html>
