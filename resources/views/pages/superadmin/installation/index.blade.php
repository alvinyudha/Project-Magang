@extends('layouts-current.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Tables
        @endslot
        @slot('title')
            Data Pelanggan
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Data SuperAdmin</h4> --}}
                    <div class="col-sm-10">
                        {{-- <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-3 ms-2"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        Tambah Catat Meter
                    </button> --}}

                    </div>
                    <form action="{{ route('superadmin-search') }}" method="GET">
                        <div class="form">
                            <div class="form-group col-md-6 mb-4 d-flex align-items-center">
                                <input type="text" class="form-control me-2" id="search" name="search"
                                    value="{{ request()->input('search') }}"
                                    placeholder="Masukkan ID atau Nama Pelanggan untuk catat meter" required>
                                <button type="submit" class="btn btn-primary "><i
                                        class="uil uil-tachometer-fast"></i></button>
                            </div>
                            <div class=" col-md-6 ">
                                <button type="button" class="btn btn-success waves-effect waves-light mb-3"
                                    data-bs-toggle="modal" data-bs-target="#myModal">Tambah
                                    Data</button>
                            </div>
                        </div>
                    </form>

                    <form action="" method="post"class="customer">
                        @csrf
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Pelanggan</th>
                                    <th>Nama</th>
                                    <th>No Telepon</th>
                                    <th>Kelompok Tarif</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customer as $c)
                                    <tr>
                                        {{-- <td>
                                            <input type="checkbox" class="customer-checkbox" name="customer_codes[]"
                                                value="{{ $c->customer_code }}">
                                        </td> --}}
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>
                                            {{-- <canvas class="barcode" data-barcode-value="{{ $c->customer_code }}"></canvas> --}}
                                            {{-- {!! DNS1D::getBarcodeHTML("$c->customer_code", 'C93') !!} --}}
                                            {{ $c->customer_code }}
                                        </td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->no_telp }}</td>
                                        <td>{{ $c->tariffgroup->group_name }}</td>
                                        <td style="color: {{ $c->status == 'isolated' ? 'red' : 'lime' }};">
                                            {{ $c->status }}</td>
                                        {{-- <td>{{ $c->created_at->format('d-m-Y') }}</td> --}}
                                        <td>
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#UpdateModal{{ $c->id_customer }}"class="px-3 text-primary"><i
                                                    class="uil uil-pen font-size-18"></i></a>
                                            <a href="" data-bs-target="#delmodal{{ $c->id_customer }}"
                                                data-bs-toggle="modal" class="px-3 text-danger"><i
                                                    class="uil uil-trash-alt font-size-18"></i></a>
                                            <a href="" data-bs-target="#DetailModal{{ $c->id_customer }}"
                                                data-bs-toggle="modal" class="px-3 text-warning"><i
                                                    class="uil uil-file-alt font-size-18"></i></a>
                                            @if ($c->status == 'avaliable')
                                                <a href="" data-bs-target="#isolatedmodal{{ $c->id_customer }}"
                                                    data-bs-toggle="modal" class=" px-3 text-success"><i
                                                        class="uil uil-lock-slash font-size-18"></i></a>
                                            @elseif ($c->status == 'isolated')
                                                <a href="" data-bs-target="#avaliablemodal{{ $c->id_customer }}"
                                                    data-bs-toggle="modal" class=" px-3 "><i
                                                        class="uil uil-lock-slash font-size-18"
                                                        style="color:rgb(166, 0, 255)"></i></a>
                                            @endif

                                        </td>
                                    </tr>
                                    <!--  MODAL avaliable -->
                                    <div id="avaliablemodal{{ $c->id_customer }}"
                                        class="modal fade bs-example-modal-center-modal-sm" tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" data-bs-backdrop="static"
                                        data-bs-keyboard="false" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="avaliablemodal{{ $c->id_customer }}">Sistem
                                                        mengatakan:
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin untuk membuka isolir???
                                                </div>
                                                <form action="{{ route('install.isolated', $c->id_customer) }}"
                                                    method="POST">
                                                    @csrf @method('put')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!--  MODAL isolate -->
                                    <div id="isolatedmodal{{ $c->id_customer }}"
                                        class="modal fade bs-example-modal-center-modal-sm" tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" data-bs-backdrop="static"
                                        data-bs-keyboard="false" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="isolatedmodal{{ $c->id_customer }}">
                                                        Sistem
                                                        mengatakan:
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Yakin untuk melakukan isolir???
                                                </div>
                                                <form action="{{ route('install.isolated', $c->id_customer) }}"
                                                    method="POST">
                                                    @csrf @method('put')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!--  MODAL DELETE -->
                                    <div id="delmodal{{ $c->id_customer }}"
                                        class="modal fade bs-example-modal-center-modal-sm" tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" data-bs-backdrop="static"
                                        data-bs-keyboard="false" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered">
                                            <div class="modal-content ">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="delmodal{{ $c->id_customer }}">Sistem
                                                        mengatakan:
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah kamu yakin???
                                                </div>
                                                <form action="{{ route('install.delete', $c->id_customer) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </div>
                                                </form>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    <!-- Modal UPDATE-->
                                    <div id="UpdateModal{{ $c->id_customer }}" class="modal fade modal-lg"
                                        tabindex="-1" role="dialog" aria-labelledby="UpdateModal{{ $c->id_customer }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="UpdateModal{{ $c->id_customer }}">Update
                                                        Pelanggan
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Tambahkan form untuk tambah user -->
                                                    <form method="POST"
                                                        action="{{ route('install.update', $c->id_customer) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Nama</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="name" id="name"
                                                                    value="{{ $c->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Tarif Kelompok</label>
                                                            <div class="col-md-10">
                                                                <select class="form-select" id="group_id"
                                                                    name="group_id" required>
                                                                    <option value="">Pilih Tariff</option>
                                                                    @foreach ($tariffgroupall as $g)
                                                                        <option value="{{ $g->id }}"
                                                                            {{ $g->id == $c->group_id ? 'selected' : '' }}>
                                                                            {{ $g->group_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">NIK</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" type="number"
                                                                    name="identity_card_number" id="identity_card_number"
                                                                    value="{{ $c->identity_card_number }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Alamat</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="address"
                                                                    id="address"value="{{ $c->address }}"></input>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Nomor Telepon</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="no_telp"
                                                                    id="no_telp"value="{{ $c->no_telp }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Lokasi</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="location"
                                                                    id="location"value="{{ $c->location }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Status Tanah</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="land_status"
                                                                    id="land_status"value="{{ $c->land_status }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Luas Tanah</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="land_area"
                                                                    id="land_area"value="{{ $c->land_area }}">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Luas Bangunan</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="building_area"
                                                                    id="building_area"value="{{ $c->building_area }}"></input>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input"
                                                                class="col-md-2 col-form-label">Nomor Meter</label>
                                                            <div class="col-md-10">
                                                                <input class="form-control" name="meter_number"
                                                                    id="meter_number"value="{{ $c->meter_number }}">
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light waves-effect"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light"
                                                                id="sa-success">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal DETAILS-->
                                    <div id="DetailModal{{ $c->id_customer }}" class="modal fade modal-lg"
                                        tabindex="-1" role="dialog" aria-labelledby="DetailModal{{ $c->id_customer }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="DetailModal{{ $c->id_customer }}">Detail
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Bergabung Sejak</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="created_at" readonly
                                                                id="created_at"value="{{ $c->created_at->format('d M Y') }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nama</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="name" id="name"
                                                                value="{{ $c->name }}"readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Perusahaan</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="name" id="name"
                                                                value="{{ $c->company->name }}"readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Tarif
                                                            Kelompok</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="group_name" readonly
                                                                id="group_name"value="{{ $c->tariffGroup->group_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">NIK</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="identity_card_number"
                                                                id="identity_card_number"
                                                                value="{{ $c->identity_card_number }}"readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Alamat</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="address"
                                                                id="address"value="{{ $c->address }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nomor
                                                            Telepon</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="no_telp"
                                                                id="no_telp"value="{{ $c->no_telp }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Lokasi</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="location"
                                                                id="location"value="{{ $c->location }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Status
                                                            Tanah</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="land_status"
                                                                id="land_status"value="{{ $c->land_status }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Luas
                                                            Tanah</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="land_area"
                                                                id="land_area"value="{{ $c->land_area }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Luas
                                                            Bangunan</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="building_area"
                                                                id="building_area"value="{{ $c->building_area }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nomor
                                                            Meter</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="meter_number" readonly
                                                                id="meter_number"value="{{ $c->meter_number }}">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search Customers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('rmeter.addMeter') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group mb-3 row">
                            <label for="id_customer"
                                class="col-md-4 col-form-label text-md-right">{{ __('Pelanggan') }}</label>

                            <div class="col-md-6">
                                <select id="id_customer" class="form-control @error('id_customer') is-invalid @enderror"
                                    name="id_customer" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($customer as $c)
                                        <option value="{{ $c->id_customer }}"
                                            {{ old('id_customer') == $c->id_customer ? 'selected' : '' }}>
                                            {{ $c->name }}</option>
                                    @endforeach
                                </select>

                                @error('id_customer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="current_meter" class="col-md-4 col-form-label text-md-right">Input Nomor
                                Meter</label>
                            <div class="col-md-6">
                                <input id="current_meter" type="number" step="0.01"
                                    class="form-control @error('current_meter') is-invalid @enderror" name="current_meter"
                                    value="{{ old('current_meter') }}" required>

                                @error('current_meter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <div class="modal fade" id="resultsModal" tabindex="-1" role="dialog" aria-labelledby="resultsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultsModalLabel">Search Results</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">

                        <thead>
                            <tr>
                                <th>Customer Code</th>
                                <th>Name</th>
                                <th>Tariff Group</th>
                                <th>Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $c)
                                <tr>
                                    <td>{{ $c->customer_code }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->tariffGroup->group_name }}</td>
                                    <td>{{ $c->company->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD-->
    <div id="myModal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Pasang Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan form untuk tambah user -->
                    <form method="POST" action="{{ route('install.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Tarif Kelompok</label>
                            <div class="col-md-10">
                                <select class="form-select" id="group_id" name="group_id" required>
                                    <option value="">Select Tariff</option>
                                    @foreach ($tariffgroupall as $g)
                                        <option value="{{ $g->id }}">
                                            {{ $g->group_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">NIK</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="identity_card_number"
                                    id="identity_card_number">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Alamat</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="no_telp" id="no_telp">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Lokasi</label>
                            <div class="col-md-10">
                                <input class="form-control" name="location" id="location">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Status Tanah</label>
                            <div class="col-md-10">
                                <input class="form-control" name="land_status" id="land_status">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Luas Tanah</label>
                            <div class="col-md-10">
                                <input class="form-control" name="land_area" id="land_area">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Luas Bangunan</label>
                            <div class="col-md-10">
                                <input class="form-control" name="building_area" id="building_area"></input>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nomor Meter</label>
                            <div class="col-md-10">
                                <input class="form-control" name="meter_number" id="meter_number">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                id="sa-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#searchForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('superadmin-install', ['modal' => true]) }}',
                type: 'GET',
                data: $(this).serialize(),
                success: function(data) {
                    $('#searchResultsModal .modal-body').html(data);
                    $('#searchResultsModal').modal('show');
                }
            });
        });
    </script>



    <script>
        function printBarcode(url) {
            if ($('input:checked').length < 1) {
                alert('Pilih data yang akan dicetak');
                return;
            } else {
                $('.customer')
                    .attr('target', '_blank')
                    .attr('action', url)
                    .submit();
            }
        }
    </script>
    <script>
        // Mendapatkan referensi elemen checkbox "Select All" dan checkbox pelanggan
        const selectAllCheckbox = document.querySelector('#select-all-checkbox');
        const customerCheckboxes = document.querySelectorAll('.customer-checkbox');

        // Tambahkan event listener pada checkbox "Select All"
        selectAllCheckbox.addEventListener('change', function() {
            // Atur status checked dari semua checkbox pelanggan sesuai dengan status checkbox "Select All"
            customerCheckboxes.forEach(function(checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });

        // Tambahkan event listener pada setiap checkbox pelanggan
        customerCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Cek apakah semua checkbox pelanggan tercentang, jika ya, centang checkbox "Select All" juga
                const allChecked = Array.from(customerCheckboxes).every(function(checkbox) {
                    return checkbox.checked;
                });

                selectAllCheckbox.checked = allChecked;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ URL::asset('build/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/datatables.init.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ URL::asset('build/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        //Warning Message
        $('#sa-warning').click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(function(result) {
                if (result.value) {
                    Swal.fire("Deleted!", "Your file has been deleted.", "success");
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire('{{ $message }}')
        </script>
    @endif
    @if ($message = Session::get('failed'))
        <script>
            Swal.fire('{{ $message }}')
        </script>
    @endif
@endsection

{{-- @foreach ($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->total }}</td>
        <td>{{ $order->status }}</td>
        <td>
            <a href="#" data-toggle="modal" data-target="#statusModal-{{ $order->id }}"
                class="btn btn-{{ $order->status == 'paid' ? 'danger' : 'success' }}">
                {{ $order->status == 'paid' ? 'Ubah ke Unpaid' : 'Ubah ke Paid' }}
            </a>

            <!-- Modal -->
            <div class="modal fade" id="statusModal-{{ $order->id }}" tabindex="-1" role="dialog"
                aria-labelledby="statusModalLabel-{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="statusModalLabel-{{ $order->id }}">Ubah Status Order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin mengubah status order ini menjadi
                            {{ $order->status == 'paid' ? 'Unpaid' : 'Paid' }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <form action="{{ route('orders.update-status', $order->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="btn btn-{{ $order->status == 'paid' ? 'danger' : 'success' }}">
                                    {{ $order->status == 'paid' ? 'Ubah ke Unpaid' : 'Ubah ke Paid' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach --}}
