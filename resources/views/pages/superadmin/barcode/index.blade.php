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
            Cetak Barcode
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- <h4 class="card-title">Data SuperAdmin</h4> --}}
                    <div class="col-sm-10">
                        <button id="print-button" onclick="printBarcode('{{ route('print-barcode') }}')"
                            class="btn btn-primary mb-3">Print
                            Barcode</button>
                    </div>
                    <form action="" method="post"class="customer">
                        @csrf
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select-all-checkbox">
                                    </th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Kelompok Tarif</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($customer as $c)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="customer-checkbox" name="customer_codes[]"
                                                value="{{ $c->customer_code }}">
                                        </td>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        {{-- <td>

                                            <canvas class="barcode" data-barcode-value="{{ $c->customer_code }}"></canvas>
                                            {!! DNS1D::getBarcodeHTML("$c->customer_code", 'C93') !!}
                                            {{ $c->customer_code }}
                                        </td> --}}
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->address }}</td>
                                        <td>{{ $c->no_telp }}</td>
                                        <td>{{ $c->tariffgroup->group_name }}</td>
                                        {{-- <td>{{ $c->created_at->format('d-m-Y') }}</td> --}}
                                        <td>
                                            <a href="" data-bs-target="#DetailModal{{ $c->id_customer }}"
                                                data-bs-toggle="modal" class="px-3 text-warning"><i
                                                    class="uil uil-file-alt font-size-18"></i></a>
                                    </tr>
                                    <!-- Modal DETAILS-->
                                    <div id="DetailModal{{ $c->id_customer }}" class="modal fade modal-lg" tabindex="-1"
                                        role="dialog" aria-labelledby="DetailModal{{ $c->id_customer }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
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
                                                        <label for="example-text-input" class="col-md-2 col-form-label">ID
                                                            Pelanggan</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" name="customer_code"
                                                                id="customer_code" value="{{ $c->customer_code }}"readonly>
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
                                                            <input class="form-control" type="number"
                                                                name="identity_card_number" id="identity_card_number"
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
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    <script>
        const barcodeElements = document.querySelectorAll('.barcode');

        barcodeElements.forEach(function(barcodeElement) {
            const customerCode = barcodeElement.dataset.barcodeValue;


            JsBarcode(barcodeElement, customerCode, {
                format: "CODE128",
                font: "monospace",
                fontSize: 15,
                width: 1.5,
                height: 35,
                displayValue: true
            });

        });
    </script>

    <script src="{{ URL::asset('build/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/js/pages/datatables.init.js') }}"></script>

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
