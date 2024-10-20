<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data KIB B</title>
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!--Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close"><span>&times;</span></button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <form action="{{ route('store-upb-b', ['KODE_UPB' => $KODE_UPB]) }}" method="post"
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
                                <label for="MERK_TYPE" class="add-form-label">Merk/Type</label>
                                <input type="text" class="add-form-control" id="MERK_TYPE"
                                    placeholder="Masukkan Merk/Type" name="MERK_TYPE" value="{{ old('MERK_TYPE') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="UKURAN_CC" class="add-form-label">Ukuran/CC</label>
                                <input type="text" class="add-form-control" id="UKURAN_CC"
                                    placeholder="Masukkan Ukuran/CC" name="UKURAN_CC" value="{{ old('UKURAN_CC') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BAHAN" class="add-form-label">Bahan</label>
                                <input type="text" class="add-form-control" id="BAHAN"
                                    placeholder="Masukkan Keterangan" name="BAHAN" value="{{ old('BAHAN') }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="TAHUN_PEMBELIAN" class="add-form-label">Tahun Pembelian</label>
                                <input type="text" class="add-form-control" id="TAHUN_PEMBELIAN"
                                    placeholder="Masukkan Tahun Pembelian" name="TAHUN_PEMBELIAN"
                                    value="{{ old('TAHUN_PEMBELIAN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_PABRIK" class="add-form-label">Nomor Pabrik</label>
                                <input type="text" class="add-form-control" id="NOMOR_PABRIK" name="NOMOR_PABRIK"
                                    value="{{ old('NOMOR_PABRIK') }}" placeholder="Masukkan Nomor Pabrik">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_RANGKA" class="add-form-label">Nomor Rangka</label>
                                <input type="text" class="add-form-control" id="NOMOR_RANGKA"
                                    placeholder="Masukkan Nomor Rangka" name="NOMOR_RANGKA"
                                    value="{{ old('NOMOR_RANGKA') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_MESIN" class="add-form-label">Nomor Mesin</label>
                                <input type="text" class="add-form-control" id="NOMOR_MESIN"
                                    placeholder="Masukkan Nomor Mesin" name="NOMOR_MESIN"
                                    value="{{ old('NOMOR_MESIN') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_POLISI" class="add-form-label">Nomor Polisi</label>
                                <input type="text" class="add-form-control" id="NOMOR_POLISI"
                                    placeholder="Masukkan Nomor Polisi" name="NOMOR_POLISI"
                                    value="{{ old('NOMOR_POLISI') }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_BPKB" class="add-form-label">Nomor BPKB</label>
                                <input type="text" class="add-form-control" id="NOMOR_BPKB"
                                    placeholder="Masukkan Nomor BPKB" name="NOMOR_BPKB"
                                    value="{{ old('NOMOR_BPKB') }}" autocomplete="off">
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
                                <label for="DOWNLOAD" class="form-label">Unggah File STNK(PDF)(max 4 mb)</label>
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD_2" class="form-label">Unggah File BPKB(PDF)(max 4 mb)</label>
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD_2"
                                    name="DOWNLOAD_2" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="FOTO" class="form-label">Foto(max 3 mb)</label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .png, .jpeg ">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <hr>
                            <a href="{{ route('data-upb-b', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                                class="btn">Kembali</a>
                            <button type="submit" class="btn" name="simpan">Simpan</button>
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
