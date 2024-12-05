@extends('layouts-current.master')
@section('title')
    @lang('Pelanggan_Diisolir')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Data @endslot
        @slot('title') Pelanggan Diisolir @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div>
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Tambah Data</button> 
                        </div>

                        <div class="table-responsive mb-4">
                            <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; width: 100%;">
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
                                        <th>Tgl Isolir</th>
                                        <th>Status</th>
                                        <th style="width: 120px;">Action</th>
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
                                            <span>Jono Bakrie</span>
                                        </td>
                                        <td>22 Februari 2024</td>
                                        
                                        <td>
                                            <div class="badge bg-pill bg-warning-subtle text-white font-size-12">Proses Penyegelan</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">
                                                Lihat Detail
                                            </button>
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
                                            <span>William Shipp</span>
                                        </td>
                                        <td>22 Februari 2024</td>
                                        
                                        <td>
                                            <div class="badge bg-pill bg-success-subtle text-success font-size-12">Completed Sealing</div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
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
