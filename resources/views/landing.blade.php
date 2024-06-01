<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LC JAYA CLEAN</title>
    <link href="{{ asset('/img/dashboard/favicon.png') }}" rel="icon" type="image/png">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Javascript -->
    <script defer src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script defer src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body style="padding-top: 56px;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark
    fixed-top">
        <div class="container">
            <a class="navbar-brand" href="">LC JAYA CLEAN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    {{-- <li class="nav-item mr-sm-3 mb-2 mb-sm-0">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @lang('landing.langtext')
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('id') }}">Indonesia</a>
                                <a class="dropdown-item" href="{{ url('en') }}">English</a>
                            </div>
                        </div>
                    </li> --}}
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ url('login') }}">@lang('landing.loginOrRegister')</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="py-5 position-relative">
        <div class="background-blur"></div>
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-3 align-item-right">
                    <h1 class="display-5 text-white mt-8 mb-8 with-border">@lang('landing.welcome')</h1>
                </div>
            </div>
    </header>
    <section class="text-center p-5">
        <h2>Lokasi Kami!!</h2>
    </section>
    <section class="text-white bg-blue">
        <div class="container p-5">
            <div class="row">
                <div class="col-md-6 mb-4 mb-sm-0">
                    <h5>Alamat</h5>
                    <p> Jl. Sadananya, Dusun Desa, Rt.10,Rw.02, Kab.Ciamis, Jawa Barat</p>
                    <br>
                    <h5>Kontak</h5>
                    <p> WhatsApp : 081321288393</p>
                </div>
                <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63315.59414854545!2d108.29387232548608!3d-7.328648743353426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f5e82ef269cdf%3A0x401e8f1fc28e1b0!2sCiamis%2C%20Kec.%20Ciamis%2C%20Kabupaten%20Ciamis%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1716878801360!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- /.container -->

    <!-- Footer -->
        <!-- /.container -->
    </footer>

</body>

</html>
