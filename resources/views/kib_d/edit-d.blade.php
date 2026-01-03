<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Edit Data KIB D</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Edit Data</h3>
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
                        <form action="{{ route('updateDataKibd', $kibd->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="Gambar_Lama" value="sample.jpg">
                            <div class="mb-3">
                                <label for="jenis" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control" id="nama_barang"
                                    placeholder="Masukkan Jenis atau Nama Barang" value="{{ $kibd->nama_barang }}"
                                    name="nama_barang" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="add-form-label">Kode Barang</label>
                                <input type="text" class="add-form-control form-control-md" id="kode_barang"
                                    placeholder="Masukkan Kode Barang" name="kode_barang"
                                    value="{{ $kibd->kode_barang }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="add-form-label">Nibar</label>
                                <input type="text" class="add-form-control form-control-md" id="nibar"
                                    placeholder="Masukkan Nibar" name="nibar" value="{{ $kibd->nibar }}"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="register" class="add-form-label">Nomor Register</label>
                                <input type="text" class="add-form-control" id="nomor_register"
                                    placeholder="Masukkan Kode Register" name="nomor_register"
                                    value="{{ $kibd->nomor_register }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="spesifikasi_nama_barang" class="add-form-label">Spesifikasi Nama
                                    Barang</label>
                                <input type="text" class="add-form-control" id="spesifikasi_nama_barang"
                                    placeholder="Masukan Spesifikasi Nama Barang" name="spesifikasi_nama_barang"
                                    value="{{ $kibd->spesifikasi_nama_barang }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="spesifikasi_lainnya" class="add-form-label">Spesifikasi lainnya</label>
                                <input type="text" class="add-form-control" id="spesifikasi_lainnya"
                                    placeholder="Masukan Spesifikasi lainnya" name="spesifikasi_lainnya"
                                    value="{{ $kibd->spesifikasi_lainnya }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nomor_ruas_jalan" class="add-form-label">Nomor Ruas Jalan</label>
                                <input type="text" class="add-form-control" id="nomor_ruas_jalan"
                                    placeholder="Masukan Nomor Ruas Jalan" name="nomor_ruas_jalan"
                                    value="{{ $kibd->nomor_ruas_jalan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nomor_ruas_jembatan" class="add-form-label">Nomor Ruas Jembatan</label>
                                <input type="text" class="add-form-control" id="nomor_ruas_jembatan"
                                    placeholder="Masukkan Ruas Jembatan" name="nomor_ruas_jembatan"
                                    value="{{ $kibd->nomor_ruas_jembatan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nomor_ruas_jaringan_irigasi" class="add-form-label">Nomor Ruas Jaringan
                                    Irigasi</label>
                                <input type="text" class="add-form-control" id="nomor_ruas_jaringan_irigasi"
                                    name="nomor_ruas_jaringan_irigasi"
                                    value="{{ $kibd->nomor_ruas_jaringan_irigasi }}"
                                    placeholder="Masukkan Nomor Ruas Jaringan Irigasi">
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="add-form-label">Lokasi</label>
                                <input type="text" class="add-form-control" id="lokasi"
                                    placeholder="Masukkan Lokasi" name="lokasi" value="{{ $kibd->lokasi }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="titik_koordinat" class="add-form-label">Titik Koordinat</label>
                                <input type="text" class="add-form-control" id="titik_koordinat"
                                    placeholder="Masukkan Titik Koordinat" name="titik_koordinat"
                                    value="{{ $kibd->titik_koordinat }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="status_kepemilikan_tanah" class="add-form-label">Status Kepemilikan Tanah
                                </label>
                                <input type="text" class="add-form-control" id="status_kepemilikan_tanah"
                                    placeholder="Masukkan Status Kepemilikan Tanah" name="status_kepemilikan_tanah"
                                    value="{{ $kibd->status_kepemilikan_tanah }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="add-form-label">Jumlah</label>
                                <input type="number" step="any" class="add-form-control" id="jumlah"
                                    placeholder="Masukkan Jumlah" name="jumlah" value="{{ $kibd->jumlah }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="satuan" class="add-form-label">Satuan</label>
                                <input type="text" class="add-form-control" id="satuan"
                                    placeholder="Masukkan Satuan" name="satuan" value="{{ $kibd->satuan }}"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="harga_satuan_perolehan" class="add-form-label">Harga Satuan
                                    Perolehan</label>
                                <input type="number" class="add-form-control" id="harga_satuan_perolehan"
                                    placeholder="Masukkan Harga Satuan Perolehan" name="harga_satuan_perolehan"
                                    value="{{ $kibd->harga_satuan_perolehan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="cara_perolehan" class="add-form-label">Cara Perolehan</label>
                                <input type="text" class="add-form-control" id="cara_perolehan"
                                    placeholder="Masukkan Cara Perolehan" name="cara_perolehan"
                                    value="{{ $kibd->cara_perolehan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="nilai_perolehan" class="add-form-label">Nilai Perolehan</label>
                                <input type="number" class="add-form-control" id="nilai_perolehan"
                                    placeholder="Masukkan Nilai Perolehan" name="nilai_perolehan"
                                    value="{{ $kibd->nilai_perolehan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_perolehan" class="add-form-label">Tanggal Perolehan</label>
                                <input type="date" class="add-form-control" id="tanggal_perolehan"
                                    placeholder="Masukkan Tanggal Perolehan" name="tanggal_perolehan"
                                    value="{{ $kibd->tanggal_perolehan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="status_penggunaan" class="add-form-label">Status Penggunaan</label>
                                <input type="text" class="add-form-control" id="status_penggunaan"
                                    placeholder="Masukkan Status_" name="status_penggunaan"
                                    value="{{ $kibd->status_penggunaan }}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="add-form-label">Keterangan</label>
                                <textarea class="add-form-control" id="keterangan" rows="5" name="keterangan"
                                    placeholder="Masukkan Keterangan" autocomplete="off">{{ $kibd->keterangan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">File <i>(max 4 MB)</i></label>
                                @if ($kibd->DOWNLOAD)
                                    <a href="{{ route('files.download', ['filename' => basename($kibd->DOWNLOAD)]) }}"
                                        class="no-hover-link" target="_blank" id="DOWNLOAD"
                                        style="color: #2C3B42">Lihat file
                                        saat ini</a>
                                @endif
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file" style="border-color: #2C3B42; border-width:2px; border-radius:5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                @if ($kibd->FOTO)
                                    <label for="FOTO" class="form-label">Foto <i>(saat ini)</i></label>
                                    <img src="{{ route('photos.show', ['filename' => basename($kibd->FOTO)]) }}"
                                        class="gambar">
                                @endif
                                <label for="FOTO" class="form-label">Foto <i>(max 3 MB)</i></label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .jpeg, .png">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <hr>
                            <a href="{{ route('detailDataKibd', $kibd->id) }}" class="btn">Kembali</a>
                            <button type="submit" class="btn" name="ubah">Ubah</button>
                        </form>
                    </div>
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
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
