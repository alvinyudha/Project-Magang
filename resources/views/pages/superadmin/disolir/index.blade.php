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
            Pelanggan Disolir
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Data SuperAdmin</h4> --}}
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pelanggan</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Kategori Tarif</th>
                                <th>No Telepon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($isolate as $i)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $i->customer_code }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->updated_at->format('d-m-Y') }}</td>
                                    <td>{{ $i->tariffGroup->group_name }}</td>
                                    <td>{{ $i->no_telp }}</td>
                                    <td style="color: red">{{ $i->status }}</td>
                                    <td>
                                        <a href="" data-bs-target="#DetailModal{{ $i->id }}"
                                            data-bs-toggle="modal" class="px-3 text-warning"><i
                                                class="uil uil-file-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <div id="DetailModal{{ $i->id }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="DetailModal{{ $i->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DetailModal{{ $i->id }}">Detail
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">ID
                                                        Pelanggan</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="customer_code" id="customer_code"
                                                            value="{{ $i->customer_code }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Tanggal</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="updated_at" id="updated_at"
                                                            value="{{ $i->updated_at->format('d-m-Y') }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Perusahaan</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="name" id="name"
                                                            value="{{ $i->company->name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Kategori
                                                        Tarif</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="group_name" id="group_name"
                                                            value="{{ $i->tariffGroup->group_name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Nama</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="name" id="name"
                                                            value="{{ $i->name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Alamat</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" value="{{ $i->address }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Nomor
                                                        Telepon</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="no_telp" id="no_telp"
                                                            value="{{ $i->no_telp }}"readonly>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
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

{{-- {{ old('company_id') == $company->id_company ? 'selected' : '' }} --}}
