<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ChatBot Reminder</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link href="{{ asset('/landingpage/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/landingpage/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/landingpage/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('/landingpage/css/creative.min.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">ChatBot Reminder</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Tentang</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Alur Penggunaan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Pengingat untuk Agenda Perkuliahan</h1>
                <hr>
                <p>Dikembangkan oleh Tim Sayang Mama, UAJY 2017</p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Cek Lebih Lanjut</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Apa itu ChatBot Reminder?</h2>
                    <hr class="light">
                    <p class="text-faded"><strong>CHATBOT REMINDER </strong>sebuah alat pengingat agenda perkuliahan, meliputi jadwal, kuis dan tugas kuliah.</p>
                    <a href="#services" class="page-scroll btn btn-default btn-xl sr-button">Memulai!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Bagaimana Ia Bekerja?</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user-plus text-primary sr-icons"></i>
                        <h3>Mendaftar</h3>
                        <p class="text-muted">Kamu harus mendaftar terlebih dahulu di website resmi</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sign-in text-primary sr-icons"></i>
                        <h3>Masuk</h3>
                        <p class="text-muted">Setelah mendaftar, kamu dapat masuk ke sistem untuk memasukkan data jadwal, kuis atau tugas kuliah mu.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-sign-in text-primary sr-icons"></i>
                        <h3>Masuk di Line</h3>
                        <p class="text-muted">Setelah menambah data jadwal, kuis atau tugas, kamu harus login di OA line milik ChatBot Reminder untuk mendapatkan chat pengingat dari Bot-nya</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-bell text-primary sr-icons"></i>
                        <h3>Dapat Pengingat</h3>
                        <p class="text-muted">Kamu akan mendapatkan peringatan berupa chat dari Bot milik ChatBot Reminder sesuai dengan jadwal, kuis atau tugas yang telah kamu masukkan di sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script src="{{ asset('/landingpage/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/landingpage/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/landingpage/vendor/scrollreveal/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('/landingpage/js/creative.min.js') }}"></script>

</body>

</html>
