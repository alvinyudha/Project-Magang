@extends('layouts.master')
@section('title')
    @lang('translation.Customers')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Data @endslot
        @slot('title') Pelanggan @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div>
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add customers</button> 
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
                                        <th style="width: 120px;">Customer ID</th>
                                        <th>Customer</th>
                                        <th>Group</th>
                                        <th>Identity Card Number</th>
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
                                            <span>William Shipp</span>
                                        </td>
                                        <td>Golongan 1.1</td>
                                        
                                        <td>
                                            35090091000023495
                                        </td>
                                        <td>
                                            <div class="badge bg-pill bg-success-subtle text-success font-size-12">Unisolated</div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck2">
                                                <label class="form-check-label" for="customercheck2"></label>
                                            </div>
                                        </td>
                                        
                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0122</a> </td>
                                        <td>
                                            <span>Joe Hardy</span>
                                        </td>
                                        <td>Golongan 2.2</td>
                                        
                                        <td>
                                            35090091000023495
                                        </td>
                                        <td>
                                            <div class="badge bg-pill bg-success-subtle text-success font-size-12">Unisolated</div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck11">
                                                <label class="form-check-label" for="customercheck11"></label>
                                            </div>
                                        </td>
                                        
                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">#MN0113</a> </td>
                                        <td>
                                            <span>Terry Brown</span>
                                        </td>
                                        <td>Golongan 1.2</td>
                                        
                                        <td>
                                            35090091000023495
                                        </td>
                                        <td>
                                            <div class="badge bg-pill bg-danger-subtle text-danger font-size-12">Isolated</div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
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
