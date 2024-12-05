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
        @slot('pagetitle')
            Data
        @endslot
        @slot('title')
            Perusahaan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end align-items-center">
                    <button type="button" class="btn-close mt-2 me-5 col-sm-2" aria-label="Close"
                        onclick="history.back()"></button>
                </div>
                <div class="row g-0 align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('image-company/' . $company->pict) }}" alt="card-image" width="400">
                    </div><!-- end col-->
                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title">
                                <strong> {{ $company->name }} </strong>
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>{{ $company->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{ $company->address }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone Number</th>
                                            <td>{{ $company->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">FAX</th>
                                            <td>{{ $company->fax }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Join Date</th>
                                            <td> Since : {{ $company->created_at->format('l, d F Y') }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- end card body -->
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="row mx-3">
                    <p class="fs-6">
                        Tirta Husada adalah perusahaan PDAM yang berdedikasi untuk menyediakan layanan air bersih
                        berkualitas kepada masyarakat. Dengan pengalaman puluhan tahun, Tirta Husada telah menjadi pilihan
                        utama dalam menyediakan pasokan air yang handal dan aman bagi pelanggan di wilayahnya. Melalui upaya
                        pemeliharaan infrastruktur yang terus-menerus dan inovasi dalam teknologi pengolahan air, perusahaan
                        ini bertujuan untuk memastikan kepuasan pelanggan serta menjaga keberlanjutan lingkungan.
                    </p>
                </div>
                <div class="card-footer">
                    <div class="row text-center mt-2 my-4 justify-content-center">
                        <div class="col-sm-2">
                            <button type="button" data-bs-target="#UpdateModal{{ $company->id_company }}"
                                data-bs-toggle="modal" class="btn btn-primary waves-effect waves-light mt-2 me-2"><i
                                    class="uil uil-pen me-2"></i>Edit
                                Data</button>
                        </div>
                    </div>

                </div>
            </div><!-- end card -->
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <!-- Modal UPDATE-->
    <div id="UpdateModal{{ $company->id_company }}" class="modal fade modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="UpdateModal{{ $company->id_company }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UpdateModal{{ $company->id_company }}">Update User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan form untuk tambah user -->
                    <form method="POST" action="{{ route('company.update', $company->id_company) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" name="name" id="name" value="{{ $company->name }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Address</label>
                            <div class="col-md-10">
                                <input class="form-control" name="address" id="address" value="{{ $company->address }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" name="email" id="email"value="{{ $company->email }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Fax</label>
                            <div class="col-md-10">
                                <input class="form-control" name="fax" id="fax" value="{{ $company->fax }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Photo</label>
                            <div class="col-md-10">
                                @if ($company->pict)
                                    <img src="{{ asset('storage/photo-company/' . $company->pict) }}" alt="Company Picture"
                                        style="width: 200px;">
                                @endif
                                <input class="form-control" id="pict" type="file" name="pict">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input class="form-control" name="no_telp" id="no_telp"
                                    value="{{ $company->no_telp }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="sa-success">Tutup
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
