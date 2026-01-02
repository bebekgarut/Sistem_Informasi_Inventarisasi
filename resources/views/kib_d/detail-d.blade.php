<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Detail Data KIB D</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-info-circle"></i></i>&nbsp;Detail Data</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close"><span>&times;</span></button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md text-center">
                        @if ($kibd->FOTO)
                            <img src="{{ route('photos.show', ['filename' => basename($kibd->FOTO)]) }}" width="50%"
                                style="margin-bottom: 10px;">
                        @else
                            <img src="{{ asset('img/default_image.jpg') }}" style="margin-bottom: 10px;" width="30%"
                                alt="">
                        @endif
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <table class="table table-striped mb-0 fixed-width-table">
                            <tbody>
                                <tr>
                                    <th scope="row">Jenis Barang/Nama Barang</th>
                                    <td>{{ $kibd->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barang</th>
                                    <td>{{ $kibd->kode_barang }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nibar</th>
                                    <td>{{ $kibd->nibar }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Register</th>
                                    <td>{{ $kibd->nomor_register }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Spesifikasi Nama Barang</th>
                                    <td>{{ $kibd->spesifikasi_nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Spesifikasi lainnya</th>
                                    <td>{{ $kibd->spesifikasi_lainnya }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Ruas Jalan</th>
                                    <td>{{ $kibd->nomor_ruas_jalan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Ruas Jembatan</th>
                                    <td>{{ $kibd->nomor_ruas_jembatan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Ruas Jaringan Irigasi</th>
                                    <td>{{ $kibd->nomor_ruas_jaringan_irigasi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Lokasi</th>
                                    <td>{{ $kibd->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Titik Koordinat</th>
                                    <td>{{ $kibd->titik_koordinat }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Kepemilikan Tanah</th>
                                    <td>{{ $kibd->status_kepemilikan_tanah }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah</th>
                                    <td>{{ $kibd->jumlah }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Satuan</th>
                                    <td>{{ $kibd->satuan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga Satuan Perolehan</th>
                                    <td class="format-number">{{ $kibd->harga_satuan_perolehan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Perolehan</th>
                                    <td>{{ $kibd->tanggal_perolehan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nilai Perolehan</th>
                                    <td class="format-number">{{ $kibd->nilai_perolehan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Penggunaan</th>
                                    <td>{{ $kibd->status_penggunaan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td>{{ $kibd->keterangan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengguna Barang</th>
                                    <td>{{ $kibd->PENGGUNA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unduh File</th>
                                    <td>
                                        @if ($kibd->DOWNLOAD)
                                            <a href="{{ route('files.download', ['filename' => basename($kibd->DOWNLOAD)]) }}"
                                                target="_blank">
                                                <p style="color: blue;height:10px">Unduh PDF</p>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md text-center">
                        <a href="{{ route('editDataKibd', $kibd->id) }}" class="btn">Edit</a>
                        <button type="button" class="btn" data-bs-toggle="modal"
                            data-bs-target="#hapusModal">Hapus</button>
                        <a href="{{ session('previous_url') }}" class="btn">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                            <form id="" method="post" action="{{ route('hapusDataKibd', $kibd->id) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
