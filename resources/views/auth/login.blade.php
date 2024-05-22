<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Gypem </title>

    <link rel="shortcut icon" href="{{ asset('assets/img/school.svg') }}" type="image/x-icon">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/stylelog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>

<body>
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action="{{ route('login') }}" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            @csrf
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input id="email" type="email"
                        class="@error('email') is-invalid @enderror" name="email"
                        placeholder="Masukkan Alamat Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" name="password"
                        placeholder="Masukkan Password" tabindex="2" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                    </button>
                </div>
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>GYPEM OLYMPIADE</h3>
            <p>
              Silahkan Login Terlebiih dahulu, Masukkan Username dan Password dengan baik dan Bennar
            </p>
          </div>
          <img src="{{asset('assets/log.svg')}}" class="image" alt="" />
        </div>
      </div>

    <script src="applog.js"></script>
  </body>

</html>