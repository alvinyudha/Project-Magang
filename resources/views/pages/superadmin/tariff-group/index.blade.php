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
            Kategori Tarif
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Data SuperAdmin</h4> --}}
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-3"
                            data-bs-toggle="modal" data-bs-target="#myModal"><i class="mdi mdi-plus me-1"></i>Tambah
                            Data</button>
                        <button type="button" class="btn btn-warning btn-rounded waves-effect waves-light mb-3 ms-2"
                            data-bs-toggle="modal" data-bs-target="#bea">
                            Atur Bea Admin
                        </button>
                    </div>


                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Tarif</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($tariff_category as $t)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $t->group_name }}</td>
                                    <td>{{ $t->tariff }}</td>
                                    <td>{{ $t->desc }}</td>
                                    <td>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#UpdateModal{{ $t->id }}"class="px-3 text-primary"><i
                                                class="uil uil-pen font-size-18"></i></a>
                                        <a href="" data-bs-target="#delmodal{{ $t->id }}"
                                            data-bs-toggle="modal" class="px-3 text-danger"><i
                                                class="uil uil-trash-alt font-size-18"></i></a>
                                        {{-- <a href="" data-bs-target="#DetailModal{{ $e->id_employee }}"
                                            data-bs-toggle="modal" class="px-3 text-warning"><i
                                                class="uil uil-file-alt font-size-18"></i></a> --}}
                                    </td>
                                </tr>
                                <!--  MODAL DELETE -->
                                <div id="delmodal{{ $t->id }}" class="modal fade bs-example-modal-center-modal-sm"
                                    tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delmodal{{ $t->id }}">The system
                                                    say:
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are u sure???
                                            </div>
                                            <form action="{{ route('tariffs.delete', $t->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-dismiss="modal">Nope</button>
                                                    <button type="submit" class="btn btn-danger">Do it</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>

                                <!-- Modal UPDATE-->
                                <div id="UpdateModal{{ $t->id }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="UpdateModal{{ $t->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UpdateModal{{ $t->id }}">Update User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tambahkan form untuk tambah user -->
                                                <form method="POST" action="{{ route('tariff.update', $t->id) }}">
                                                    @csrf
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Kategori</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="group_name" id="group_name"
                                                                value="{{ $t->group_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Tarif</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="tariff" id="tariff"
                                                                value="{{ $t->tariff }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Deskripsi</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="desc" id="desc"
                                                                value="{{ $t->desc }}">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-primary waves-effect waves-light"
                                                            id="sa-success">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal DETAILS-->
                                {{-- <div id="DetailModal{{ $c->id_customer }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="DetailModal{{ $c->id_customer }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DetailModal{{ $c->id_customer }}">Details
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="">
                                                    <img class="card-img-top" src="..." alt="Card image cap">
                                                    <div class="card-body">
                                                        <p class="card-text">Some quick example text to build on the card
                                                            title and make up the bulk of the card's content.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Modal ADD-->
    <div id="myModal" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan form untuk tambah user -->
                    <form method="POST" action="{{ route('tariff.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Kategori</label>
                            <div class="col-md-10">
                                <input class="form-control" name="group_name" id="group_name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Tarif</label>
                            <div class="col-md-10">
                                <input class="form-control" name="tariff" id="tariff" required type="number">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <input class="form-control" name="desc" id="desc" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" id="sa-success">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal BEA-->
    @foreach ($companies as $company)
        <div id="bea{{ $company->id }}" class="modal fade modal-sm" tabindex="-1" role="dialog"
            aria-labelledby="beaLabel{{ $company->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="beaLabel{{ $company->id }}">Bea Administrasi -
                            {{ $company->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Tambahkan form untuk tambah user -->
                        <form method="POST" action="{{ route('company.storebea') }}">
                            @csrf
                            <input type="hidden" name="company_id" value="{{ $company->id_company }}">
                            <div class="mb-3 row">
                                <label for="retribution{{ $company->id_company }}"
                                    class="col-md-3 col-form-label">Retribusi</label>
                                <div class="col-md-7">
                                    <input class="form-control" type="number" name="retribution"
                                        id="retribution{{ $company->id_company }}" value="{{ $company->retribution }}"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="fines{{ $company->id_company }}"
                                    class="col-md-3 col-form-label">Denda</label>
                                <div class="col-md-7">
                                    <input class="form-control" type="number" name="fines"
                                        id="fines{{ $company->id_company }}" value="{{ $company->fines }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light waves-effect"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                    id="sa-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
