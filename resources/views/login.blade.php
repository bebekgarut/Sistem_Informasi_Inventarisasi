<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="{{ asset('img/kota-palemba1684853666_aae063f287870b58f219.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <title>Login</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow login-box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column">
                <div class="featured-image mb-3">
                    <img src="{{ asset('img/bpkad.jpg') }}" class="img-fluid" style="width: 400px; border-radius: 8px;">
                </div>
            </div>
            <div class="col-md-6 login-right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-3 mt-1">
                        <h2>Sinta BMD Kota Palembang</h2>
                        <p>Silahkan Masukkan username dan password anda.</p>
                        @if (session()->has('gagal'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('gagal') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Username" name="username" value="{{ old('username') }}" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mt-3">
                            <button type="submit" class="btn btn-lg w-100 fs-6">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
