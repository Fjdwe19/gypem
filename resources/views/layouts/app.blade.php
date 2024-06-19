<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard &mdash; Gypem</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logss.png') }}" type="image/x-icon">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap4.css') }}" />

    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styledash.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    @livewireStyles
</head>

<body style="background: ghostwhite;">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <img src="{{asset('assets/img/logss.png')}}" style="width:40px; height: 40px;">
                        <a href="index.html">GYPEM APP</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                    <img src="{{asset('assets/img/logss.png')}}" style="width:40px; height: 40px;">
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">MAIN MENU</li>
                        <li class="{{ setActive('/dashboard') }}"><a class="nav-link"
                                href="{{ route('dashboard.index') }}"><i class="fas fa-laptop"></i>
                                <span>Dashboard</span></a></li>
                        <!-- Event
                        @can('events.index')
                        <li class="{{ setActive('/event') }}"><a class="nav-link"
                                href="{{ route('events.index') }}"><i class="fas fa-image"></i>
                                <span>Event</span></a></li>
                        @endcan -->

                        @can('exams.index')
                        <li class="{{ setActive('/exam') }}"><a class="nav-link"
                                href="{{  route('exams.index') }}"><i class="fas fa-book-open"></i>
                                <span>Ujian</span></a></li>
                        @endcan

                        <!-- Pembuatan Soal -->
                        @if(auth()->user()->can('images.index') || auth()->user()->can('videos.index') || auth()->user()->can('audios.index') || auth()->user()->can('documents.index'))
                        <li class="menu-header">Pembuatan Soal</li>
                        @endif

                        @can('questions.index')
                        <li class="{{ setActive('/question') }}"><a class="nav-link"
                                href="{{ route('questions.index') }}"><i class="fas fa-question-circle"></i> <span>Soal</span></a>
                        </li>
                        @endcan

                        @can('subjects.index')
                        <li class="{{ setActive('/subject') }}"><a class="nav-link"
                                href="{{ route('subjects.index') }}"><i class="fas fa-atlas"></i>
                                <span>Mapel</span></a></li>
                        @endcan

                        @can('images.index')
                        <li class="{{ setActive('/image') }}"><a class="nav-link"
                                href="{{ route('images.index') }}"><i class="fas fa-image"></i>
                                <span>Soal Gambar</span></a></li>
                        @endcan

                        @can('videos.index')
                        <li class="{{ setActive('/video') }}"><a class="nav-link"
                                href="{{ route('videos.index') }}"><i class="fas fa-video"></i>
                                <span>Soal Video</span></a></li>
                        @endcan

                        @can('audios.index')
                        <li class="{{ setActive('/audio') }}"><a class="nav-link"
                                href="{{ route('audios.index') }}"><i class="fas fa-volume-up"></i>
                                <span>Soal Audio</span></a></li>
                        @endcan

                        @can('documents.index')
                        <li class="{{ setActive('/document') }}"><a class="nav-link"
                                href="{{ route('documents.index') }}"><i class="fas fa-file-pdf "></i>
                                <span>Soal Document</span></a></li>
                        @endcan

                        @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index'))
                        <li class="menu-header">PENGATURAN</li>
                        @endif
                        
                        @can('sliders.index')
                        <li class="{{ setActive('admin/slider') }}"><a class="nav-link"
                                href="#"><i class="fas fa-laptop"></i>
                                <span>Sliders</span></a></li>
                        @endcan

                        <li
                            class="dropdown {{ setActive('admin/role'). setActive('admin/permission'). setActive('admin/user') }}">
                            @if(auth()->user()->can('roles.index') || auth()->user()->can('permission.index') || auth()->user()->can('users.index') || auth()->user()->can('sertificate.index'))
                                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Pengaturan Tambahan</span></a>
                            @endif
                            
                            <ul class="dropdown-menu">
                                @can('roles.index')
                                    <li class="{{ setActive('admin/role') }}"><a class="nav-link"
                                        href="{{ route('roles.index') }}"><i class="fas fa-unlock"></i> Roles</a>
                                </li>
                                @endcan

                                @can('permissions.index')
                                    <li class="{{ setActive('/permission') }}"><a class="nav-link"
                                    href="{{ route('permissions.index') }}"><i class="fas fa-key"></i>
                                    Permissions</a></li>
                                @endcan

                                @can('users.index')
                                    <li class="{{ setActive('/user') }}"><a class="nav-link"
                                        href="{{ route('users.index') }}"><i class="fas fa-user-secret"></i> Users</a>
                                </li>
                                @endcan
                                <li class="{{ setActive('sertificate') }}"><a class="nav-link" href="{{ route('sertificate.index') }}"><i class="fas fa-bell"></i><span>Sertificate</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('content')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/js/maindash.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function () {
            // Initialize Select2
            $('select').select2({
                theme: 'bootstrap4',
                width: 'style',
            });

            // Flash message
            @if(session()->has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL!',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    showConfirmButton: false,
                    showCancelButton: false,
                    buttons: false,
                });
            @endif

            @if(session()->has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'GAGAL!',
                    text: '{{ session('error') }}',
                    timer: 1500,
                    showConfirmButton: false,
                    showCancelButton: false,
                    buttons: false,
                });
            @endif
        });
    </script>
    @livewireScripts
</body>
</html>