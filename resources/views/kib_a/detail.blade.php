<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Detail Data KIB A</title>
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
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-info-circle"></i></i>&nbsp;Detail Data</h3>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md text-center">
                        @if ($kiba->FOTO)
                            <img src="{{ route('photos.show', ['filename' => basename($kiba->FOTO)]) }}" width="50%"
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
                                    <td>{{ $kiba->NAMA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kode Barang</th>
                                    <td>{{ $kiba->KODE_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Register</th>
                                    <td>{{ $kiba->NOMOR_REGISTER }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Luas (M2)</th>
                                    <td class="format-number">{{ $kiba->LUAS }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tahun Pengadaan</th>
                                    <td>{{ $kiba->TAHUN_PENGADAAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>{{ $kiba->LETAK_ALAMAT }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Hak</th>
                                    <td>{{ $kiba->HAK }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Sertifikat</th>
                                    <td>{{ $kiba->TANGGAL_SERTIFIKAT }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Nomor Sertifikat</th>
                                    <td>{{ $kiba->NO_SERTIFIKAT }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Pengguna Barang</th>
                                    <td>{{ $kiba->PENGGUNA_BARANG }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Penggunaan</th>
                                    <td>{{ $kiba->PENGGUNAAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Asal Usul</th>
                                    <td>{{ $kiba->ASAL_USUL }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Harga (ribuan Rp)</th>
                                    <td class="format-number">{{ $kiba->HARGA }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td>{{ $kiba->KETERANGAN }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Unduh Sertifikat</th>
                                    <td>
                                        @if ($kiba->DOWNLOAD)
                                            <a href="{{ route('files.download', ['filename' => basename($kiba->DOWNLOAD)]) }}"
                                                target="_blank">
                                                <p style="color: blue;height:10px">Unduh PDF</p>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Titik Koordinat</th>
                                    <td>{{ $kiba->KOORDINAT }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="googleMap" style="width:100%;height:380px;"></div>
                <div class="row my-2">
                    <div class="col-md text-center">
                        <a href="{{ route('editDataKiba', $kiba->id) }}" class="btn"><i class="bi bi-pencil"></i>
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
                            <form id="formHapus" method="post" action="{{ route('hapusDataKiba', $kiba->id) }}">
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

        {{-- hapus yang ini klau sudah ada key --}}
        <script src="http://maps.googleapis.com/maps/api/js"></script>
        {{-- nyalain yang ini kalau sudah ada key --}}
        {{-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsApiKey }}&callback=initMap">
  </script> --}}
        <script src="{{ asset('js/maps.js') }}"></script>
        <script>
            function initialize() {
                var koordinat = " {{ $kiba->KOORDINAT }}".split(',');
                var latitude = parseFloat(koordinat[0]);
                var longitude = parseFloat(koordinat[1]);

                var propertiPeta = {
                    center: new google.maps.LatLng(latitude, longitude),
                    zoom: 20,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude),
                    map: peta,
                    title: 'Lokasi'
                });

                var contentString = `
                   <a href="https://www.google.com/maps?q=${latitude},${longitude}" target="_blank" style="color:blue">Open in Google Maps</a>
                `;

                var infowindow = new google.maps.InfoWindow({
                    content: contentString,
                    maxWidth: 300
                });

                marker.addListener('click', function() {
                    infowindow.open(peta, marker);
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

</body>

</html>
