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
                <div class= "header">
                    <div class="custom-select-container">
                        <form action="{{ route('arsipSearch') }}">
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
                        <h3 class="fw-bold text-uppercase">Hasil Pencarian : {{ request()->input('keyword') }}</h3>
                    @else
                        <h3 class="fw-bold text-uppercase">Arsip Digital</h3>
                        <p class="deskripsi1 mt-0" style="font-style: italic">
                            "Arsip Digital ini berisi dokumen-dokumen penting terkait alas hak tanah dan aset
                            lainnya."</p>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close"><span>&times;</span></button>
                        </div>
                    @endif
                    <hr>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md">
                    <a href="{{ route('arsipTambah') }}" class="btn"><i class="fas fa-plus"></i>&nbsp;Tambah
                        Data</a>
                </div>
            </div>
            <div class="row my-3">
                <div class="table-responsive col-md">
                    Showing {{ $arsip->count() }} of {{ $arsip->total() }} data
                    <table class="table table-striped text-center mb-0">
                        <thead>
                            <tr>
                                <th class="no">No.</th>
                                <th class="fixed-width-column">Nama Subjek</th>
                                <th class="fixed-width-column">Alamat</th>
                                <th class="fixed-width-column">File</th>
                                <th class="fixed-aksi-column">Aksi</th>
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
                                                style="color: blue" target="_blank"><i class="fas fa-file-pdf mr-1"
                                                    style="color: red"></i>{{ basename($file->file_path) }}</a><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('arsipEdit', $item->id) }}" class="btn btn-sm user"><i
                                                class="bi bi-pencil-square"></i>&nbsp;Edit</a>
                                        <button class="btn btn-sm user" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal{{ $item->id }}"><i
                                                class="bi bi-trash-fill"></i>&nbsp;Hapus</button>
                                        <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="hapusModalLabel{{ $item->id }}">Konfirmasi
                                                            Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-left">
                                                        Apakah Anda yakin ingin menghapus data
                                                        <b>{{ $item->nama_subjek }}</b>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <form method="post"
                                                            action="{{ route('arsipHapus', $item->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{ $arsip->links('pagination::bootstrap-4') }}
                        </ul>
                    </nav>
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
