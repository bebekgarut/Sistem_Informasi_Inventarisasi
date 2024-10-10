<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Edit Data KIB A</title>
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
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Edit Data</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mt-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <form id="" method="post"
                            action="{{ route('update-upb-a', ['KODE_UPB' => $kiba->KODE_UPB, 'id' => $kiba->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="NAMA_BARANG" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nama Barang"
                                    id="NAMA_BARANG" value="{{ $kiba->NAMA_BARANG }}" name="NAMA_BARANG"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="KODE_BARANG" class="add-form-label">Kode Barang</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Kode Barang"
                                    id="KODE_BARANG" value="{{ $kiba->KODE_BARANG }}" name="KODE_BARANG"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_REGISTER" class="add-form-label">Nomor Register</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Register"
                                    id="NOMOR_REGISTER" value="{{ $kiba->NOMOR_REGISTER }}" name="NOMOR_REGISTER"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="LUAS" class="add-form-label">Luas</label>
                                <input type="number" step="any" class="add-form-control" placeholder="Masukan Luas"
                                    id="LUAS" value="{{ $kiba->LUAS }}" name="LUAS" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="TAHUN_PENGADAAN" class="add-form-label">Tahun Pengadaan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Tahun Pengadaan"
                                    id="TAHUN_PENGADAAN" value="{{ $kiba->TAHUN_PENGADAAN }}" name="TAHUN_PENGADAAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LETAK_ALAMAT" class="add-form-label">Letak/Alamat</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Letak/Alamat"
                                    id="LETAK_ALAMAT" name="LETAK_ALAMAT" value="{{ $kiba->LETAK_ALAMAT }}">
                            </div>
                            <div class="mb-3">
                                <label for="HAK" class="add-form-label">Hak</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Hak"
                                    id="HAK" value="{{ $kiba->HAK }}" name="HAK" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="TANGGAL_SERTIFIKAT" class="add-form-label">Tanggal Sertifikat</label>
                                <input type="date" class="add-form-control" id="TANGGAL_SERTIFIKAT"
                                    value="{{ $kiba->TANGGAL_SERTIFIKAT }}" name="TANGGAL_SERTIFIKAT">
                            </div>
                            <div class="mb-3">
                                <label for="NO_SERTIFIKAT" class="add-form-label">Nomor Sertifikat</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Sertifikat"
                                    id="NO_SERTIFIKAT" value="{{ $kiba->NO_SERTIFIKAT }}" name="NO_SERTIFIKAT"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="PENGGUNAAN" class="add-form-label">Penggunaan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Penggunaan"
                                    id="PENGGUNAAN" value="{{ $kiba->PENGGUNAAN }}" name="PENGGUNAAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="ASAL_USUL" class="add-form-label">Asal Usul</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Asal Usul"
                                    id="ASAL_USUL" value="{{ $kiba->ASAL_USUL }}" name="ASAL_USUL"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="HARGA" class="add-form-label">Harga (ribuan Rp)</label>
                                <input type="number" step="any" class="add-form-control"
                                    placeholder="Masukan Harga" id="HARGA" value="{{ $kiba->HARGA }}"
                                    name="HARGA" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KETERANGAN" class="add-form-label">Keterangan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Keterangan"
                                    id="KETERANGAN" value="{{ $kiba->KETERANGAN }}" name="KETERANGAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KOORDINAT" class="add-form-label">Koordinat</label>
                                <input type="text" class="add-form-control"
                                    placeholder="Contoh: -2.991507467425419, 104.76344602654568" id="KOORDINAT"
                                    value="{{ $kiba->KOORDINAT }}" name="KOORDINAT" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">File Sertifikat(max 4 MB)</label>
                                @if ($kiba->DOWNLOAD)
                                    <a href="{{ route('files.show-upb', ['KODE_UPB' => $kiba->KODE_UPB, 'filename' => basename($kiba->DOWNLOAD)]) }}"
                                        class="no-hover-link" id="DOWNLOAD" style="color: #2C3B42">Lihat file
                                        saat ini</a>
                                @endif
                                <input class="form-control form-control-sm input-gambar" id="DOWNLOAD"
                                    name="DOWNLOAD" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                @if ($kiba->FOTO)
                                    <label for="FOTO" class="form-label">Foto Saat Ini</label>
                                    <img src="{{ route('photos.show', ['filename' => basename($kiba->FOTO)]) }}"
                                        class="gambar">
                                @endif
                                <label for="FOTO" class="form-label">Foto(Max 3 MB)</label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpeg, .jpg, .png">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <hr>
                            <a href="{{ route('detail-upb-a', ['KODE_UPB' => $kiba->KODE_UPB, 'id' => $kiba->id]) }}"
                                class="btn">Kembali</a>
                            <button type="submit" class="btn">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

</body>

</html>
