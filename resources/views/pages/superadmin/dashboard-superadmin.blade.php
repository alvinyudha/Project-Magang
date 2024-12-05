@extends('layouts-current.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('css')
    <style>
        .card {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }
    </style>
    <!-- DataTables -->
    <link href="{{ URL::asset('build/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            MWater
        @endslot
        @slot('title')
            <?php
            $companyId = Auth::user()->company_id;
            $company = \App\Models\Company::find($companyId);
            $companyName = strtoupper($company->name);
            ?>
            <?php echo $companyName; ?>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card" onclick="window.location.href = '{{ route('superadmin-complaint') }}'">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                    </div>
                    <div>
                        <?php
                        $userId = Auth::user()->id;
                        $complaint = \App\Models\Complaint::where('user_id', $userId)->count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $complaint; ?></span></h4>
                        <p class="text-muted mb-0">Pengaduan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card" onclick="window.location.href = '{{ route('superadmin-customer') }}'">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="orders-chart" data-colors='["--bs-success"]'> </div>
                    </div>
                    <div>
                        <?php
                        $userId = Auth::user()->id;
                        $customer = \App\Models\Customer::where('user_id', $userId)->count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $customer; ?></span></h4>
                        <p class="text-muted mb-0">Pelanggan</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card" onclick="window.location.href = '{{ route('superadmin-bills') }}'">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="customers-chart" data-colors='["--bs-primary"]'> </div>
                    </div>
                    <div>
                        <?php
                        $userId = Auth::user()->id;
                        $bill = \App\Models\Bill::where('user_id', $userId)->count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $bill; ?></span></h4>
                        <p class="text-muted mb-0">Tagihan</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">

            <div class="card" onclick="window.location.href = '{{ route('superadmin-isolate') }}'">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="growth-chart" data-colors='["--bs-danger"]'></div>
                    </div>
                    <div>
                        <?php
                        $userId = Auth::user()->id;
                        $isolate = \App\Models\Customer::where('user_id', $userId)->where('status', 'isolated')->count();
                        ?>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup"><?php echo $isolate; ?></span></h4>
                        <p class="text-muted mb-0">Pelanggan Diisolir</p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->
    </div> <!-- end row-->

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold">Berdasarkan:</span> <span class="text-muted">Tahunan<i
                                        class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item" href="#">Bulanan</a>
                                <a class="dropdown-item" href="#">Tahunan</a>
                                <a class="dropdown-item" href="#">Mingguan</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Grafik Pendapatan</h4>
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <?php
                                $totalIncome = \App\Models\Payment::sum('total_payment');
                                ?>
                                <h3 class="text-primary">Rp.<span data-plugin="counterup"><?php echo number_format($totalIncome, 0, ',', '.'); ?></span>
                                    <span class="text-muted d-inline-block font-size-15 ms-3">Income</span>
                                </h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <?php
                                $userId = Auth::user()->id;
                                $customer = \App\Models\Customer::where('user_id', $userId)->count();
                                ?>
                                <h3><span data-plugin="counterup">
                                        <?php echo $customer; ?>
                                    </span><span class="text-muted d-inline-block font-size-15 ms-3">Pelanggan</span>
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
    </div> <!-- end row--> --}}

    <br>

    <?php
    $userId = Auth::user()->id;
    
    $billData = \App\Models\Bill::select('total_bill', 'created_at')->where('user_id', $userId);
    $paymentData = \App\Models\Payment::select('total_payment', 'created_at')->where('user_id', $userId);
    $customerData = \App\Models\Customer::select('created_at')->where('user_id', $userId);
    
    // Filter data berdasarkan tahun dan bulan jika ada parameter di URL
    if (request()->has('year') && request()->has('month')) {
        $billData = $billData->whereYear('created_at', request()->input('year'))->whereMonth('created_at', request()->input('month'));
        $paymentData = $paymentData->whereYear('created_at', request()->input('year'))->whereMonth('created_at', request()->input('month'));
        $customerData = $customerData->whereYear('created_at', request()->input('year'))->whereMonth('created_at', request()->input('month'));
    }
    
    $billData = $billData->get();
    $paymentData = $paymentData->get();
    $customerData = $customerData->get();
    
    // Persiapkan data untuk diagram grafik
    $labels = [];
    $billDataPoints = [];
    $paymentDataPoints = [];
    $customerDataPoints = [];
    
    foreach ($billData as $bill) {
        $labels[] = date('M d', strtotime($bill->created_at));
        $billDataPoints[] = $bill->total_bill;
    }
    
    foreach ($paymentData as $payment) {
        $labels[] = date('M d', strtotime($payment->created_at));
        $paymentDataPoints[] = $payment->total_payment;
    }
    
    foreach ($customerData as $customer) {
        $monthYear = date('M d', strtotime($customer->created_at));
        if (!isset($customerCountByMonth[$monthYear])) {
            $customerCountByMonth[$monthYear] = 0;
        }
        $customerCountByMonth[$monthYear]++;
    }
    
    // Mengisi $customerDataPoints berdasarkan $customerCountByMonth
    foreach ($labels as $label) {
        $monthYear = date('M d', strtotime(str_replace('M ', '', $label)));
        if (isset($customerCountByMonth[$monthYear])) {
            $customerDataPoints[] = $customerCountByMonth[$monthYear];
        } else {
            $customerDataPoints[] = 0;
        }
    }
    ?>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Year
                </button>
                <ul class="dropdown-menu">
                    <?php for ($i = 2018; $i <= date('Y'); $i++) { ?>
                    <li><a class="dropdown-item"
                            href="?year=<?php echo $i; ?>&month=<?php echo request()->input('month', date('m')); ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                </ul>
                <input type="text" class="form-control" id="year" name="year"
                    value="<?php echo request()->input('year', date('Y')); ?>"readonly>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Month
                </button>
                <ul class="dropdown-menu">
                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                    <li><a class="dropdown-item"
                            href="?year=<?php echo request()->input('year', date('Y')); ?>&month=<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>"><?php echo date('F', mktime(0, 0, 0, $i, 1, date('Y'))); ?></a></li>
                    <?php } ?>
                </ul>
                <input type="text" class="form-control" id="month" name="month"
                    value="<?php echo request()->input('month', date('m')); ?>"readonly>
            </div>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="?" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <canvas id="myChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Tagihan',
                    data: <?php echo json_encode($billDataPoints); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Pembayaran',
                    data: <?php echo json_encode($paymentDataPoints); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Pelanggan',
                    data: <?php echo json_encode($customerDataPoints); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            }

        });
    </script>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Bill Summary</h4>
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary">Rp.<span data-plugin="counterup"><?php echo number_format(\App\Models\Bill::where('user_id', $userId)->sum('total_bill')); ?></span>
                                    <span class="text-muted d-inline-block font-size-15 ms-3">Income</span>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Payment Summary</h4>
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary">Rp.<span data-plugin="counterup"><?php echo number_format(\App\Models\Payment::where('user_id', $userId)->sum('total_payment')); ?></span>
                                    <span class="text-muted d-inline-block font-size-15 ms-3">Income</span>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Customer Summary</h4>
                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3 class="text-primary"><span data-plugin="counterup"><?php echo \App\Models\Customer::where('user_id', $userId)->count(); ?></span>
                                    <span class="text-muted d-inline-block font-size-15 ms-3">Total Pelanggan</span>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card" onclick="window.location.href = '{{ route('superadmin-complaint') }}'">
                <div class="card-body">

                    <h4 class="card-title">Pengaduan</h4>
                    <table id="datatable3" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $logUser = auth()->user();
                            $complaint = \App\Models\Complaint::where('user_id', $logUser->id)->get();
                            $user = \App\Models\Complaint::with('officers')->get();
                            ?>
                            @foreach ($complaint as $c)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $c->officers->name }}</td>
                                    <td>{{ $c->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $c->tittle }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end Col -->

    <div class="row">
        <div class="col-12">
            <div class="card" onclick="window.location.href = '{{ route('superadmin-rmeter') }}'">
                <div class="card-body">
                    <h4 class="card-title">Catat Meter</h4>

                    <table id="datatable2" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Meteran Terakhir</th>
                                <th>Meteran Saat Ini</th>
                                <th>Foto Meteran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $user = auth()->user();
                            $rmeter = \App\Models\RecordMeter::where('user_id', $user->id)->get();
                            $customer = \App\Models\RecordMeter::with('customer')->get();
                            ?>
                            @foreach ($rmeter as $rm)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $rm->customer->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($rm->date)->format('d-m-Y') }}</td>
                                    <td>{{ $rm->last_meter }}</td>
                                    <td>{{ $rm->current_meter }}</td>
                                    <td>{{ $rm->meter_photos }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="row">
            <div class="col-12">
                <div class="card" onclick="window.location.href = '{{ route('superadmin-bills') }}'">
                    <div class="card-body">

                        <h4 class="card-title">Tagihan</h4>
                        <table id="datatable4" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah Pemakaian</th>
                                    <th>Meteran Terakhir</th>
                                    <th>Meteran Saat ini</th>
                                    <th>Total Tagihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $userID = auth()->user()->id;
                                $bill = DB::table('bills')->join('record_meters', 'record_meters.id', '=', 'bills.record_meter_id')->join('customers', 'customers.id_customer', '=', 'bills.customer_id')->select('record_meters.current_meter AS current_meters', 'record_meters.last_meter AS last_meters', 'customers.name AS name', 'bills.*')->where('bills.user_id', '=', $userID)->get();
                                ?>
                                @foreach ($bill as $b)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $b->name }}</td>
                                        {{-- <td>{{ $b->created_at->format('d-m-Y') }}</td> --}}
                                        <td>{{ $b->usage_amount }}</td>
                                        <td>{{ $b->last_meters }}</td>
                                        <td>{{ $b->current_meters }}</td>
                                        <td>{{ $b->total_bill }}</td>
                                        <td style="color: {{ $b->status == 'unpaid' ? 'yellow' : 'lime' }};">
                                            {{ $b->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card" onclick="window.location.href = '{{ route('superadmin-payment') }}'">
                    <div class="card-body">
                        <h4 class="card-title">Pembayaran</h4>
                        <table id="datatable5" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tarif Grup</th>
                                    <th>Meteran Terakhir</th>
                                    <th>Meteran Saat ini</th>
                                    <th>Jumlah Pemakaian</th>
                                    <th>Total Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $userID = auth()->user()->id;
                                $pay = DB::table('payments')->where('payments.user_id', '=', $userID)->get();
                                ?>
                                @foreach ($pay as $p)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->group_name }}</td>
                                        <td>{{ $p->last_meter }}</td>
                                        <td>{{ $p->current_meter }}</td>
                                        <td>{{ $p->usage_amount }}</td>
                                        <td>Rp. {{ $p->total_payment }}</td>
                                        <td>{{ $p->payment_date }}</td>
                                        <td style="color: {{ $p->status == 'unpaid' ? 'yellow' : 'lime' }};">
                                            {{ $p->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>

    <!-- end row -->
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/assets/js/pages/dashboard.init.js') }}"></script>

    {{-- Data Table --}}
    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datatable3').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datatable4').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#datatable5').DataTable();
        });
    </script>
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
