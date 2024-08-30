<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Tambah Data Arsip</title>
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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
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
                        <form action="{{ route('arsipStore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_subjek" class="add-form-label">Nama Subjek</label>
                                <input type="text" class="add-form-control" id="nama_subjek"
                                    placeholder="Masukkan Nama Subjek" name="nama_subjek"
                                    value="{{ $arsip->nama_subjek }}" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="add-form-label">Alamat</label>
                                <input type="text" class="add-form-control form-control-md" id="alamat"
                                    placeholder="Masukkan alamat" name="alamat" value="{{ $arsip->alamat }}"
                                    autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="files[]" class="form-label">Unggah File</label>
                                <input class="form-control form-control-sm input-file" id="files" name="files[]"
                                    type="file" style="border-color: #2C3B42; border-width:2px; border-radius: 5px;"
                                    accept=".pdf" multiple>
                                <span id="fileError" style="color:red;"></span>

                                {{-- <a href="{{ route('filesArsip', ['filename' => basename($file->file_path)]) }}"
                                    style="color: blue">{{ basename($file->file_path) }}</a><br> --}}

                                {{ $file->file_path }}

                                <ul id="fileList"></ul>
                            </div>
                            <hr>
                            <a href="{{ route('arsip') }}" class="btn">Kembali</a>
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
        <script>
            const fileInput = document.getElementById('files');
            const fileList = document.getElementById('fileList');
            let filesArray = [];

            fileInput.addEventListener('change', function() {
                const selectedFiles = Array.from(this.files);
                selectedFiles.forEach(file => {
                    filesArray.push(file);

                    const listItem = document.createElement('li');
                    listItem.textContent = file.name;

                    // Tambahkan tombol hapus untuk setiap file
                    const removeButton = document.createElement('button');
                    removeButton.textContent = 'Hapus';
                    removeButton.style.marginLeft = '10px';
                    removeButton.type = 'button'; // Tambahkan type="button" agar tidak submit form
                    removeButton.addEventListener('click', function() {
                        // Hapus file dari filesArray
                        filesArray = filesArray.filter(f => f.name !== file.name);

                        // Perbarui DataTransfer dan file input
                        const dataTransfer = new DataTransfer();
                        filesArray.forEach(f => dataTransfer.items.add(f));
                        fileInput.files = dataTransfer.files;

                        // Hapus elemen list dari DOM
                        fileList.removeChild(listItem);
                    });

                    listItem.appendChild(removeButton);
                    fileList.appendChild(listItem);
                });

                // Buat DataTransfer baru untuk mengupdate input file
                const dataTransfer = new DataTransfer();
                filesArray.forEach(file => {
                    dataTransfer.items.add(file);
                });

                // Set file input dengan file-file dari DataTransfer
                fileInput.files = dataTransfer.files;
            });
        </script>

        <script src="js/jquery.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    </div>

</body>

</html>
