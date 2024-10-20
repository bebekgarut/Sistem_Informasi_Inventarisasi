<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Edit Data KIB B</title>
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
                            <button type="button" class="close" data-bs-dismiss="alert"
                                aria-label="Close"><span>&times;</span></button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <form method="post"
                            action="{{ route('update-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="NAMA_BARANG" class="add-form-label">Jenis Barang/Nama Barang</label>
                                <input type="text" class="add-form-control"
                                    placeholder="Masukan Jenis Barang / Nama Barang" id="NAMA_BARANG"
                                    value="{{ $kibb->NAMA_BARANG }}" name="NAMA_BARANG" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="KODE_BARANG" class="add-form-label">Kode Barang</label>
                                <input type="text" class="add-form-control form-control-md"
                                    placeholder="Masukan Kode Barang" id="KODE_BARANG" value="{{ $kibb->KODE_BARANG }}"
                                    name="KODE_BARANG" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="NOMER_REGISTER" class="add-form-label">Nomor Register</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Register"
                                    id="NOMER_REGISTER" value="{{ $kibb->NOMOR_REGISTER }}" name="NOMOR_REGISTER"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="MERK_TYPE" class="add-form-label">Merk/Type</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Merk/Type"
                                    id="MERK_TYPE" value="{{ $kibb->MERK_TYPE }}" name="MERK_TYPE" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="UKURAN_CC" class="add-form-label">Ukuran/CC</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Ukuran/CC"
                                    id="UKURAN/CC" value="{{ $kibb->UKURAN_CC }}" name="UKURAN_CC" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="BAHAN" class="add-form-label">Bahan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Bahan"
                                    id="BAHAN" value="{{ $kibb->BAHAN }}" name="BAHAN" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="TAHUN_PEMBELIAN" class="add-form-label">Tahun Pembelian</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Tahun Pembelian"
                                    id="TAHUN_PEMBELIAN" value="{{ $kibb->TAHUN_PEMBELIAN }}" name="TAHUN_PEMBELIAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_PABRIK" class="add-form-label">Nomor Pabrik</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Pabrik"
                                    id="NOMOR_PABRIK" value="{{ $kibb->NOMOR_PABRIK }}" name="NOMOR_PABRIK"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_RANGKA" class="add-form-label">Nomor Rangka</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Rangka"
                                    id="NOMOR_RANGKA" value="{{ $kibb->NOMOR_RANGKA }}" name="NOMOR_RANGKA"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_MESIN" class="add-form-label">Nomor Mesin</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Mesin"
                                    id="NOMOR_MESIN" value="{{ $kibb->NOMOR_MESIN }}" name="NOMOR_MESIN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_POLISI" class="add-form-label">Nomor Polisi</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor Polisi"
                                    id="NOMOR_POLISI" value="{{ $kibb->NOMOR_POLISI }}" name="NOMOR_POLISI"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="NOMOR_BPKB" class="add-form-label">Nomor BPKB</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Nomor BPKB"
                                    id="NOMOR_BPKB" value="{{ $kibb->NOMOR_BPKB }}" name="NOMOR_BPKB"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="ASAL_USUL" class="add-form-label">Asal Usul</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Asal Usul"
                                    id="ASAL_USUL" value="{{ $kibb->ASAL_USUL }}" name="ASAL_USUL"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="HARGA" class="add-form-label">Harga (ribuan Rp)</label>
                                <input type="number" step="any" class="add-form-control"
                                    placeholder="Masukan Harga" id="HARGA" value="{{ $kibb->HARGA }}"
                                    name="HARGA" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="KETERANGAN" class="add-form-label">Keterangan</label>
                                <input type="text" class="add-form-control" placeholder="Masukan Keterangan"
                                    id="KETERANGAN" value="{{ $kibb->KETERANGAN }}" name="KETERANGAN"
                                    autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD" class="form-label">FILE STNK <i>(max 4 mb)</i></label>
                                @if ($kibb->DOWNLOAD)
                                    <a href="{{ route('files.show-upb', ['KODE_UPB' => $kibb->KODE_UPB, 'filename' => basename($kibb->DOWNLOAD)]) }}"
                                        target="_blank">
                                        <p style="color: blue;height:10px">File STNK Saat Ini</p>
                                    </a>
                                @endif
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD" name="DOWNLOAD"
                                    type="file" style="border-color: #2C3B42; border-width:2px; border-radius:5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="DOWNLOAD_2" class="form-label">FILE BPKB <i>(max 4 mb)</i></label>
                                @if ($kibb->DOWNLOAD_2)
                                    <a href="{{ route('files.show-upb', ['KODE_UPB' => $kibb->KODE_UPB, 'filename' => basename($kibb->DOWNLOAD_2)]) }}"
                                        target="_blank">
                                        <p style="color: blue;height:10px">File BPKB Saat Ini</p>
                                    </a>
                                @endif
                                <input class="form-control form-control-sm input-file" id="DOWNLOAD_2"
                                    name="DOWNLOAD_2" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius:5px;"
                                    accept=".pdf">
                                <span id="fileError" style="color:red;"></span>
                            </div>
                            <div class="mb-3">
                                @if ($kibb->FOTO)
                                    <label for="FOTO" class="form-label">FOTO <i>Saat Ini</i></label>
                                    <img src="{{ route('photos.show', ['filename' => basename($kibb->FOTO)]) }}"
                                        class="gambar">
                                @endif
                                <label for="FOTO" class="form-label">FOTO <i>(max 3 mb)</i></label>
                                <input class="form-control form-control-sm input-gambar" id="FOTO"
                                    name="FOTO" type="file"
                                    style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".jpg, .jpeg, .png">
                                <span id="fotoError" style="color:red;"></span>
                            </div>
                            <hr>
                            <a href="{{ route('detail-upb-b', ['KODE_UPB' => $kibb->KODE_UPB, 'id' => $kibb->id]) }}"
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
