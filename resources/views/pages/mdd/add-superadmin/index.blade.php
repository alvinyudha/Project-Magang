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
            Data Superadmin
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
                                <th>Username</th>
                                <th>Perusahaan</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Alamat</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($data as $s)
                                {{-- <?php dd($data); ?> --}}
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $s->name }}</td>
                                    <td>{{ $s->username }}</td>
                                    <td>{{ $s->company_name }}</td>
                                    <td>{{ $s->role_name }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->no_telp }}</td>
                                    <td>{{ $s->address }}</td>
                                    <td>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#UpdateModal{{ $s->id }}"class="px-3 text-primary"><i
                                                class="uil uil-pen font-size-18"></i></a>

                                        <a href="" data-bs-target="#delmodal{{ $s->id }}"
                                            data-bs-toggle="modal" class="px-3 text-danger"><i
                                                class="uil uil-trash-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <!--  MODAL DELETE -->
                                <div id="delmodal{{ $s->id }}" class="modal fade bs-example-modal-sm" tabindex="-1"
                                    role="dialog" aria-labelledby="mySmallModalLabel" data-bs-backdrop="static"
                                    data-bs-keyboard="false" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delmodal{{ $s->id }}">Sistem mengatakan:
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin???
                                            </div>
                                            <form action="{{ route('sadmin.delete', $s->id) }}" method="POST">
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
                                <div id="UpdateModal{{ $s->id }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="UpdateModal{{ $s->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UpdateModal{{ $s->id }}">Update Pengguna
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tambahkan form untuk tambah user -->
                                                <form method="POST" action="{{ route('sadmin.update', $s->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nama</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="name" id="name"
                                                                value="{{ $s->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Username</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="username" id="username"
                                                                value="{{ $s->username }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Email</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="email"
                                                                id="email"value="{{ $s->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Sandi</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="password" id="password"
                                                                value="{{ $s->password }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nomor Telepon</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="no_telp" id="no_telp"
                                                                value="{{ $s->no_telp }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Alamat</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="address" id="address"
                                                                type="text" value="{{ $s->address }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Perusahaan</label>
                                                        <div class="col-md-10">
                                                            <select class="form-select" id="company_id" name="company_id"
                                                                required>
                                                                <option value="">Pilih Perusahaan</option>
                                                                @foreach ($company as $c)
                                                                    <option value="{{ $c->id_company }}"
                                                                        {{ $c->id_company == $s->company_id ? 'selected' : '' }}>
                                                                        {{ $c->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Role</label>
                                                        <div class="col-md-10">
                                                            <select class="form-select" id="role" name="role"
                                                                required>
                                                                <option value="">Select Role</option>
                                                                @foreach ($roles as $r)
                                                                    <option value="{{ $r->id }}"
                                                                        {{ $r->id == $s->role ? 'selected' : '' }}>
                                                                        {{ $r->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tambahkan form untuk tambah user -->
                    <form method="POST" action="{{ route('sadmin.store') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
                            <div class="col-md-10">
                                <input class="form-control" name="username" id="username">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Sandi</label>
                            <div class="col-md-10">
                                <input class="form-control" name="password" id="password">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input class="form-control" name="no_telp" id="no_telp">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Alamat</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Perusahaan</label>
                            <div class="col-md-10">
                                <select class="form-select" id="company_id" name="company_id" required>
                                    <option value="">Pilih Perusahaan</option>
                                    @foreach ($company as $company)
                                        <option value="{{ $company->id_company }}">
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
                            <div class="col-md-10">
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->name }}
                                        </option>
                                    @endforeach
                                </select>
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
                    Swal.fire("Deleted!", "Data berhasil dihapus.", "success");
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
