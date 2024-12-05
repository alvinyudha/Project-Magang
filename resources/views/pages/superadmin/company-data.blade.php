@extends('layouts-current.master')
@section('title')
    @lang('translation.Perusahaan')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Data @endslot
        @slot('title') Perusahaan @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                        <img class="card-img img-fluid" src="{{URL::asset('build/assets/images/small/img-2.jpg')}}" alt="Card image">
                    </div><!-- end col-->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                                <strong>PT Tirta Husada</strong>
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>tirtahusada@bussiness.com</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone Number</th>
                                            <td>(0331) 666 777 | 081234567890</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">FAX</th>
                                            <td>(0331) 666 777</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>Gubeng - Surabaya</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Join Date</th>
                                            <td>7 April 2024</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">PIC</th>
                                            <td>Ahmad Syahrir</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div><!-- end card body -->
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row mx-3">
                    <p class="fs-6">
                        Tirta Husada adalah perusahaan PDAM yang berdedikasi untuk menyediakan layanan air bersih berkualitas kepada masyarakat. Dengan pengalaman puluhan tahun, Tirta Husada telah menjadi pilihan utama dalam menyediakan pasokan air yang handal dan aman bagi pelanggan di wilayahnya. Melalui upaya pemeliharaan infrastruktur yang terus-menerus dan inovasi dalam teknologi pengolahan air, perusahaan ini bertujuan untuk memastikan kepuasan pelanggan serta menjaga keberlanjutan lingkungan.
                    </p>
                </div>
                <div class="row mx-3 my-3">
                    <div class="col-md-2">
                        <button type="button" class="btn btn-info btn-sm btn-rounded waves-effect waves-light">Edit Data</button>

                    </div>
                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('build/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
