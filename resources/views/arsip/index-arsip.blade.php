<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Arsip Lainnya</title>
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
        <x-sidebar></x-sidebar>

        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Arsip Lainnya</h3>
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
                        <a href="{{ route('arsipTambah') }}" class="btn "><i class="fas fa-plus"></i>&nbsp;Tambah
                            Data</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="table-responsive col-md">
                        {{-- Showing {{ $arsip->count() }} of {{ $arsip->total() }} data --}}
                        <table class="table table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="fixed-width-column">Nama Subjek</th>
                                    <th class="fixed-width-column">Alamat</th>
                                    <th class="fixed-width-column">File</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($arsip as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_subjek }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            @foreach ($item->files as $file)
                                                <a href="{{ route('filesArsip', ['filename' => basename($file->file_path)]) }}"
                                                    style="color: blue">{{ basename($file->file_path) }}</a><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a class="btn">edit</a>
                                            <a class="btn">hapus</a>
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
                                    {{-- {{ $arsip->links('pagination::bootstrap-4') }} --}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <form action="{{ route('arsipStore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama_subjek" placeholder="Nama Subjek">
        <input type="text" name="alamat" placeholder="Alamat">
        <input type="file" name="files[]" multiple>
        <button type="submit">Simpan</button>
    </form> --}}


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
