<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Detail Data KIB C</title>
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
        <x-upbsidebar></x-upbsidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-info-circle"></i></i>&nbsp;Detail Data</h3>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md text-center">
                        @if ($kibc->FOTO)
                            <img src="{{ route('photos.show', ['filename' => basename($kibc->FOTO)]) }}" width="50%"
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
                                    <td>{{ $kibc->NAMA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barang</th>
                                    <td>{{ $kibc->KODE_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Register</th>
                                    <td>{{ $kibc->NOMOR_REGISTER }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kondisi bangunan (B, KB, RB)</th>
                                    <td>{{ $kibc->KONDISI_BANGUNAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bertingkat/Tidak</th>
                                    <td>{{ $kibc->BANGUNAN_BERTINGKAT }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Beton/Tidak</th>
                                    <td>{{ $kibc->BANGUNAN_BETON }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Luas Lantai (M2)</th>
                                    <td class="format-number">{{ $kibc->LUAS_LANTAI }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>{{ $kibc->LETAK_ALAMAT }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Dokumen</th>
                                    <td>{{ $kibc->TANGGAL_DOKUMEN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Dokumen</th>
                                    <td>{{ $kibc->NOMOR_DOKUMEN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Luas (M2)</th>
                                    <td class="format-number">{{ $kibc->LUAS }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Tanah</th>
                                    <td>{{ $kibc->STATUS_TANAH }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Kode Tanah</th>
                                    <td>{{ $kibc->NOMOR_KODE_TANAH }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengguna Barang</th>
                                    <td>{{ $kibc->PENGGUNA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Asal Usul</th>
                                    <td>{{ $kibc->ASAL_USUL }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga (ribuan Rp)</th>
                                    <td class="format-number">{{ $kibc->HARGA }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td>{{ $kibc->KETERANGAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unduh Sertifikat</th>
                                    <td>
                                        @if ($kibc->DOWNLOAD)
                                            <a href="{{ route('files.show-upb', ['KODE_UPB' => $kibc->KODE_UPB, 'filename' => basename($kibc->DOWNLOAD)]) }}"
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
                        <a href="{{ route('edit-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id]) }}"
                            class="btn">Edit</a>
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
                            <form method="post"
                                action="{{ route('delete-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
