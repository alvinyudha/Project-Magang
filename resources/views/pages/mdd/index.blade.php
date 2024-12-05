@extends('layouts-current.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            MWater
        @endslot
        @slot('title')
            MDD Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                    </div>
                    <div>
                        <?php
                        $sadmin = \App\Models\User::count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $sadmin; ?></span></h4>
                        <p class="text-muted mb-0">Super Admin</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                    </div>
                    <div>
                        <?php
                        $companyCount = \App\Models\Company::count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $companyCount; ?></span></h4>
                        <p class="text-muted mb-0">BUMDES</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">32</span></h4>
                        <p class="text-muted mb-0">Staff Admin</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">

            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="growth-chart" data-colors='["--bs-danger"]'></div>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">42</span></h4>
                        <p class="text-muted mb-0">Staff Petugas</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">Sort By:</span> <span class="text-muted">Tahunan<i
                                        class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item" href="#">Bulanan</a>
                                <a class="dropdown-item" href="#">Tahunan</a>
                                <a class="dropdown-item" href="#">Harian</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Laporan Bulanan</h4>

                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary">Rp.<span data-plugin="counterup">25,000,000,000</span><span
                                        class="text-muted d-inline-block font-size-15 ms-3">Pendapatan</span></h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h3><span data-plugin="counterup">258</span><span
                                        class="text-muted d-inline-block font-size-15 ms-3">Pelanggan</span>
                                </h3>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <div id="sales-analytics-chart" data-colors='["--bs-primary", "#dfe2e6", "--bs-warning"]'
                            class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Aktivitas Pengguna</h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aktivitas Terakhir</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>A423E5</td>
                                <td>Adi Budiono</td>
                                <td>
                                    <span class="badge rounded-pill bg-danger text-dark font-size-12">Off</span>
                                </td>
                                <td><i>3 jam yang lalu</i></td>
                            </tr>
                            <tr>
                                <td>A423E1</td>
                                <td>Budi Santoso</td>
                                <td>
                                    <span class="badge rounded-pill bg-success text-dark font-size-12">Aktif</span>
                                </td>
                                <td><i>3 menit yang lalu</i></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end Col -->
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ingatkan Pembayaran</h4>
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Tgl Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Terlambat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#MB2540</a> </td>
                                    <td>Sumber Tirta</td>
                                    <td>
                                        7 Maret 2024
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-success text-dark font-size-12">Selesai Bayar</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning text-dark font-size-12">15 Maret
                                            2024</span>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            kirim invoice
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input type="checkbox" class="form-check-input" id="customCheck2">
                                            <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#MB4540</a> </td>
                                    <td>Segara Makmur</td>
                                    <td>
                                        <i>menunggu pembayaran</i>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-danger text-dark font-size-12">Belum bayar</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-warning text-dark font-size-12">15 Maret
                                            2024</span>
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            kirim invoice
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                    <!-- Varying Modal Content example -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Kelik alasan penolakan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="mb-3">
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Kirim pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/assets/js/pages/dashboard.init.js') }}"></script>

    {{-- Data Table --}}
    <script src="{{ URL::asset('build/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/datatables.init.js') }}"></script>

    <!-- Sweet Alert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if (session()->has('toast_true'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ 'Signed in successfully' }}'
                });
            @endif
        });
    </script>
@endsection
