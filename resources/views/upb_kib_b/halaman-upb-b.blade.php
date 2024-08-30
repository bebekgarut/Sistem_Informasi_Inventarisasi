<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Data KIB B</title>
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
    <div class="wrapper">
        <x-upbsidebar></x-upbsidebar>

        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Data KIB B</h3>
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
                        <a href="{{ route('add-upb-b', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}" class="btn "><i
                                class="bi bi-person-plus-fill"></i>&nbsp;Tambah
                            Data</a>
                        <a href="{{ route('export-upb-b', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}" target="_blank"
                            class="btn"><i class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke
                            Excel</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="table-responsive col-md">
                        Showing {{ $kibb->count() }} of {{ $kibb->total() }} data
                        <table class="table table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="fixed-width-column">Nama Barang</th>
                                    <th class="fixed-width-column">Merk/Type</th>
                                    <th class="fixed-width-column">Nomor Polisi</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kibb as $kibbs)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kibbs->NAMA_BARANG }}</td>
                                        <td>{{ $kibbs->MERK_TYPE }}</td>
                                        <td>{{ $kibbs->NOMOR_POLISI }}</td>
                                        <td>
                                            <a href="{{ route('detail-upb-b', ['KODE_UPB' => $kibbs->KODE_UPB, 'id' => $kibbs->id]) }}"
                                                class="btn btn-sm d-block d-md-inline-block mb-2 mb-md-0 detail"
                                                data-id="nis1" style="font-weight: 600; margin-top:0px;">
                                                <i class="bi bi-info-circle-fill"></i>&nbsp;Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data KIB B yang tersedia.
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
                                    {{ $kibb->links('pagination::bootstrap-4') }}
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
