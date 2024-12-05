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
            Tagihan
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
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jumlah Pemakaian</th>
                                <th>Meteran Terakhir</th>
                                <th>Meteran Saat ini</th>
                                <th>Total Tagihan</th>
                                <th>Status</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($bill as $b)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $b->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($b->created_at)->format('d M Y') }}</td>
                                    <td>{{ $b->usage_amount }}</td>
                                    <td>{{ $b->last_meter }}</td>
                                    <td>{{ $b->current_meter }}</td>
                                    <td>Rp. {{ $b->total_bill }}</td>
                                    <td style="color: {{ $b->status == 'unpaid' ? 'orange' : 'lime' }};">
                                        {{ $b->status }}
                                    </td>
                                    <td>
                                        @if ($b->status == 'unpaid')
                                            <button href="" data-bs-target="#approvemodal{{ $b->id }}"
                                                data-bs-toggle="modal" class=" btn btn-success badge"><i
                                                    class="uil uil-dollar-alt font-size-18"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                <!--  MODAL approve -->
                                <div id="approvemodal{{ $b->id }}"
                                    class="modal fade bs-example-modal-center-modal-sm" tabindex="-1" role="dialog"
                                    aria-labelledby="mySmallModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approvemodal{{ $b->id }}">Sistem
                                                    mengatakan:
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin???
                                            </div>
                                            <form action="{{ route('bill.approve', $b->id) }}" method="POST">
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
