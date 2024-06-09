<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Platform Kompetisi Pelajar Indonesia</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .device-wrapper {
      position: relative;
      width: 100%;
      max-width: 250px;
    }
    .device {
      position: relative;
      width: 100%;
      top: -5%;
    }
    .device img {
      width: 100%;
      display: block;
    }
    .screen {
      position: absolute;
      top: -2%;
      left: 5%;
      width: 90%;
      height: 95%;
      overflow: hidden;
    }
    .screen img {
      width: 100%;
    }
  </style>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gypem</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('landingpage/img/favicon.png')}}" rel="icon">
  <link href="{{asset('landingpage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    
  <!-- Google Fonts --> 
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landingpage/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('landingpage/css/style.css')}}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="index.html">Gypem Olimpiade</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="asset/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a class="active " href="home">Home</a></li>
          <li><a href="event">Event</a></li>
          <li><a href="#footer">Contact Us</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section class="hero-section" id="hero">

    <div class="wave">

      <svg width="100%" height="355px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
            <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path"></path>
          </g>
        </g>
      </svg>

    </div>
    

    <div class="container">
  <div class="row align-items-center">
    <div class="col-12 hero-text-image">
      <div class="row">
        <div class="col-lg-8 text-center text-lg-start">
          <h1 data-aos="fade-right">Platform Kompetisi Pelajar Seluruh <br>Indonesia</h1>
          <p class="mb-5" data-aos="fade-right" data-aos-delay="100">
            Bergabunglah bersama GYPEM dan tunjukkan potensimu dalam<br> berbagai kompetisi seru!
            Jadilah bagian dari perjalanan prest  asi<br> dan eksplorasi bakatmu.
            Ayo sambut tantangan, raih kesempatan,<br> serta buktikan bahwa kamu adalah pemenang sejati.
          </p>
        </div>
        <div class="col-lg-4 d-flex justify-content-center">
          <div class="device-wrapper">
            <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
              <img src="landingpage/img/hp.png" alt="Device Frame">
            </div>
            <!-- Carousel Bootstrap -->
            <div class="screen">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="landingpage/img/1.png" class="d-block w-100" alt="Gambar 1">
                  </div>
                  <div class="carousel-item">
                    <img src="landingpage/img/2.png" class="d-block w-100" alt="Gambar 2">
                  </div>
                  <div class="carousel-item">
                    <img src="landingpage/img/3.png" class="d-block w-100" alt="Gambar 3">
                  </div>
                  <div class="carousel-item">
                    <img src="landingpage/img/4.png" class="d-block w-100" alt="Gambar 4">
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .row -->
    </div> <!-- .hero-text-image -->
  </div> <!-- .row -->
</div> <!-- .container -->

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Home Section ======= -->
    <section class="section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="ok" data-aos="fade-up">
            <h2 class="section-heading">Banyak orang telah melihat manfaat dalam mengikuti kompetisi di Gypem.</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-people"></i>
              </div>
              <h3 class="mb-3">Hadiah dan Certificate</h3>
              <p>Menangkan hadiah menarik dan dapatkan sertifikat resmi yang akan bermanfaat bagimu.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-brightness-high"></i>
              </div>
              <h3 class="mb-3">Fleksibel</h3>
              <p>Dilaksanakan secara daring. Kompetisi ini dapat diikuti dan dikerjakan dimanapun kalian berada.</p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-1 text-center">
              <div class="wrap-icon icon-1">
                <i class="bi bi-bar-chart"></i>
              </div>
              <h3 class="mb-3">Premium Examp</h3>
              <p>Gypem menggunakan soal berkualitas tinggi agar memberikan acuan dan meningkatkan daya saing. </p>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="section">
  <div class="container">
    <div class="row justify-content-center text-center mb-5" data-aos="fade">
      <div class="col-md-6 mb-5">
        <img src="landingpage/img/undraw_svg_1.svg" alt="Image" class="img-fluid">
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-3">
        <div class="step">
          <span class="number">Fitur Mobile</span>
          <h3>HOME</h3>
          <p>Menampilkan beberapa Event Olimpiade yang nantinya akan diikuti oleh perserta. </p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step">
          <span class="number">Fitur Mobile</span>
          <h3>MY EVENT</h3>
          <p>Jika peserta telah mendaftarkan event yang sudah terpilih maka akan muncul di MyEvent.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step">
          <span class="number">Fitur Mobile</span>
          <h3>HISTORY</h3>
          <p>History akan menampilkan peserta yang telah mengikuti event olimpiade.</p>
        </div>
      </div>
      <div class="col-md-3">
        <div class="step">
          <span class="number">Fitur Mobile</span>
          <h3>PROFILE</h3>
          <p>Tedapat biodata peserta dengan fitur lainnya seperti ubah profile dan ganti password.</p>
        </div>
      </div>
    </div>
  </div>
