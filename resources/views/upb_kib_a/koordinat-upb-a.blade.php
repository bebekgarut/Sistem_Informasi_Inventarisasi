<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <title>Rekap Koordinat KIB A</title>
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
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-upbsidebar></x-upbsidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="fa fa-map mr-3"></i></i>&nbsp;Rekap Titik
                            Koordinat KIB A</h3>
                    </div>
                    <hr>
                </div>
                <div id="googleMap" style="width:100%;height:500px;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- hapus yang ini klau sudah ada key --}}
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    {{-- nyalain yang ini kalau sudah ada key --}}
    {{-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key={{ $googleMapsApiKey }}&callback=initMap">
</script> --}}
    <script>
        function initialize() {
            var mapProp = {
                center: new google.maps.LatLng(-2.9910717811369305, 104.75675720669518),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

            var kibas = @json($kibas);


            kibas.forEach(function(kiba) {
                if (kiba.KOORDINAT) {
                    var koordinat = kiba.KOORDINAT.split(',');
                    var latitude = parseFloat(koordinat[0]);
                    var longitude = parseFloat(koordinat[1]);

                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude),
                        map: map,
                        title: kiba.nama_barang
                    });

                    var contentString = `
                            <h5 class="fw-bold mt-0">${kiba.NAMA_BARANG}</h5>
                                <p>${kiba.KODE_BARANG}</p>
                            <p>${kiba.NOMOR_REGISTER}</p>
                            <p>${kiba.PENGGUNAAN}</p>
                            <a href="https://www.google.com/maps?q=${latitude},${longitude}" target="_blank" style="color:blue">Open in Google Maps</a>
                        `;

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 300
                    });
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });

                }
            });
        }


        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</body>

</html>
