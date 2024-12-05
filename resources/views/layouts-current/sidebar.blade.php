<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        @if (auth()->user()->hasRole('mdd'))
            <a href="{{ url('mdd') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('build/assets/images/logo-dark.png') }}" alt="" height="30">
                </span>
            </a>
        @else
            <a href="{{ url('superadmin') }}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('build/assets/images/logo-dark.png') }}" alt="" height="30">
                </span>
            </a>
        @endif

        @if (auth()->user()->hasRole('mdd'))
            <a href="{{ url('mdd') }}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('build/assets/images/logo-light.png') }}" alt="" height="30">
                </span>
            </a>
        @else
            <a href="{{ url('superadmin') }}" class="logo logo-light">
                <span class="logo-sm">
                    <img src="{{ URL::asset('build/assets/images/logo-sm.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg">
                    <img src="{{ URL::asset('build/assets/images/logo-dark.png') }}" alt="" height="30">
                </span>
            </a>
        @endif
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">@lang('translation.Menu')</li>

                @if (auth()->user()->hasRole('mdd'))
                    <li>
                        <a href="{{ url('mdd') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('superadmin') }}">
                            <i class="uil-home-alt"></i>
                            <span>@lang('translation.Dashboard')</span>
                        </a>
                    </li>
                @endif


                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="uil-window-section"></i>
                        <span>@lang('translation.Layouts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">@lang('translation.Vertical')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-dark-sidebar">@lang('translation.Dark_Sidebar')</a></li>
                                <li><a href="layouts-compact-sidebar">@lang('translation.Compact_Sidebar')</a></li>
                                <li><a href="layouts-icon-sidebar">@lang('translation.Icon_Sidebar')</a></li>
                                <li><a href="layouts-boxed">@lang('translation.Boxed_Width')</a></li>
                                <li><a href="layouts-preloader">@lang('translation.Preloader')</a></li>
                                <li><a href="layouts-colored-sidebar">@lang('translation.Colored_Sidebar')</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">@lang('translation.Horizontal')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal">@lang('translation.Horizontal')</a></li>
                                <li><a href="layouts-hori-topbar-dark">@lang('translation.Dark_Topbar')</a></li>
                                <li><a href="layouts-hori-boxed-width">@lang('translation.Boxed_Width')</a></li>
                                <li><a href="layouts-hori-preloader">@lang('translation.Preloader')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

                <li class="menu-title">@lang('translation.Fitur')</li>
                @if (auth()->user()->hasRole('mdd'))
                    {{-- Data Perusahaan --}}
                    <li>
                        <a href="{{ route('mdd-company-data') }}" class="waves-effect">
                            <i class="uil-building"></i>
                            <span>@lang('translation.Data_Perusahaan')</span>
                        </a>
                    </li>
                    {{-- Data Karuyawan --}}
                    <li>
                        <a href="{{ route('mdd-sadmin') }}" class="waves-effect">
                            <i class="uil-users-alt"></i>
                            <span>@lang('translation.Data_Karyawan')</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('superadmin'))
                    {{-- Data Tarif Kelompok --}}
                    <li>
                        <a href="{{ route('superadmin-tariff') }}" class="waves-effect">
                            <i class="uil-money-stack"></i>
                            <span>@lang('translation.Data_Tarif')</span>
                        </a>
                    </li>
                    {{-- Data Pelanggan --}}
                    <li>
                        <a href="{{ route('superadmin-install') }}" class="waves-effect">
                            <i class="uil-arrow-circle-down"></i>
                            <span>Data Pelanggan</span>
                        </a>
                    </li>

                    {{-- Cetak Barcode --}}
                    <li>
                        <a href="{{ route('superadmin-customer') }}" class="waves-effect">
                            <i class="uil-document-layout-left"></i>
                            <span>Cetak Barcode</span>
                        </a>
                    </li>

                    {{-- Data Karyawan --}}
                    <li>
                        <a href="{{ route('superadmin-employee') }}" class="waves-effect">
                            <i class="uil-constructor"></i>
                            <span>@lang('translation.Data_Karyawan')</span>
                        </a>
                    </li>
                    {{-- Record Meter --}}
                    <li>
                        <a href="{{ route('superadmin-rmeter') }}" class="waves-effect">
                            <i class="uil-tachometer-fast"></i>
                            <span>Catatan Meter</span>
                        </a>
                    </li>
                    {{-- Pengaduan --}}
                    <li>
                        <a href="{{ route('superadmin-complaint') }}" class="waves-effect">
                            <i class="uil-file-info-alt"></i>
                            <span>Pengaduan</span>
                        </a>
                    </li>
                    {{-- Data Diisolir --}}
                    <li>
                        <a href="{{ route('superadmin-isolate') }}" class="waves-effect">
                            <i class="uil-lock-access"></i>
                            <span>@lang('translation.Data_Diisolir')</span>
                        </a>
                    </li>

                    {{-- Tagihan --}}
                    <li>
                        <a href="{{ route('superadmin-bills') }}" class="waves-effect">
                            <i class="uil-money-withdrawal"></i>
                            <span>@lang('translation.Tagihan')</span>
                        </a>
                    </li>
                    {{-- Pembayaran --}}
                    <li>
                        <a href="{{ route('superadmin-payment') }}" class="waves-effect">
                            <i class="uil-money-withdraw"></i>
                            <span>Pembayaran</span>
                        </a>
                    </li>
                    {{-- Laporan --}}
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="uil-invoice"></i>
                            <span>@lang('translation.Laporan')</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('customer.report') }}">Pelanggan</a></li>
                            <li><a href="{{ route('payment.report') }}">Pembayaran</a></li>
                        </ul>
                    </li>
                    {{-- Pengaturan --}}
                    <li>
                        <a href="{{ route('superadmin.profile') }}" class="waves-effect">
                            <i class="uil-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="waves-effect"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