</section>


    <section class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-4 me-auto">
            <h2 class="mb-4">PROFILE GYPEM</h2>
            <p class="mb-4">GYMPEM adalah organisasi pelajar yang memberikan platform kompetisi multi-bidang untuk pengembangan potensi dan prestasi. Misi mereka adalah memotivasi pelajar untuk mengeksplorasi bakat mereka dan menunjukkan prestasi terbaik, serta membentuk generasi muda yang berprestasi.</p>
          </div>
          <div class="col-md-6" data-aos="fade-left">
            <img src="landingpage/img/hero-image 1.png" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-4 ms-auto order-2">
            <h2 class="mb-4">PETUNJUK TEKNIS</h2>
            <p class="mb-4">Peserta akan diarahkan menggunakan Aplikasi Mobile ketika ingin mau mengikuti olimpiade Platform Gypem. Dimana disana akan registrasi terlebih dahulu agar mendapatkan certificate resmi dari Gypem.</p>
          </div>
          <div class="col-md-6" data-aos="fade-right">
            <img src="landingpage/img/undraw_svg_3.svg" alt="Image" class="img-fluid">
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Testimonials Section ======= -->
    <section class="section border-top border-bottom">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-4">
            <h2 class="section-heading">Testmoni Peserta Gypem</h2>
          </div>
        </div>
        <div class="row justify-content-center text-center">
          <div class="col-md-7">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="review text-center">
                    <p class="stars">
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill muted"></span>
                    </p>
                    <h3>Enjoy Moment</h3>
                    <blockquote>
                      <p>Ketika aku Memulai ujian Olimpiade sangatlah santai tapi agak menantang semakin kebelakang, tapi aku yakin hal ini akan terus aku berkembang dan lebih bersaing lagi.</p>
                    </blockquote>

                    <p class="review-user">
                      <img src="landingpage/img/ici.jpeg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Ichie revan Fikriyuddin</span>, &mdash; Peserta
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="review text-center">
                    <p class="stars">
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill muted"></span>
                    </p>
                    <h3>This is Amazing Platform</h3>
                    <blockquote>
                      <p>Keren.. Usai mengikuti Olimpiade ini tak lupa akan mendapatkan setifikat resmi kemudian hari dari Gypem serta terdapat banyak mapel olimpiade yang sangat memuaskan.</p>
                    </blockquote>

                    <p class="review-user">
                      <img src="landingpage/img/fajar.jpeg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Fajar Dwi Firmansyah</span>, &mdash; Peserta
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="review text-center">
                    <p class="stars">
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill"></span>
                      <span class="bi bi-star-fill muted"></span>
                    </p>
                    <h3>Perfect Competition</h3>
                    <blockquote>
                      <p>Gilaa.. gak habis pikir Gypem olimpiade ini sangatlah menantang mulai dari persoalan yang aku kerjakan. Walaupun otakku sedikit mules tapi tetep aja seru dan menantang justrunya.  </p>
                    </blockquote>

                    <p class="review-user">
                      <img src="landingpage/img/nando.jpeg" alt="Image" class="img-fluid rounded-circle mb-3">
                      <span class="d-block">
                        <span class="text-black">Setia Nando Pangestu</span>, &mdash; Peserta
                      </span>
                    </p>

                  </div>
                </div><!-- End testimonial item -->

              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->
<!-- ======= Footer ======= -->
<footer class="footer" role="contentinfo">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4 mb-md-0">
        <h3>Tentang Gypem</h3>
        <p>Gypem adalah platform kompetisi yang menonjol dengan soal berkualitas tinggi, membantu peserta meningkatkan keterampilan dan daya saing mereka.</p>
      </div>
      <div class="col-md-7 ms-auto">
        <div class="row site-section pt-0">
          <div class="col-md-6 mb-4 mb-md-0">
            <h3>Navigation</h3>
            <p class="mb-1"><strong>Email:</strong> Gypemolimpiadenasional@gmail.com</p>
            <p class="mb-1"><strong>No. WhatsApp:</strong> +62 852 0495 7813</p>
            <p class="mb-0"><strong>Lokasi:</strong> Jl. Citarung no.13 Panderejo, Banyuwangi</p>
          </div>
          <div class="col-md-6 mb-4 mb-md-0">
            <h3>Sosial Media</h3>
            <div class="social">
          <a href="#"><span class="bi bi-twitter"></span></a>
          <a href="#"><span class="bi bi-facebook"></span></a>
          <a href="#"><span class="bi bi-instagram"></span></a>
          <a href="#"><span class="bi bi-linkedin"></span></a>
        </div>
          </div>    
        </div>
      </div>
    </div>
  </div>
</footer>

<style>
.footer {
  background: linear-gradient(to right, #4A00E0, #8E2DE2);
  color: white;
}

</style>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="landingpage/vendor/aos/aos.js"></script>
  <script src="landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="landingpage/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="landingpage/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="landingpage/js/main.js"></script>

</body>

</html>