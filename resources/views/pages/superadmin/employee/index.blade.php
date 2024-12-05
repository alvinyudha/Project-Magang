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
            Data Petugas
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
                    </div>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($employee as $e)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $e->name }}</td>
                                    <td>{{ $e->email }}</td>
                                    <td>{{ $e->address }}</td>
                                    <td>{{ $e->no_telp }}</td>
                                    <td>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#UpdateModal{{ $e->id }}"class="px-3 text-primary"><i
                                                class="uil uil-pen font-size-18"></i></a>
                                        <a href="" data-bs-target="#delmodal{{ $e->id }}"
                                            data-bs-toggle="modal" class="px-3 text-danger"><i
                                                class="uil uil-trash-alt font-size-18"></i></a>
                                        {{-- <a href="" data-bs-target="#DetailModal{{ $e->id_employee }}"
                                            data-bs-toggle="modal" class="px-3 text-warning"><i
                                                class="uil uil-file-alt font-size-18"></i></a> --}}
                                    </td>
                                </tr>
                                <!--  MODAL DELETE -->
                                <div id="delmodal{{ $e->id }}" class="modal fade bs-example-modal-center-modal-sm"
                                    tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                                    data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delmodal{{ $e->id }}">The system say:
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are u sure???
                                            </div>
                                            <form action="{{ route('employee.delete', $e->id) }}" method="POST">
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
                                </div><!-- /.modal -->

                                <!-- Modal UPDATE-->
                                <div id="UpdateModal{{ $e->id }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="UpdateModal{{ $e->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UpdateModal{{ $e->id }}">Update User
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tambahkan form untuk tambah user -->
                                                <form method="POST" action="{{ route('employee.update', $e->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Name</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="name" id="name"
                                                                value="{{ $e->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Username</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="username" id="username"
                                                                value="{{ $e->username }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Email</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="email" id="email"
                                                                value="{{ $e->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Password</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="password" id="password"
                                                                value="{{ $e->password }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="address"
                                                                id="address"value="{{ $e->address }}"></input>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Phone Number</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="number" name="no_telp"
                                                                id="no_telp"value="{{ $e->no_telp }}">
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
                    <h5 class="modal-title" id="myModalLabel">Tambah Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan form untuk tambah user -->
                    <form method="POST" action="{{ route('employee.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="username" id="username" required>
                            </div>
                        </div>
                        {{-- <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">NIP</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="nip" id="nip" required>
                            </div>
                        </div> --}}
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Password</label>
                            <div class="col-md-10">
                                <input class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Address</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Phone Number</label>
                            <div class="col-md-10">
                                <input class="form-control" type="number" name="no_telp" id="no_telp">
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

    <!--  MODAL DELETE ALL -->
    <div id="delall" class="modal fade bs-example-modal-center-modal-sm" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="delall">Sistem
                        mengatakan:
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin???
                </div>
                <form action="{{ route('employee.deleteall') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-danger">Ya</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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
