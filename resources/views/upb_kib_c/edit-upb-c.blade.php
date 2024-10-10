<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Edit Data KIB C</title>
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
                        <form action="{{ route('update-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="NAMA_BARANG" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control"
                                    placeholder="Masukan Nama Barang atau Jenis Barang" id="NAMA_BARANG"
                                    value="{{ $kibc->NAMA_BARANG }}" name="NAMA_BARANG" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="KODE_BARANG" class="add-form-label">Kode Barang</label>
                                <input type="text" class="add-form-control form-control-md"
                                    placeholder="Masukan Kode Barang" id="KODE_BARANG" value="{{ $kibc->KODE_BARANG }}"
                                    name="KODE_BARANG" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_REGISTER" class="add-form-label">Nomor Register</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Register"
                                    id="NOMOR_REGISTER" value="{{ $kibc->NOMOR_REGISTER }}" name="NOMOR_REGISTER"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="KONDISI_BANGUNAN" class="add-form-label">Kondisi Bangunan</label>
                                <input type="text" class="add-form-control"
                                    placeholder="Baik/Kurang Baik/Rusak Berat" id="KONDISI_BANGUNAN"
                                    value="{{ $kibc->KONDISI_BANGUNAN }}" name="KONDISI_BANGUNAN" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BANGUNAN_BERTINGKAT" class="add-form-label">Bertingkat/Tidak</label>
                                <input type="text" class="add-form-control" placeholder="Bertingkat atau Tidak"
                                    id="BANGUNAN_BERTINGKAT" value="{{ $kibc->BANGUNAN_BERTINGKAT }}"
                                    name="BANGUNAN_BERTINGKAT" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BANGUNAN_BETON" class="add-form-label">Beton/Tidak</label>
                                <input type="text" class="add-form-control" placeholder="Beton atau Tidak"
                                    id="BANGUNAN_BETON" value="{{ $kibc->BANGUNAN_BETON }}" name="BANGUNAN_BETON"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LUAS_LANTAI" class="add-form-label">Luas Lantai (M2)</label>
                                <input type="number" step="any" class="add-form-control"
                                    placeholder="Masukan Luas Lantai" id="LUAS_LANTAI"
                                    value="{{ $kibc->LUAS_LANTAI }}" name="LUAS_LANTAI" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LETAL_ALAMAT" class="add-form-label">Letak/Alamat</label>
                                <input type="text" class="add-form-control"
                                    placeholder="Masukan Letak atau Alamat" id="LETAK_ALAMAT"
                                    value="{{ $kibc->LETAK_ALAMAT }}" name="LETAK_ALAMAT" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="TANGGAL_DOKUMEN" class="add-form-label">Tanggal Dokumen</label>
                                <input type="date" class="add-form-control" placeholder="Masukan Tanggal Dokumen"
                                    id="TANGGAL_DOKUMEN" value="{{ $kibc->TANGGAL_DOKUMEN }}"
                                    name="TANGGAL_DOKUMEN">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_DOKUMEN" class="add-form-label">Nomor Dokumen</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Dokumen"
                                    id="NOMOR_DOKUMEN" value="{{ $kibc->NOMOR_DOKUMEN }}" name="NOMOR_DOKUMEN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="LUAS" class="add-form-label">Luas (M2)</label>
                                <input type="number" step="any" class="add-form-control"
                                    placeholder="Masukan Luas" id="LUAS" value="{{ $kibc->LUAS }}"
                                    name="LUAS" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="STATUS_TANAH" class="add-form-label">Status Tanah</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Status Tanah"
                                    id="STATUS_TANAH" value="{{ $kibc->STATUS_TANAH }}" name="STATUS_TANAH"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_KODE_TANAH" class="add-form-label">Nomor Kode Tanah</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Kode Tanah"
                                    id="NOMOR_KODE_TANAH" value="{{ $kibc->NOMOR_KODE_TANAH }}"
                                    name="NOMOR_KODE_TANAH" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="ASAL_USUL" class="add-form-label">Asal Usul</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Asal Usul"
                                    value="{{ $kibc->ASAL_USUL }}" id="ASAL_USUL" name="ASAL_USUL"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="HARGA" class="add-form-label">Harga (ribuan Rp)</label>
                                <input type="number" step="any" class="add-form-control"
                                    placeholder="Masukan Harga" id="HARGA" value="{{ $kibc->HARGA }}"
                                    name="HARGA" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KETERANGAN" class="add-form-label">Keterangan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Keterangan"
                                    id="KETERANGAN" value="{{ $kibc->KETERANGAN }}" name="KETERANGAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">FILE Sertifikat <i>(max 4 mb)</i></label>
                                @if ($kibc->DOWNLOAD)
                                    <a href="{{ route('files.show-upb', ['KODE_UPB' => $kibc->KODE_UPB, 'filename' => basename($kibc->DOWNLOAD)]) }}"
                                        target="_blank">
                                        <p style="color: blue;height:10px">File Saat Ini</p>
                                    </a>
                                @endif
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file" style="border-color: #2C3B42; border-width:2px; border-radius:5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                @if ($kibc->FOTO)
                                    <label for="FOTO" class="form-label">Foto <i>(saat ini)</i></label>
                                    <img src="{{ route('photos.show', ['filename' => basename($kibc->FOTO)]) }}"
                                        class="gambar">
                                @endif
                                <label for="FOTO" class="form-label">Foto <i>(max 3 mb)</i></label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .jpeg, .png">
                                <span id="fotoError" style="color:red;"></span>
                                <hr>
                                <a href="{{ route('detail-upb-c', ['KODE_UPB' => $kibc->KODE_UPB, 'id' => $kibc->id]) }}"
                                    class="btn">Kembali</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>
