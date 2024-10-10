<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Tambah Data KIB A</title>
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
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-plus-circle-fill"></i>&nbsp;Tambah Data
                        </h3>
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
                        <form action="{{ route('store-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control" id="NAMA_BARANG"
                                    placeholder="Masukkan Jenis atau Nama Barang" name="NAMA_BARANG"
                                    value="{{ old('NAMA_BARANG') }}" autocomplete="off" required>
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
                                    placeholder="Masukkan Nomor Register" name="NOMOR_REGISTER"
                                    value="{{ old('NOMOR_REGISTER') }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="luas" class="add-form-label">Luas</label>
                                <input type="number" step="any" class="add-form-control" id="LUAS"
                                    placeholder="Masukkan Luas" name="LUAS" value="{{ old('LUAS') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="pengadaan" class="add-form-label">Tahun Pengadaan</label>
                                <input type="text" class="add-form-control" id="TAHUN_PENGADAAN"
                                    placeholder="Masukkan Tahun Pengadaan" name="TAHUN_PENGADAAN"
                                    value="{{ old('TAHUN_PENGADAAN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="add-form-label">Letak/Alamat</label>
                                <input type="text" class="add-form-control" id="LETAK_ALAMAT" name="LETAK_ALAMAT"
                                    placeholder="Masukkan Alamat" value="{{ old('LETAK_ALAMAT') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="hak" class="add-form-label">Hak</label>
                                <input type="text" class="add-form-control" id="HAK"
                                    placeholder="Masukkan Hak" name="HAK" value="{{ old('HAK') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="tgl" class="add-form-label">Tanggal Sertifikat</label>
                                <input type="date" class="add-form-control" id="TANGGAL_SERTIFIKAT"
                                    name="TANGGAL_SERTIFIKAT" value="{{ old('TANGGAL_SERTIFIKAT') }}">
                            </div>
                            <div class="mb-3">
                                <label for="noSertif" class="add-form-label">Nomor Sertifikat</label>
                                <input type="text" class="add-form-control" id="NO_SERTIFIKAT"
                                    placeholder="Masukkan Nomor Sertifikat" name="NO_SERTIFIKAT"
                                    value="{{ old('NO_SERTIFIKAT') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="PENGGUNAAN" class="add-form-label">Penggunaan</label>
                                <input type="text" class="add-form-control" id="PENGGUNAAN"
                                    placeholder="Masukkan Penggunaan" name="PENGGUNAAN"
                                    value="{{ old('PENGGUNAAN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="ASAL_USUL" class="add-form-label">Asal Usul</label>
                                <input type="text" class="add-form-control" id="ASAL_USUL"
                                    placeholder="Masukkan Keterangan Asal Usul" name="ASAL_USUL"
                                    value="{{ old('ASAL_USUL') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="HARGA" class="add-form-label">Harga (ribuan Rp)</label>
                                <input type="number" step="any" class="add-form-control" id="HARGA"
                                    placeholder="Masukkan Harga" name="HARGA" value="{{ old('HARGA') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KETERANGAN" class="add-form-label">Keterangan</label>
                                <input type="text" class="add-form-control" id="KETERANGAN"
                                    placeholder="Masukkan Keterangan" name="KETERANGAN"
                                    value="{{ old('KETERANGAN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KOORDINAT" class="add-form-label">Titik Koordinat</label>
                                <input type="text" class="add-form-control" id="KOORDINAT"
                                    placeholder="Contoh: -2.991507467425419, 104.76344602654568" name="KOORDINAT"
                                    value="{{ old('KOORDINAT') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">Unggah File Sertifikat(PDF)(max 4 mb)</label>
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="FOTO" class="form-label">Foto (max 3 mb)</label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .png, .jpeg ">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <hr>
                            <a href="{{ route('data-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                                class="btn">Kembali</a>
                            <button type="submit" class="btn">Simpan</button>
                            </hr>
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

</body>

</html>
