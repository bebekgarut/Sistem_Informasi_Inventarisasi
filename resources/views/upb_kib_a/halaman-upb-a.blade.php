<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Data KIB A</title>
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
    <style>
        @media (max-width: 768px) {
            .pagination li:nth-child(n+10):not(:last-child) {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-upbsidebar></x-upbsidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Data KIB A</h3>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('hapus'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('hapus') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <a href="{{ route('add-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}" class="btn "><i
                                class="fas fa-plus"></i>&nbsp;Tambah
                            Data</a>
                        <a href="{{ route('export-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}" target="_blank"
                            class="btn"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke
                            Excel</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="table-responsive col-md">
                        Showing {{ $kiba->count() }} of {{ $kiba->total() }} data
                        <table class="table table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="no">No.</th>
                                    <th class="fixed-width-column">Nama Barang</th>
                                    <th class="fixed-width-column">Letak/Alamat</th>
                                    <th class="fixed-width-column">Penggunaan</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kiba as $kibas)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kibas->NAMA_BARANG }}</td>
                                        <td>{{ $kibas->LETAK_ALAMAT }}</td>
                                        <td>{{ $kibas->PENGGUNAAN }}</td>
                                        <td>
                                            <a href="{{ route('detail-upb-a', ['KODE_UPB' => $kibas->KODE_UPB, 'id' => $kibas->id]) }}"
                                                class="btn btn-sm d-block d-md-inline-block mb-2 mb-md-0 detail"
                                                data-id="nis1" style="font-weight: 600; margin-top:0px;">
                                                <i class="bi bi-info-circle-fill"></i>&nbsp;Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data KIB A yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{ $kiba->links('pagination::bootstrap-4') }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
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
