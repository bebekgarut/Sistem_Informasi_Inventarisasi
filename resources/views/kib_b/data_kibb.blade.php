<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Data KIB B</title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Select-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link
        rel="stylesheet"href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!--icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!--CSS-->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="wrapper">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <a href="/export-allb" class="download-button">
                    <i class="bi bi-download"></i> Download KIB B</a>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('add'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        {{ session('add') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form id="filterFormb">
                    <div class="mb-3">
                        <label for="bidang" class="form-label">Pilih Bidang</label>
                        <select class="form-select" id="bidang" name="bidang" data-placeholder="Choose one option">
                            <option selected>Choose one option</option>
                            @foreach ($bidangs as $bidang)
                                <option value="{{ $bidang->KODE_BIDANG }}">{{ $bidang->NAMA_BIDANG }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Pilih Unit</label>
                        <select class="form-select" id="unit" name="unit" data-placeholder="Choose one option">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="subunit" class="form-label">Pilih Subunit</label>
                        <select class="form-select" id="subunit" name="subunit" data-placeholder="Choose one option">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="upb" class="form-label">Pilih UPB</label>
                        <select class="form-select" id="upb" name="upb" data-placeholder="Choose one option">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="container" id="kibbData" style="display: none">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Data KIB B</h3>
                        <hr>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <a href="/add-b" class="btn"><i class="bi bi-person-plus-fill"></i>&nbsp;Tambah
                            Data</a>
                        <a href="/exportb" id="exportBtnb" target="_blank" class="btn"><i
                                class="bi bi-file-earmark-spreadsheet-fill"></i>&nbsp;Ekspor ke Excel</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md">
                        <table class="table table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="fixed-width-column">Nama Barang</th>
                                    <th class="fixed-width-column">Merk_Type</th>
                                    <th class="fixed-width-column">Nomor Polisi</th>
                                    <th class="action-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center" id="paginationb">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>


</body>

</html>
