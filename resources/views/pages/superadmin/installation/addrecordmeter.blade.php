@extends('layouts-current.master')
@section('title')
    @lang('translation.Datatables')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Catat Meter Baru</div>

                    <div class="card-body">
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

                            <div class="form-group row mb-3">
                                <label for="id_customer"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Pelanggan') }}</label>

                                <div class="col-md-6">

                                    @foreach ($customer as $c)
                                        <input type="text" class="form-control" id="id_customer" name="id_customer"
                                            value="{{ $c->name }}" readonly>
                                        <input type="hidden" id="id_customer_hidden" name="id_customer"
                                            value="{{ $c->id_customer }}">
                                    @endforeach
                                    @error('id_customer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="current_meter" class="col-md-4 col-form-label text-md-right">Input Nomor
                                    Meter</label>

                                <div class="col-md-6">
                                    <input id="current_meter" type="number" step="0.01"
                                        class="form-control @error('current_meter') is-invalid @enderror"
                                        name="current_meter" value="{{ old('current_meter') }}" required>

                                    @error('current_meter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                    <button type="button" class="btn btn-secondary"
                                        onclick="window.location.href = '{{ route('superadmin-install') }}'">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
