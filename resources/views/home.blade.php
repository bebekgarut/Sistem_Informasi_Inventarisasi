<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Home</title>
    <!--Bootrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <!--Icon-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!--CSS-->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css?v=<?php echo time(); ?>">
</head>
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        pointer-events: none;
        z-index: -1;
    }
</style>

<body>
    <div class="wrapper">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <h2><a class="welcome">Selamat Datang <span>Di Sistem Informasi Penatausahaan, Inventarisasi dan
                            Laporan Barang Milik Daerah</span></a></h2>
                <p class="deskripsi1">Sistem Informasi Penatausahaan, Inventarisasi dan Laporan Barang Milik Daerah Kota
                    Palembang
                    merupakan sebuah
                    platform yang dirancang
                    khusus untuk memfasilitasi bidang aset di kantor BPKAD Kota Palembang.
                    Selain menyediakan fungsi untuk mengumpulkan, mengelola, dan menganalisis data sensus yang relevan,
                    sistem ini juga dilengkapi dengan fitur-fitur yang ditujukan untuk mempermudah pengelolaan aset
                    daerah.
                </p>
                <p class="deskripsi1">Dengan integrasi fungsi-fungsi ini, kantor BPKAD dapat lebih efisien dalam
                    mengelola
                    aset-aset Kota
                    Palembang secara holistik. Sistem ini memungkinkan mereka untuk dengan cepat mengakses informasi
                    tentang aset yang dimiliki, mengidentifikasi kebutuhan perawatan atau pemeliharaan, serta melacak
                    perubahan-perubahan yang terjadi pada
                    aset tersebut dari waktu ke waktu. Sebagai hasilnya, pengelolaan aset daerah dapat dilakukan secara
                    lebih efektif dan transparan, yang pada gilirannya
                    akan mendukung perencanaan keuangan dan pembangunan yang lebih baik untuk Kota Palembang secara
                    keseluruhan.</p>
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

</body>

</html>
