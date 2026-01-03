<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Tambah Data</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-plus-circle-fill"></i>&nbsp;Tambah Data
                        </h3>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-4">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <form action="{{ route('storeDataKibc') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control" id="NAMA_BARANG"
                                    placeholder="Masukkan Jenis atau Nama Barang" value="{{ old('NAMA_BARANG') }}"
                                    name="NAMA_BARANG" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="add-form-label">Kode Barang</label>
                                <input type="text" class="add-form-control form-control-md" id="KODE_BARANG"
                                    placeholder="Masukkan Kode Barang" name="KODE_BARANG"
                                    value="{{ old('KODE_BARANG') }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="register" class="add-form-label">Nomor Register</label>
                                <input type="text" class="add-form-control" id="NOMOR_REGISTER"
                                    placeholder="Masukkan Kode Register" name="NOMOR_REGISTER"
                                    value="{{ old('NOMOR_REGISTER') }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="KONDISI_BANGUNAN" class="add-form-label">Kondisi Bangunan</label>
                                <input type="text" class="add-form-control" id="KONDISI_BANGUNAN"
                                    placeholder="Baik/Kurang Baik/Rusak Berat" name="KONDISI_BANGUNAN"
                                    value="{{ old('KONDISI_BANGUNAN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BANGUNAN_BERTINGKAT" class="add-form-label">Bangunan Bertingkat atau
                                    Tidak</label>
                                <input type="text" class="add-form-control" id="BANGUNAN_BERTINGKAT"
                                    placeholder="Bangunan Bertingkat atau Tidak" name="BANGUNAN_BERTINGKAT"
                                    value="{{ old('BANGUNAN_BERTINGKAT') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BANGUNAN_BETON" class="add-form-label">Bangunan Beton atau tidak</label>
                                <input type="text" class="add-form-control" id="BANGUNAN_BETON"
                                    placeholder="Bangunan Beton atau Tidak" name="BANGUNAN_BETON"
                                    value="{{ old('BANGUNAN_BETON') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LUAS_LANTAI" class="add-form-label">Luas Lantai</label>
                                <input type="number" step="any" class="add-form-control" id="LUAS_LANTAI"
                                    placeholder="Masukkan Luas Lantai" name="LUAS_LANTAI"
                                    value="{{ old('LUAS_LANTAI') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LETAK_ALAMAT" class="add-form-label">Alamat</label>
                                <input type="text" class="add-form-control" id="LETAK_ALAMAT" name="LETAK_ALAMAT"
                                    value="{{ old('LETAK_ALAMAT') }}" placeholder="Masukkan Alamat">
                            </div>
                            <div class="mb-3">
                                <label for="TANGGAL_DOKUMEN" class="add-form-label">Tanggal Dokumen</label>
                                <input type="date" class="add-form-control" id="TANGGAL_DOKUMEN"
                                    placeholder="Masukkan Tanggal Dokumen" name="TANGGAL_DOKUMEN"
                                    value="{{ old('TANGGAL_DOKUMEN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_DOKUMEN" class="add-form-label">Nomor Dokumen</label>
                                <input type="text" class="add-form-control" id="NOMOR_DOKUMEN"
                                    placeholder="Masukkan Nomor Dokumen" name="NOMOR_DOKUMEN"
                                    value="{{ old('NOMOR_DOKUMEN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LUAS" class="add-form-label">Luas</label>
                                <input type="number" step="any" class="add-form-control" id="LUAS"
                                    placeholder="Masukkan Luas" name="LUAS" value="{{ old('LUAS') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="STATUS_TANAH" class="add-form-label">Status Tanah</label>
                                <input type="text" class="add-form-control" id="STATUS_TANAH"
                                    placeholder="Masukkan Status Tanah" name="STATUS_TANAH"
                                    value="{{ old('STATUS_TANAH') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_KODE_TANAH" class="add-form-label">Nomor Kode Tanah</label>
                                <input type="text" class="add-form-control" id="KODE_TANAH"
                                    placeholder="Masukkan Kode Tanah" name="NOMOR_KODE_TANAH"
                                    value="{{ old('NOMOR_KODE_TANAH') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="ASAL_USUL" class="add-form-label">Asal Usul</label>
                                <input type="text" class="add-form-control" id="ASAL_USUL"
                                    placeholder="Masukkan Asal Usul" name="ASAL_USUL" value="{{ old('ASAL_USUL') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="HARGA" class="add-form-label">Harga (ribuan Rp)</label>
                                <input type="number" step="any" class="add-form-control" id="HARGA"
                                    placeholder="Masukkan Harga" name="HARGA" value="{{ old('HARGA') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KETERANGAN" class="add-form-label">Keterangan</label>
                                <textarea class="add-form-control" id="KETERANGAN" rows="5" name="KETERANGAN"
                                    placeholder="Masukkan Keterangan" autocomplete="off">{{ old('KETERANGAN') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">File Sertifikat(max 4 MB)</label>
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="FOTO" class="form-label">Foto(max 3 MB)</label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .jpeg, .png">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <input type="hidden" id="KODE_BIDANG" name="KODE_BIDANG">
                            <input type="hidden" id="KODE_UNITS" name="KODE_UNITS">
                            <input type="hidden" id="KODE_SUB_UNITS" name="KODE_SUB_UNITS">
                            <input type="hidden" id="KODE_UPB" name="KODE_UPB">
                            <input type="hidden" id="NAMA_SUB_UNITS" name="PENGGUNA_BARANG">
                            <hr>
                            <a href="/data_kibc" class="btn">Kembali</a>
                            <button type="submit" class="btn" name="simpan">Simpan</button>
                            </hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    </div>

</body>

</html>
