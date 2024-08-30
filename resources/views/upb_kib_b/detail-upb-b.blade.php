<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data KIB B</title>
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
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
                        @if ($kibb->FOTO)
                            <img src="{{ route('photos.show', ['filename' => basename($kibb->FOTO)]) }}" width="50%"
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
                                    <td>{{ $kibb->NAMA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barang</th>
                                    <td>{{ $kibb->KODE_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Register</th>
                                    <td>{{ $kibb->NOMOR_REGISTER }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Merek/Type</th>
                                    <td>{{ $kibb->MERK_TYPE }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ukuran/CC</th>
                                    <td>{{ $kibb->UKURAN_CC }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Bahan</th>
                                    <td>{{ $kibb->BAHAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Pembelian</th>
                                    <td>{{ $kibb->TAHUN_PEMBELIAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Pabrik</th>
                                    <td>{{ $kibb->NOMOR_PABRIK }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Rangka</th>
                                    <td>{{ $kibb->NOMOR_RANGKA }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Mesin</th>
                                    <td>{{ $kibb->NOMOR_MESIN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Polisi</th>
                                    <td>{{ $kibb->NOMOR_POLISI }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor BPKB</th>
                                    <td>{{ $kibb->NOMOR_BPKB }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Asal Usul</th>
                                    <td>{{ $kibb->ASAL_USUL }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga (ribuan Rp)</th>
                                    <td class="format-number">{{ $kibb->HARGA }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td>{{ $kibb->KETERANGAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengguna Barang</th>
                                    <td>{{ $kibb->PENGGUNA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unduh BPKB</th>
                                    <td>
                                        @if ($kibb->DOWNLOAD)
                                            <a href="{{ route('files.show-upb', ['KODE_UPB' => $kibb->KODE_UPB, 'filename' => basename($kibb->DOWNLOAD)]) }}"
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
                        <a href="{{ route('edit-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id]) }}"
                            class="btn"><i class="bi bi-pencil"></i>
                            Edit</a>

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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <form method="post"
                                action="{{ route('delete-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id]) }}">
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
        <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
