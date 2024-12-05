@extends('layouts-current.master')
@section('title')
    @lang('translation.Tagihan')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Data
        @endslot
        @slot('title')
            Tagihan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="table-responsive mb-4">
                            <table class="table table-centered datatable dt-responsive nowrap table-card-list"
                                style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck">
                                                <label class="form-check-label" for="customercheck"></label>
                                            </div>
                                        </th>
                                        <th style="width: 120px;">ID Pelanggan</th>
                                        <th>Pelanggan</th>
                                        <th>Tgl Pembayaran</th>
                                        <th>Meter Awal</th>
                                        <th>Meter Akhir</th>
                                        <th>Jumlah Pemakaian</th>
                                        <th>Pembayaran</th>
                                        <th>Tagihan</th>
                                        <th>Denda</th>
                                        <th>Retribusi</th>
                                        <th>Petugas</th>
                                        <th style="width: 120px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck1">
                                                <label class="form-check-label" for="customercheck1"></label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0123</a> </td>
                                        <td>
                                            <span>Subianto</span>
                                        </td>
                                        <td>22 Februari 2024</td>
                                        <td>230</td>
                                        <td>280</td>
                                        <td>
                                            <span class="badge rounded-pill bg-dark text-warning font-size-12">50</span>
                                        </td>
                                        <td>
                                            <i class="fas fa-money-bill"></i> Cash
                                        </td>
                                        <td>Rp. 350.000</td>
                                        <td>Rp. 5000</td>
                                        <td>Rp. 5000</td>
                                        <td>Yanto</td>
                                        <td>
                                            <span class="badge rounded-pill bg-danger text-dark font-size-12">Unpaid</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck1">
                                                <label class="form-check-label" for="customercheck1"></label>
                                            </div>
                                        </td>

                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0123</a> </td>
                                        <td>
                                            <span>Rizky Pradana</span>
                                        </td>
                                        <td>22 Februari 2024</td>
                                        <td>230</td>
                                        <td>280</td>
                                        <td>
                                            <span class="badge rounded-pill bg-dark text-warning font-size-12">50</span>
                                        </td>
                                        <td>
                                            <i class="fas fa-credit-card"></i> Transfer
                                        </td>
                                        <td>Rp. 350.000</td>
                                        <td>Rp. 0</td>
                                        <td>Rp. 5000</td>
                                        <td>Karyadi</td>
                                        <td>
                                            <span class="badge rounded-pill bg-success text-dark font-size-12">Paid</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
