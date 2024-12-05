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
            Buat Data Tarif Grup
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tariff-group-store') }}" method="POST" class="repeater"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="group">Grup</label>
                            <select name="group" id="group" class="form-control" required>
                                <option value="progresif">Progresif</option>
                                <option value="progresif_dua">Progresif Dua</option>
                                <option value="non_progresif_rendah">Non-Progresif Rendah</option>
                                <option value="non_progresif_tinggi">Non-Progresif Tinggi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="group_name">Nama Grup</label>
                            <input type="text" id="group_name" name="group_name" class="form-control" required />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="desc">Deskripsi</label>
                            {{-- <input type="text" id="desc" name="desc" class="form-control" /> --}}
                            <textarea name="desc" id="desc" type="text" cols="30" rows="5" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
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
    <script src="{{ URL::asset('build/assets/libs/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('build/assets/libs/jquery-counterup/jquery-counterup.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Plugins js -->
    <script src="http://minible-v-light.laravel.themesbrand.com/assets/libs/jquery-repeater/jquery-repeater.min.js">
    </script>
    <script src="http://minible-v-light.laravel.themesbrand.com/assets/js/pages/form-repeater.int.js"></script>



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
