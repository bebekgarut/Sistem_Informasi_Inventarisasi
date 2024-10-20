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
    <title>Edit Data</title>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Edit Data</h3>
                    </div>
                    <hr>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <form action="{{ route('updateDataUser', $users->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="add-form-label">Username</label>
                                <input type="text" class="add-form-control" id="username"
                                    placeholder="Masukan Username" value="{{ $users->username }}" name="username"
                                    autocomplete="off" required>
                                @error('username')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="add-form-label">Password Baru</label>
                                <input type="password" class="add-form-control" placeholder="Password Baru"
                                    id="password" name="password" autocomplete="off" required>
                                @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label for="role" class="add-form-label">Role</label>
                                <div>
                                    <div class="form-check form-check-inline custom-radio">
                                        <input class="form-check-input custom-radio-input" type="radio"
                                            name="role" id="role_admin" value="admin"
                                            {{ old('role') == 'admin' ? 'checked' : '' }} required>
                                        <label class="form-check-label custom-radio-lable"
                                            for="role_admin">Admin</label>
                                    </div>
                                    <div class="form-check- form-check-inline custom-radio">
                                        <input class="form-check-input custom-radio-input" type="radio"
                                            name="role" id="role_upb" value="upb"
                                            {{ old('role') == 'upb' ? 'checked' : '' }} required>
                                        <label class="form-check-label custom-radio-lable" for="role_upb">UPB</label>
                                    </div>
                                </div>
                                @error('role')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            <hr>
                            <a href="/data_user" class="btn">Kembali</a>
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
