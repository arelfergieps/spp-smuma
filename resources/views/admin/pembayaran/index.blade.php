@extends('admin.dashboardsmuma')
@section('content')
    <style>
        .table-responsive {
            overflow: visible !important;
        }

        .table-responsive .dropdown-menu {
            z-index: 1050;
        }
    </style>
    <div class="container-fluid mt-4">
        <div class="d-flex align-items-center mb-4">
            <h2 class="mb-0">Pembayaran</h2>
        </div>
        <!-- MODAL Rombel -->
        <div class="card mb-4">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Tahun:</label>
                        <select class="form-select form-select-sm" id="filterTahun">
                            <option value="">Pilih Tahun...</option>
                            @foreach ($tahun_ajaran as $tahun)
                                <option value="{{ $tahun->id }}">{{ $tahun->tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Rombel:</label>
                        <select class="form-select form-select-sm" id="filterRombel">
                            <option value="">Pilih Rombel...</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}">{{ $rombel->rombel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex align-items-center me-2">
                        <label class="me-2 mb-0">Search:</label>
                        <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari...">
                    </div>

                    <div class="d-flex gap-1">
                        <button class="btn btn-outline-dark btn-sm">Print</button>
                        <button class="btn btn-outline-dark btn-sm">PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Tahun</th>
                                <th>Opsional</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayarans as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->nama }}</td>
                                    <td>{{ $siswa->nis }}</td>
                                    <td>{{ $siswa->rombel->rombel }}</td>
                                    <td>{{ $siswa->tahunAjaran?->tahun_ajaran ?? '-' }}</td>
                                    <td>{{ $siswa->opsional }}
                                        <div class="d-flex align-items-center">
                                            <!-- Ikon Info -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icon-tabler-info-circle btn-detail-siswa"
                                                data-id="{{ $siswa->id }}" style="cursor:pointer;">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                                <path d="M12 9h.01" />
                                                <path d="M11 12h1v4h1" />
                                            </svg>
                                            <!-- Ikon Notes -->
                                            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal"
                                                data-bs-target="#modalTransaksiSiswa{{ $siswa->id }}">

                                                <img width="20" height="20"
                                                    src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/64/external-notes-contact-and-communication-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png"
                                                    alt="external-notes-contact-and-communication-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto" />

                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M5 3m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                                <path d="M9 7l6 0" />
                                                <path d="M9 11l6 0" />
                                                <path d="M9 15l4 0" />
                                                </svg>
                                            </button>
                                            <!-- Dropdown Tiga Titik -->
                                            <div class="dropdown">
                                                <button class="btn p-0 border-0 bg-transparent d-flex align-items-center"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <circle cx="12" cy="5" r="0.6" />
                                                        <circle cx="12" cy="12" r="0.6" />
                                                        <circle cx="12" cy="19" r="0.6" />
                                                    </svg>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modalInputPembayaran">
                                                            SPP
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#modalInputPembayaran">
                                                            Ujian
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailSiswaModal" tabindex="-1" aria-labelledby="detailSiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailSiswaModalLabel">Detail Informasi Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <p>Loading...</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Input Pembayaran -->
    <div class="modal fade" id="modalInputPembayaran" tabindex="-1" aria-labelledby="modalInputPembayaranLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form id="formInputPembayaran" method="POST" action="{{ route('pembayaran.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputPembayaranLabel">Input Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="siswa_id" id="inputPembayaranSiswaId" value="">

                        <div class="mb-3">
                            <label class="form-label">Kategori Pembayaran</label>
                            <input type="hidden" name="jenis_pembayaran" id="jenis_pembayaran" required>
                            <p class="form-control-plaintext fw-semibold text-dark mb-0" id="jenisPembayaranLabel">-</p>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah"
                                placeholder="Masukkan jumlah pembayaran" required min="0">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                            <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                                placeholder="Masukkan keterangan jika ada"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($pembayarans as $siswa)
        <div class="modal fade" id="modalTransaksiSiswa{{ $siswa->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Siswa</h6>
                                <p>Nama: {{ $siswa->nama }}</p>
                                <p>NIS: {{ $siswa->nis }}</p>
                                <p>Kelas: {{ $siswa->rombel->tingkat ?? '-' }}</p>
                                <p>Rombel: {{ $siswa->rombel->rombel ?? '-' }}</p>
                                <p>Jurusan: {{ $siswa->rombel->jurusan->jurusan ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Tambahan</h6>
                                <p>Tahun Ajaran: {{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</p>
                                <p>Total: Rp{{ number_format($siswa->pembayarans->sum('jumlah'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <hr>
                        <h6>Informasi Pembayaran</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori Pembayaran</th>
                                    <th>Nominal</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa->pembayarans as $pembayaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pembayaran->tagihan->kategoriPembayaran->nama ?? '-' }}</td>
                                        <td>Rp{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d M Y') }}
                                        </td>
                                        <td>{{ $pembayaran->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pembayaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-cetak-transaksi">Cetak</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select All Checkbox
            const selectAll = document.getElementById('select-all');
            if (selectAll) {
                selectAll.addEventListener('change', function(e) {
                    document.querySelectorAll('input[name="siswa_ids[]"]').forEach(cb => cb.checked = e
                        .target.checked);
                });
            }

            // Cetak Modal Isi
            document.querySelectorAll('.btn-cetak-transaksi').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var modalContent = this.closest('.modal-content').querySelector('.modal-body')
                        .innerHTML;
                    var win = window.open('', '', 'width=800,height=600');
                    win.document.write('<html><head><title>Cetak Transaksi</title></head><body>');
                    win.document.write(modalContent);
                    win.document.write('</body></html>');
                    win.document.close();
                    win.print();
                });
            });

            // Dropdown Jenis Pembayaran
            $('.dropdown-menu a').click(function(e) {
                e.preventDefault();
                var siswaId = $(this).closest('tr').find('.btn-detail-siswa').data('id');
                $('#inputPembayaranSiswaId').val(siswaId);
                var jenis = $(this).text().trim();
                $('#jenis_pembayaran').val(jenis);
                $('#jenisPembayaranLabel').text(jenis);
                $('#modalInputPembayaran').modal('show');
            });
        });
    </script>
@endsection
