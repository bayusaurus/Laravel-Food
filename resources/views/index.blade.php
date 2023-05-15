<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOPHIA VIOLETTA SEAFOOD</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SOPHIA VIOLLETA SEAFOOD') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('images/home/favicon.ico') }}" type="image/x-icon">
</head>

<body>

    <!-- NAVBAR -->
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-hijau fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/home/logo-seafood.png') }}" width="30" height="30" class="d-inline-block align-top " alt="" loading="lazy">&nbsp;&nbsp;SOPHIA VIOLETTA SEAFOOD</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        <a class="nav-link active" href="#home">Home</span></a>
                        <a class="nav-link active" href="#about">About</a>
                        <a class="nav-link active" href="#special">Special</a>
                        <a class="nav-link active" href="#menu">Menu</a>
                        <a class="nav-link active" href="#event">Event</a>
                        <a class="nav-link active" href="#testimonial">Testimonial</a>
                        <a class="nav-link active" href="#gallery">Gallery</a>
                        <a class="nav-link active" href="#contact">Contact Us</a>
                    </div>
                </div>
            </div>
        </nav>
    </section>

    <main>
        <!-- HEADER -->
        <section id="home">
            <div class="flex-center position-ref full-height text-white bg-kuning">
                <div class="container text-hijau text-center mb-5 header-content">
                    <img src="{{ asset('images/home/seafood.png') }}" class="header-image col-md-9 mb-5" alt="">
                    <h1 class="font-montserrat mt-2 display-4">SOPHIA VIOLETTA SEAFOOD</h1>
                    <p class="header-lead">Specialist in Seafood. Delivering great Seafood for more than 18 years!</p>
                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section id="about">
            <div class="bg-hitam-transparent text-white">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-6 py-3 px-3 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                            <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                                <div class="about-image">
                                    <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6 py-3 px-3 order-2 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                            <h3 class="font-montserrat">MORE THAN JUST SEAFOOD</h3>
                            <p class="font-italic">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                magna aliqua.
                            </p>
                            <ul>
                                <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                            </ul>
                            <p>
                                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                culpa qui officia deserunt mollit anim id est laborum
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ABOUT-->
        <section>
            <div class="bg-abu">
                <div class="container py-5 text-dark" data-aos="fade-up">
                    <h4 class="">WHY US</h4>
                    <h2 class="font-montserrat">Why Choose Our Restaurant</h2>
                    <div class="row">
                        <div class="col-md-4 py-3 px-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="bg-putih box">
                                <span class="text-kuning">01</span>
                                <h4>EXPERIENCED</h4>
                                <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                            </div>
                        </div>
                        <div class="col-md-4 py-3 px-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="bg-putih box">
                                <span class="text-kuning">02</span>
                                <h4>AUTHENTIC</h4>
                                <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                            </div>
                        </div>
                        <div class="col-md-4 py-3 px-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="bg-putih box">
                                <span class="text-kuning">03</span>
                                <h4>CONVENIENT</h4>
                                <p>Ulamco laboris nisi ut aliquip ex ea commodo consequat. Et consectetur ducimus vero placeat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SPECIAL -->
        <section class="bg-kuning" id="special">
            <div>
                <div class="container py-5 text-white" data-aos="fade-up">
                    <h4 class="">SPECIAL</h4>
                    <h2 class="font-montserrat text-hijau">Check Our Specials</h2>
                    <div class="slider-single text-dark" data-aos="fade-left">

                        <div class="col-md-12 px-2 py-2">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{ asset('images/home/kepiting.jpg') }}" alt="Card image">
                                <div class="card-img-overlay">
                                    <a class="venobox" href="{{ asset('images/home/kepiting.jpg') }}">
                                        <h3 class="card-title">Delicious King Crab</h3>
                                    </a>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text">Last updated 3 mins ago</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 px-2 py-2">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{ asset('images/home/lobster.jpg') }}" alt="Card image">
                                <div class="card-img-overlay">
                                    <a class="venobox" href="{{ asset('images/home/lobster.jpg') }}">
                                        <h3 class="card-title">Lobster Mozarella</h3>
                                    </a>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text">Last updated 3 mins ago</p> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 px-2 py-2">
                            <div class="card bg-dark text-white">
                                <img class="card-img" src="{{ asset('images/home/cumi.jpg') }}" alt="Card image">
                                <div class="card-img-overlay">
                                    <a class="venobox" href="{{ asset('images/home/cumi.jpg') }}">
                                        <h3 class="card-title">Squid</h3>
                                    </a>
                                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text">Last updated 3 mins ago</p> -->
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </section>

        <!-- MENU -->
        <section id="menu">
            <div class="bg-hijau">
                <div class="container py-5 text-white" data-aos="fade-up">
                    <h4 class="">MENU</h4>
                    <h2 class="font-montserrat text-kuning">Check Our Tasty Menu</h2>

                    <div class="row">
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/crab.png') }}">
                                        <img src="{{ asset('images/home/crab.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/clam.png') }}">
                                        <img src="{{ asset('images/home/clam.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/friedrice.png') }}">
                                        <img src="{{ asset('images/home/friedrice.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/salad.png') }}">
                                        <img src="{{ asset('images/home/salad.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/lobster.png') }}">
                                        <img src="{{ asset('images/home/lobster.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/tea.png') }}">
                                        <img src="{{ asset('images/home/tea.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 px-2 py-2" data-aos="zoom-in">
                            <div class="card">
                                <div class="menu-image">
                                    <a class="venobox" href="{{ asset('images/home/cofee.png') }}">
                                        <img src="{{ asset('images/home/cofee.png') }}" class="card-img-top" alt="...">
                                    </a>
                                </div>
                                <div class="card-body bg-kuning">
                                    <h4 class="text-white text-dark">Delicious King Crab</h4>
                                    <h5 class="font-montserrat text-hijau text-right">Rp. 80.000</h5>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </section>

        <!-- EVENT -->
        <section class="bg-hitam-transparent" id="event">
            <div>
                <div class="container py-5 text-white" data-aos="fade-up">
                    <h4 class="">EVENT</h4>
                    <h2 class="font-montserrat text-kuning">Organize Your Events in our Restaurant</h2>

                    <div class="slider-single py-3 bg-putih-transparent" data-aos="fade-right">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 py-3 px-3 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                                    <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                                        <div class="about-image">
                                            <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 py-3 px-3 order-2 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                                    <h3 class="font-montserrat text-kuning">FAMILY GATHERING</h3>
                                    <h3 class="font-montserrat text-kuning">Rp. 500.000</h3>
                                    <p class="font-italic">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua.
                                    </p>
                                    <ul>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                    </ul>
                                    <p>
                                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 py-3 px-3 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                                    <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                                        <div class="about-image">
                                            <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6 py-3 px-3 order-2 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                                    <h3 class="font-montserrat text-kuning">BIRTHDAY PARTY</h3>
                                    <h3 class="font-montserrat text-kuning">Rp. 900.000</h3>
                                    <p class="font-italic">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua.
                                    </p>
                                    <ul>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                    </ul>
                                    <p>
                                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 py-3 px-3 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="200">
                                    <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                                        <div class="about-image">
                                            <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-6 py-3 px-3 order-2 order-lg-1" data-aos="zoom-in" data-aos-delay="100">
                                    <h3 class="font-montserrat text-kuning">COMMUNITY MEET UP</h3>
                                    <h3 class="font-montserrat text-kuning">Rp. 1.000.000</h3>
                                    <p class="font-italic">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                        magna aliqua.
                                    </p>
                                    <ul>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                                    </ul>
                                    <p>
                                        Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                                        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                        culpa qui officia deserunt mollit anim id est laborum
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            </div>
        </section>

        <!-- TESTIMONIAL -->
        <section class="bg-hijau" id="testimonial">
            <div>
                <div class="container py-5 text-white" data-aos="fade-up">
                    <h4 class="">TESTIMONIAL</h4>
                    <h2 class="font-montserrat text-kuning">What they're saying about us</h2>

                    <div class="slider-testimonial py-5" data-aos="zoom-in" data-aos-delay="100">
                        <div class="rounded testimonial-item mx-2 pb-3">
                            <p class="px-3 pt-3 text-justify">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <center>
                                <div class="testimonial-img mb-3">
                                    <img src="{{ asset('images/home/parkseojoon.jpeg') }}" class="rounded-circle" alt="">
                                </div>
                            </center>
                            <h3 class="text-center text-dark">Saul Goodman</h3>
                            <h4 class="text-center text-dark">Ceo &amp; Founder</h4>
                        </div>

                        <div class="rounded testimonial-item mx-2 pb-3">
                            <p class="px-3 pt-3 text-justify">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <center>
                                <div class="testimonial-img mb-3">
                                    <img src="{{ asset('images/home/yoohyeon.jpg') }}" class="rounded-circle" alt="">
                                </div>
                            </center>
                            <h3 class="text-center text-dark">Saul Goodman</h3>
                            <h4 class="text-center text-dark">Ceo &amp; Founder</h4>
                        </div>
                        <div class="rounded testimonial-item mx-2 pb-3">
                            <p class="px-3 pt-3 text-justify">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <center>
                                <div class="testimonial-img mb-3">
                                    <img src="{{ asset('images/home/sua.jpg') }}" class="rounded-circle" alt="">
                                </div>
                            </center>
                            <h3 class="text-center text-dark">Saul Goodman</h3>
                            <h4 class="text-center text-dark">Ceo &amp; Founder</h4>
                        </div>
                        <div class="rounded testimonial-item mx-2 pb-3">
                            <p class="px-3 pt-3 text-justify">
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <center>
                                <div class="testimonial-img mb-3">
                                    <img src="{{ asset('images/home/yoohyeon.jpg') }}" class="rounded-circle" alt="">
                                </div>
                            </center>
                            <h3 class="text-center text-dark">Saul Goodman</h3>
                            <h4 class="text-center text-dark">Ceo &amp; Founder</h4>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- GALLERY -->
        <section class="bg-putih" id="gallery">
            <div class="pt-5 mb-3 container" data-aos="fade-up">
                <h4 class="">GALLERY</h4>
                <h2 class="font-montserrat text-dark">Some photos from Our Restaurant</h2>
            </div>
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/about.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/about.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3 padding-0 margin-0">
                        <a class="venobox" href="{{ asset('images/home/banner.jpg') }}">
                            <div class="gallery-image">
                                <img src="{{ asset('images/home/banner.jpg') }}" class="" alt="">
                            </div>
                        </a>
                    </div>

                </div>
        </section>

        <!-- CONTACT -->
        <section class="bg-hijau py-5" id="contact">
            <div class="mb-3 container" data-aos="fade-up">
                <h4 class="text-white">CONTACT</h4>
                <h2 class="font-montserrat text-kuning">Get in Touch With US</h2>
            </div>
            <div class="container">
                <div class="col-md-10 offset-md-1 " data-aos="flip-up" data-aos-delay="100">
                    <div class="card bg-kuning text-hijau">
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">

                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-google-map icofont-2x"></i>
                                        <h4 class="mt-3">Location:</h4>
                                        <p>A108 Adam Street, New York, NY 535022</p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-clock-time icofont-2x"></i>
                                        <h4 class="mt-3">Open Hours:</h4>
                                        <p>
                                            Monday-Saturday:<br>
                                            11:00 AM - 2300 PM
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-envelope icofont-2x"></i>
                                        <h4 class="mt-3">Email:</h4>
                                        <p>info@example.com</p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-phone icofont-2x"></i>
                                        <h4 class="mt-3">Call:</h4>
                                        <p>+1 5589 55488 55s</p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-facebook icofont-2x"></i>
                                        <h4 class="mt-3">Facebook:</h4>
                                        <p>Sophia Violetta Seafood</p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-instagram icofont-2x"></i>
                                        <h4 class="mt-3">Instagram:</h4>
                                        <p>Sophia Violetta Seafood</p>
                                    </div>
                                </div>
                                <div class="col-md-3 py-3 px-3" data-aos="flip-left" data-aos-delay="200">
                                    <div class="contact-item text-center">
                                        <i class="icofont-youtube icofont-2x"></i>
                                        <h4 class="mt-3">Youtube:</h4>
                                        <p>Sophia Violetta Seafood</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-white">
        <div class="container pt-5">
            <div class="row py-4">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <img src="img/logo.png" alt="" width="180" class="mb-3">
                    <p>NASA Headquarters 300 E. Street SW, Suite 5R30
                        <br> Washington, DC 20546
                        <br>(202) 358-0001 (Office)
                        <br>(202) 358-4338 (Fax)</p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">Social</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-muted"><i class="icofont-facebook"></i> Facebook</a></li>
                        <li class="mb-2"><a href="#" class="text-muted"><i class="icofont-instagram"></i> Instagram</a></li>
                        <li class="mb-2"><a href="#" class="text-muted"><i class="icofont-youtube"></i> Youtube</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">Company</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="#" class="text-muted">Login</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Register</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Wishlist</a></li>
                        <li class="mb-2"><a href="#" class="text-muted">Our Products</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-lg-0">
                    <h6 class="text-uppercase font-weight-bold mb-4">Newsletter</h6>
                    <p class="text-muted mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque temporibus.</p>
                    <div class="p-1 rounded border">
                        <div class="input-group">
                            <input type="email" placeholder="Enter your email address" aria-describedby="button-addon1" class="form-control border-0 shadow-0">
                            <div class="input-group-append">
                                <button id="button-addon1" type="submit" class="btn btn-link"><i class="icofont-send-mail icofont-2x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyrights -->
        <div class="bg-light py-4">
            <div class="container text-center">
                <p class="text-muted mb-0 py-2">© 2020 SOPHIA VIOLETTA SEAFOOD. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- End -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        // Initiate venobox lightbox
        $(document).ready(function() {
            $('.venobox').venobox();
            // Init AOS
            function aos_init() {
                AOS.init({
                    duration: 1000,
                    once: true
                });
            }
            $(window).on('load', function() {
                aos_init();
            });

            $('.slider-single').slick({
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                arrows: false,
                focusOnSelect: true,
            });

            $('.slider-testimonial').slick({
                centerMode: true,
                centerPadding: '60px',
                slidesToShow: 3,
                autoplay: true,
                autoplaySpeed: 2000,
                infinite: true,
                arrows: false,
                focusOnSelect: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 2,
                            autoplay: true,
                            autoplaySpeed: 2000,
                            infinite: true,
                            focusOnSelect: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            arrows: false,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 1,
                            autoplay: true,
                            autoplaySpeed: 2000,
                            infinite: true,
                            focusOnSelect: true
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>