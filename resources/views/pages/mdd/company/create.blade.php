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
        @slot('title') Perusahaan @endslot
    @endcomponent


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                    <h4 class="card-title mb-4">Buat Akun Perusahaan</h4>
                    
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">Nama Perusahaan</label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" id="example-text-input" placeholder="type name here">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-tel-input" class="col-md-2 col-form-label">Nomor Telepon</label>
                        <div class="col-md-10">
                            <input class="form-control" type="tel" placeholder="+62 ... ..." id="example-tel-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-fax-input" class="col-md-2 col-form-label">Faximile</label>
                        <div class="col-md-10">
                            <input class="form-control" type="tel" placeholder=" ... ..." id="example-fax-input">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="example-datetime-local-input" class="col-md-2 col-form-label">Bergabung Sejak</label>
                        <div class="col-md-10">
                            <input class="form-control" type="datetime-local" id="example-datetime-local-input">
                        </div>
                    </div>
                    <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <div>
                                <textarea required="" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    <div class="mb-3 row">
                        <label class="col-md-2 col-form-label">Select</label>
                        <div class="col-md-10">
                            <select class="form-select">
                                <option>Select</option>
                                <option>Large select</option>
                                <option>Small select</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="exampleDataList" class="col-md-2 col-form-label">Datalists</label>
                        <div class="col-md-10">
                            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                <option value="San Francisco">
                                </option><option value="New York">
                                </option><option value="Seattle">
                                </option><option value="Los Angeles">
                                </option><option value="Chicago">
                            </option></datalist>
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


