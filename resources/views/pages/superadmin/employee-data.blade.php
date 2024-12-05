@extends('layouts-current.master')
@section('title')
    @lang('translation.Karyawan')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Data @endslot
        @slot('title') Karyawan @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div>
                            <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i>Tambah Pelanggan</button> 
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
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NIP</th>
                                        <th>Nomor Telepon</th>
                                        <th>Level</th>
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
                                        
                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">1</a> </td>
                                        <td>
                                            <span>Aji Sudarmaji</span>
                                        </td>
                                        <td>sudarmaji@gmail.com</td>
                                        
                                        <td>
                                            MN0123
                                        </td>
                                        <td>
                                            <div>081234567890</div>
                                        </td>
                                        <td>
                                            Admin
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck1">
                                                <label class="form-check-label" for="customercheck1"></label>
                                            </div>
                                        </td>
                                        
                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">2</a> </td>
                                        <td>
                                            <span>Abi Dardak</span>
                                        </td>
                                        <td>dardak@gmail.com</td>
                                        
                                        <td>
                                            MN0123
                                        </td>
                                        <td>
                                            <div>081234567890</div>
                                        </td>
                                        <td>
                                            Petugas
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check text-center">
                                                <input type="checkbox" class="form-check-input" id="customercheck1">
                                                <label class="form-check-label" for="customercheck1"></label>
                                            </div>
                                        </td>
                                        
                                        <td><a href="javascript: void(0);" class="text-reset  fw-bold">3</a> </td>
                                        <td>
                                            <span>Abu Sufyan</span>
                                        </td>
                                        <td>sufyan@gmail.com</td>
                                        
                                        <td>
                                            MN0123
                                        </td>
                                        <td>
                                            <div>081234567890</div>
                                        </td>
                                        <td>
                                            Petugas
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
