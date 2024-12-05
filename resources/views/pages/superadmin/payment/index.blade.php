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
            Pembayaran
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
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Pemakaian</th>
                                <th>Total Tagihan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Rincian</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($pay as $p)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $p->customer_code }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d M Y') }}</td>
                                    <td>{{ $p->usage_amount }}</td>
                                    <td>Rp. {{ $p->total_bill }}</td>
                                    <td>Rp. {{ $p->total_payment }}</td>
                                    <td style="color: {{ $p->status == 'unpaid' ? 'yellow' : 'lime' }};">
                                        {{ $p->status }}
                                    </td>
                                    <td>
                                        <a href="" data-bs-target="#DetailModal{{ $p->id }}"
                                            data-bs-toggle="modal" class="px-3 text-warning"><i
                                                class="uil uil-file-alt font-size-18"></i></a>
                                    </td>
                                </tr>
                                <div id="DetailModal{{ $p->id }}" class="modal fade modal-lg" tabindex="-1"
                                    role="dialog" aria-labelledby="DetailModal{{ $p->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="DetailModal{{ $p->id }}">Detail
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Nama</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="name" id="name"
                                                            value="{{ $p->name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Tarif
                                                        Grup</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="group_name" id="group_name"
                                                            value="{{ $p->group_name }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Meteran
                                                        Terakhir</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="last_meter" id="last_meter"
                                                            value="{{ $p->last_meter }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Meteran
                                                        Saat ini</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="current_meter" id="current_meter"
                                                            value="{{ $p->current_meter }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Jumlah
                                                        Pemakaian</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="usage_amount" id="usage_amount"
                                                            value="{{ $p->usage_amount }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Periode</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="period" id="period"
                                                            value="{{ $p->period }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Tanggal
                                                        Bayar</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="payment_date" id="payment_date"
                                                            value="{{ $p->payment_date }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Retribusi</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="retribution" id="retribution"
                                                            value="Rp. {{ $p->retribution }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input"
                                                        class="col-md-2 col-form-label">Denda</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="fines" id="fines"
                                                            value="Rp. {{ $p->fines }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Total
                                                        Tagihan</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="total_bill" id="total_bill"
                                                            value="Rp. {{ $p->total_bill }}"readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="example-text-input" class="col-md-2 col-form-label">Total
                                                        Bayar</label>
                                                    <div class="col-md-10">
                                                        <input class="form-control" name="total_payment"
                                                            id="total_payment"
                                                            value="Rp. {{ $p->total_payment }}"readonly>
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
