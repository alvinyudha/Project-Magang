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
        @slot('pagetitle') Minible @endslot
        @slot('title') Dashboard @endslot
    @endcomponent

<div class="row">
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="float-end mt-2">
                    <div id="total-revenue-chart" data-colors='["--bs-primary"]'></div>
                </div>
                <div>
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">20</span></h4>
                    <p class="text-muted mb-0">Tariff Group</p>
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
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">500</span></h4>
                    <p class="text-muted mb-0">Customer Count</p>
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
                    <h4 class="mb-1 mt-1"><span data-plugin="counterup">27</span></h4>
                    <p class="text-muted mb-0">New Install</p>
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
                    <h4 class="mb-1 mt-1">+ <span data-plugin="counterup">5</span></h4>
                    <p class="text-muted mb-0">Isolated Customer</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold">Sort By:</span> <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                            <a class="dropdown-item" href="#">Monthly</a>
                            <a class="dropdown-item" href="#">Yearly</a>
                            <a class="dropdown-item" href="#">Weekly</a>
                        </div>
                    </div>
                </div>
                <h4 class="card-title mb-4">Revenue Graph</h4>

                <div class="mt-1">
                    <ul class="list-inline main-chart mb-0">
                        <li class="list-inline-item chart-border-left me-0 border-0">
                            <h3 class="text-primary">Rp.<span data-plugin="counterup">25,000,000</span><span class="text-muted d-inline-block font-size-15 ms-3">Income</span></h3>
                        </li>
                        <li class="list-inline-item chart-border-left me-0">
                            <h3><span data-plugin="counterup">258</span><span class="text-muted d-inline-block font-size-15 ms-3">Customer</span>
                            </h3>
                        </li>
                    </ul>
                </div>

                <div class="mt-3">
                    <div id="sales-analytics-chart" data-colors='["--bs-primary", "#dfe2e6", "--bs-warning"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Payment Status</h4>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Bill Amount</th>
                            <th>Periode</th>
                            <th>Fines</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Rp. 320.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Kartolo</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Junaedi</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Taufiq</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Habibul Karim</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Bambang</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Budi Santoso</td>
                            <td>Rp. 30.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Detail</button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light">Isolated</button>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end Col -->
</div> <!-- end row-->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">List of Customers Isolated</h4>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Bill Amount</th>
                            <th>Fines</th>
                            <th>Detail</th>
                        </tr>
                    </thead>


                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Rp. 320.000</td>
                            <td>Februari 2024</td>
                            <td>Rp. 0</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end Col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Complaint</h4>
                
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Location</th>
                            <th>Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>A423E1</td>
                            <td>Budi Santoso</td>
                            <td>Tegalwaringin Gg. 2</td>
                            <td>
                                <span class="badge rounded-pill bg-success text-dark font-size-12">Done</span>
                            </td>
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
                <h4 class="card-title mb-4">Meter Record Verification</h4>
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
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Start Meter Number</th>
                                <th>Last Meter Number</th>
                                <th>Usage Amount</th>
                                <th>Meter Photos</th>
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
                                <td>Neal Matthews</td>
                                <td>
                                    230
                                </td>
                                <td>
                                    280
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-dark text-warning font-size-12">50</span>
                                </td>
                                <td>
                                    ---
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-rounded waves-effect waves-light">
                                        approved
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        reject
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
                                <td><a href="javascript: void(0);" class="text-body fw-bold">#MB2540</a> </td>
                                <td>Roenald Koeman</td>
                                <td>
                                    230
                                </td>
                                <td>
                                    275
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-dark text-warning font-size-12">45</span>
                                </td>
                                <td>
                                    ---
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm btn-rounded waves-effect waves-light">
                                        approved
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        reject
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->
                <!-- Varying Modal Content example -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Type Reason for Rejection</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="mb-3">
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Send message</button>
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
@endsection


