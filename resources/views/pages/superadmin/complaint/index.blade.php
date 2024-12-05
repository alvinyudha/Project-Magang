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
            Pengaduan
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
                                <th>Nama Petugas</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($complaint as $c)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $c->officers->name }}</td>
                                    <td>{{ $c->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $c->tittle }}</td>
                                    <td>
                                        <a href="" data-bs-target="#DetailModal{{ $c->id_complaint }}"
                                            data-bs-toggle="modal" class="px-3 text-warning"><i
                                                class="uil uil-file-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <div id="DetailModal{{ $c->id_complaint }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="DetailModal{{ $c->id_complaint }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DetailModal{{ $c->id_complaint }}">Detail
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Petugas</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="name" id="name"
                                                            value="{{ $c->officers->name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Tanggal</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="created_at" id="created_at"
                                                            value="{{ $c->created_at->format('d-m-Y') }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Judul</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="tittle" id="tittle"
                                                            value="{{ $c->tittle }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Deskripsi</label>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" name="describe"
                                                            id="describe" value="{{ $c->describe }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Foto</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="photo" id="photo"
                                                            value="{{ $c->photo }}"readonly>
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
