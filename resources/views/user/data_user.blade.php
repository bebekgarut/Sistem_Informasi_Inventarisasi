<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <style>
        @media (max-width: 768px) {
            .pagination li:nth-child(n+10):not(:last-child) {
                display: none;
            }
        }
    </style>

</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <x-sidebar></x-sidebar>
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                <div class="row my-2">
                    <div class="col-md">
                        <h3 class="text-center fw-bold text-uppercase">Data User</h3>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('successEdit'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('successEdit') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session()->has('hapus'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('hapus') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md">
                        <a href="{{ route('tambahUser') }}" class="btn"><i
                                class="bi bi-person-plus-fill"></i>&nbsp;Tambah User</a>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="table-responsive col-md">
                        <div>
                            Showing {{ $users->count() }} of {{ $users->total() }} data
                        </div>
                        <table class="table table-striped text-center mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="fixed-user-column">Username</th>
                                    <th class="fixed-user-column">Password</th>
                                    <th class="fixed-user-column">Role</th>
                                    <th class="fixed-aksi-column">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>Password Terenkripsi</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('editDataUser', $user->id) }}" class="btn btn-sm user"
                                                style="font-weight: 600; margin-top:0px;"><i
                                                    class="bi bi-pencil-square"></i>&nbsp;Edit</a>

                                            <button type="button" class="btn btn-sm user" data-bs-toggle="modal"
                                                data-bs-target="#hapusModal{{ $user->id }}"
                                                style="font-weight: 600; margin-top:0px;">
                                                <i class="bi bi-trash-fill"></i>&nbsp;Hapus
                                            </button>
                                            <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="hapusModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="hapusModalLabel{{ $user->id }}">Konfirmasi
                                                                Hapus</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            Apakah Anda yakin ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form method="post"
                                                                action="{{ route('hapusDataUser', $user->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{ $users->links('pagination::bootstrap-4') }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            function updatePagination() {
                if ($(window).width() <= 768) {
                    $('.pagination li').not(':nth-child(-n+4), :last-child, .active').hide();
                } else {
                    $('.pagination li').show();
                }
                var nextPage = $('.pagination .page-item:last-child');
                if (nextPage.hasClass('disabled')) {
                    nextPage.hide();
                }

                var prevPage = $('.pagination .page-item:first-child');
                if (prevPage.hasClass('disabled')) {
                    prevPage.hide();
                }
            }

            $(window).resize(function() {
                updatePagination();
            });

            updatePagination();
        });
    </script>
</body>

</html>
