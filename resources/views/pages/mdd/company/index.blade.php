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
            Minible
        @endslot
        @slot('title')
            Perusahaan
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
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Fax</th>
                                <th>Photo</th>
                                <th>No Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($company as $c)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->address }}</td>
                                    <td>{{ $c->email }}</td>
                                    <td>{{ $c->fax }}</td>
                                    <td><img src="{{ asset('image-company/' . $c->pict) }}" alt="" width="80px">
                                    </td>
                                    <td>{{ $c->no_telp }}</td>
                                    <td>
                                        <a href="" data-bs-target="#UpdateModal{{ $c->id_company }}"
                                            data-bs-toggle="modal" class="px-3 text-primary"><i
                                                class="uil uil-pen font-size-18"></i></a>
                                        <a href="" data-bs-target="#delmodal{{ $c->id_company }}"
                                            data-bs-toggle="modal" class="px-3 text-danger"><i
                                                class="uil uil-trash-alt font-size-18"></i></a>
                                        <a href="{{ route('mdd-company-data-details', $c->id_company) }}"
                                            class="px-3 text-success"><i class="uil uil-file-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <!--  MODAL DELETE -->
                                <div id="delmodal{{ $c->id_company }}" class="modal fade modal-sm" tabindex="-1"
                                    role="dialog" aria-labelledby="mySmallModalLabel" data-bs-backdrop="static"
                                    data-bs-keyboard="false" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delmodal{{ $c->id_company }}">Sistem
                                                    mengatakan:
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin???
                                            </div>
                                            <form action="{{ route('company.delete', $c->id_company) }}" method="POST">
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
                                <div id="UpdateModal{{ $c->id_company }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="UpdateModal{{ $c->id_company }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="UpdateModal{{ $c->id_company }}">Update Data
                                                    Perusahaan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Tambahkan form untuk tambah user -->
                                                <form method="POST" action="{{ route('company.update', $c->id_company) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
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
                                                            class="col-md-2 col-form-label">Alamat</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="address" id="address"
                                                                value="{{ $c->address }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Email</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="email"
                                                                id="email"value="{{ $c->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Fax</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="fax" id="fax"
                                                                value="{{ $c->fax }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Photo</label>
                                                        <div class="col-md-10">
                                                            @if ($c->pict)
                                                                <img src="{{ asset('image-company/' . $c->pict) }}"
                                                                    alt="Company Picture" style="width: 200px;">
                                                            @endif
                                                            <input class="form-control" id="pict" type="file"
                                                                name="pict">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input"
                                                            class="col-md-2 col-form-label">Nomor Telepon</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="no_telp" id="no_telp"
                                                                value="{{ $c->no_telp }}">
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
                    <h5 class="modal-title" id="myModalLabel">Tambah BUMDES</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
                            <div class="col-md-10">
                                <input class="form-control" name="name" id="name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Alamat</label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Fax</label>
                            <div class="col-md-10">
                                <input class="form-control" name="fax" id="fax">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Photo</label>
                            <div class="col-md-10">
                                <input class="form-control" type="file" name="pict" id="pict"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-2 col-form-label">Nomor Telepon</label>
                            <div class="col-md-10">
                                <input class="form-control" name="no_telp" id="no_telp">
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
                    Swal.fire("Deleted!", "Data Perusahaan berhasil dihapus.", "success");
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
