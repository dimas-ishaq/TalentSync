<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    {{-- Bootstrap Icons --}}

    <title>Dashboard - Karyawan</title>
</head>

<body>
    @include('layouts.components.toast')
    <div class="container-fluid m-0 p-0 row min-vh-100 ">
        <div class="d-flex w-100">
            <div class="sidebar-container px-4
                d-none d-lg-block text-bg-light min-vh-100 fixed-top">
                @include('layouts.karyawan.sidebar')
            </div>
            <div class="main-content w-100">
                <div class="row flex-column">
                    <div class="col ">
                        {{-- bisa di tambah sticky-top --}}
                        @include('layouts.karyawan.header')
                    </div>
                    <div class="col">
                        <main>
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
        integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
    </script>
    @stack('script')
</body>

</html>
