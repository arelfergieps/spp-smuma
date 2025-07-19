@extends('admin.dashboardsmuma')

@section('content')
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Kirim Tunggakan</h2>

        </div>
        <form method="POST" action="{{ route('kirim_tunggakan.store') }}">
            @csrf
            <div class="card mb-4">
                <div class="d-flex justify-content-center align-items-center gap-2 mb-4 pb-2 pt-3">
                    <i class="fa fa-bell" style="font-size: 15px;"></i>
                    <span style="font-size: 15px;">Dipilih</span>
                    <span id="jumlahTerpilih" class="badge rounded"
                        style="background-color: #a8f5a2; color: black;">0</span>
                    <button type="submit" class="btn btn-sm d-flex align-items-center"
                        style="background-color: #d1e7ff; color: #003366; ">
                        <i class="fa fa-paper-plane me-1" style="font-size: 12px;"></i> Kirim Tunggakan
                    </button>
                </div>

                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Tahun:</label>
                            <select name="tahun_ajaran_id" class="form-select form-select-sm" id="filterTahun" required>
                                <option value="">Pilih Tahun...</option>
                                @foreach ($tahun_ajaran as $tahun)
                                    <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Rombel:</label>
                            <select name="rombel_id" class="form-select form-select-sm" id="filterRombel">
                                <option value="">Pilih Rombel...</option>
                                @foreach ($rombels as $rombel)
                                    <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex align-items-center me-2">
                            <label class="me-2 mb-0">Search:</label>
                            <input type="text" class="form-control form-control-sm" id="searchInput"
                                placeholder="Cari...">
                        </div>

                        <div class="d-flex gap-1">
                            <button class="btn btn-outline-dark btn-sm">Print</button>
                            <button class="btn btn-outline-dark btn-sm">PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="checkAll">
                                </th>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tunggakans as $tunggakan)
                                <tr>
                                    <td><input type="checkbox" name="ids[]" value="{{ $tunggakan->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tunggakan->siswa->nama }}</td>
                                    <td>{{ $tunggakan->siswa->nis }}</td>
                                    <td>{{ $tunggakan->siswa->rombel->rombel }}</td>
                                    <td>{{ $tunggakan->siswa->tahunAjaran?->tahun_ajaran ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            const jumlahTerpilih = document.getElementById('jumlahTerpilih');

            function updateJumlahTerpilih() {
                const terpilih = document.querySelectorAll('input[name="ids[]"]:checked').length;
                jumlahTerpilih.textContent = terpilih;
            }

            if (checkAll) {
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    updateJumlahTerpilih();
                });
            }

            checkboxes.forEach(cb => cb.addEventListener('change', updateJumlahTerpilih));
            updateJumlahTerpilih();
        });
    </script>
@endsection
