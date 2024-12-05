<header id="page-topbar">
    <script>
        function updateTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();
            var day = now.getDate();
            var month = now.toLocaleString('default', {
                month: 'long'
            });
            var year = now.getFullYear();

            // Menambahkan angka 0 di depan angka satu digit
            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            var timeString = hours + ":" + minutes + ":" + seconds;
            var dateString = month + " " + day + ", " + year;

            document.getElementById("clock").innerHTML = timeString;
            document.getElementById("date").innerHTML = dateString;

            // Memperbarui waktu setiap 1 detik
            setTimeout(updateTime, 1000);
        }

        // Memanggil fungsi updateTime saat halaman di-load
        window.onload = function() {
            updateTime();
        };
    </script>
    <style>
        #clock {
            font-size: 20px;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        #date {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-size: 20px;
            color: #ffffff;
            padding-left: 20px
        }
    </style>
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/assets/images/logo-dark.png') }}" alt="" height="20">
                    </span>
                </a>

                <a href="{{ url('index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('build/assets/images/logo-light.png') }}" alt="" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            {{-- <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="@lang('translation.Search')...">
                    <span class="uil-search"></span>
                </div>
            </form> --}}
            <!-- Real-time Clock -->
            <div class="navbar">
                <div class="app-clock d-none d-lg-block">
                    <div class="position-relative">
                        <span id="date"></span>
                        <span id="clock"></span>
                    </div>
                </div>

            </div>

        </div>

        <div class="d-flex">



            {{-- lang --}}
            {{-- <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @switch(Session::get('lang'))
                        @case('ru')
                            <img src="{{ URL::asset('build/assets/images/flags/russia.jpg') }}" alt="Header Language"
                                height="16"> <span class="align-middle"></span>
                        @break

                        @case('it')
                            <img src="{{ URL::asset('build/assets/images/flags/italy.jpg') }}" alt="Header Language"
                                height="16"> <span class="align-middle"></span>
                        @break

                        @case('de')
                            <img src="{{ URL::asset('build/assets/images/flags/germany.jpg') }}" alt="Header Language"
                                height="16"> <span class="align-middle"></span>
                        @break

                        @case('es')
                            <img src="{{ URL::asset('build/assets/images/flags/spain.jpg') }}" alt="Header Language"
                                height="16"> <span class="align-middle"></span>
                        @break

                        @default
                            <img src="{{ URL::asset('build/assets/images/flags/us.jpg') }}" alt="Header Language"
                                height="16"> <span class="align-middle"></span>
                    @endswitch
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <!-- item-->
                    <a href="{{ url('index/en') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1"
                            height="12"> <span class="align-middle">English</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/es') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/assets/images/flags/spain.jpg') }}" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/de') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/assets/images/flags/germany.jpg') }}" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/it') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/assets/images/flags/italy.jpg') }}" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="{{ url('index/ru') }}" class="dropdown-item notify-item">
                        <img src="{{ URL::asset('build/assets/images/flags/russia.jpg') }}" alt="user-image"
                            class="me-1" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div> --}}

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <i class="uil-minus-path"></i>
                </button>
            </div>



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ URL::asset('build/assets/images/users/avatar-4.jpg') }}" alt="Header Avatar">
                    <span
                        class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ Str::ucfirst(Auth::user()->name) }}</span>
                    <i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a href="" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span
                            class="align-middle">@lang('translation.Sign_out')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            {{-- switch theme --}}
            {{-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="uil-cog"></i>
                </button>
            </div> --}}

        </div>
    </div>
</header>
