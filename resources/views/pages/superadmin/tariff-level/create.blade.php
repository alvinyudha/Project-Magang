@extends('layouts-current.master')
@section('title', 'Add Tariff Level')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Tarif Level</h4>
                    <form action="{{ route('tariff-level-store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="group_id" value="{{ $group_id }}">
                        
                        <!-- Dropdown Tarif -->
                        <div class="mb-3">
                            <label for="tariff_type" class="form-label">Tipe Tarif</label>
                            <select class="form-select" id="tariff_type" name="tariff_type">
                                <option value="non-progresif_rendah">Non-Progresif Rendah</option>
                                <option value="non-progresif_tinggi">Non-Progresif Tinggi</option>
                                <option value="progresif">Progresif</option>
                                <option value="progresif_dua">Progresif Dua</option>
                            </select>
                        </div>

                        <!-- Field Level dan Tarif -->
                        <div class="mb-3" id="level_tariff_fields">
                            <!-- Dinamis field untuk level dan tariff -->
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tariffTypeSelect = document.getElementById('tariff_type');
            const levelTariffFields = document.getElementById('level_tariff_fields');

            // Fungsi untuk menampilkan field level dan tariff sesuai dengan tipe tarif yang dipilih
            function toggleFields() {
                const selectedTariffType = tariffTypeSelect.value;

                // Bersihkan semua field sebelum menambahkan field baru
                levelTariffFields.innerHTML = '';

                if (selectedTariffType === 'non-progresif_rendah') {
                    // Tambahkan satu field untuk level dan tariff
                    levelTariffFields.innerHTML = `
                        <div class="mb-3">
                            <label for="level" class="form-label">Level (satuan m3)</label>
                            <input type="text" value="non-progresif_rendah" class="form-control" id="level" name="level[]" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tariff" class="form-label">Tarif</label>
                            <input type="text" class="form-control" id="tariff" name="tariff[]" required>
                        </div>
                    `;
                } else if (selectedTariffType === 'non-progresif_tinggi') {
                    levelTariffFields.innerHTML = `
                        <div class="mb-3">
                            <label for="level" class="form-label">Level (satuan m3)</label>
                            <input type="text" value="non-progresif_tinggi" class="form-control" id="level" name="level[]" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tariff" class="form-label">Tarif</label>
                            <input type="text" class="form-control" id="tariff" name="tariff[]" required>
                        </div>
                    `;
                } else if (selectedTariffType === 'progresif') {
                    // Tambahkan field dinamis untuk level dan tariff
                    const levels = ['0-10', '10-20', '20-30', '>30'];
                    const tariffs = [/* Tambahkan nilai tarif sesuai rentang level */];

                    for (let i = 0; i < levels.length; i++) {
                        levelTariffFields.innerHTML += `
                            <div class="mb-3">
                                <label for="level_${i}" class="form-label">Level ${levels[i]} (satuan m3)</label>
                                <input type="text" value="${levels[i]}" class="form-control" id="level_${i}" name="level[]" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tariff_${i}" class="form-label">Tarif ${levels[i]}</label>
                                <input type="text" value="${tariffs[i]}" class="form-control" id="tariff_${i}" name="tariff[]" required>
                            </div>
                        `;
                    }
                } else if (selectedTariffType === 'progresif_dua') {
                    // Tambahkan field dinamis untuk level dan tariff
                    const levels = ['0-10', '10-20', '>20'];
                    const tariffs = [/* Tambahkan nilai tarif sesuai rentang level */];

                    for (let i = 0; i < levels.length; i++) {
                        levelTariffFields.innerHTML += `
                            <div class="mb-3">
                                <label for="level_${i}" class="form-label">Level ${levels[i]} (satuan m3)</label>
                                <input type="text" value="${levels[i]}" class="form-control" id="level_${i}" name="level[]" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tariff_${i}" class="form-label">Tarif ${levels[i]}</label>
                                <input type="text" value="${tariffs[i]}" class="form-control" id="tariff_${i}" name="tariff[]" required>
                            </div>
                        `;
                    }
                }
            }

            // Panggil fungsi toggleFields saat halaman dimuat ulang
            toggleFields();

            // Tambahkan event listener untuk perubahan dropdown
            tariffTypeSelect.addEventListener('change', toggleFields);
        });
    </script>
@endsection
