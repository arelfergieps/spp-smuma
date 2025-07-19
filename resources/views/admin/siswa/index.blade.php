@extends('admin.dashboardsmuma')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mt-4">
        <h2 class="mb-4">Data Siswa</h2>
        <div class="card">
            <div class="card-body">
                <form action="#" method="POST" id="form-siswa">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll"></th>
                                    <th>ID</th>
                                    <th>Rombel</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Jenis Kelamin</th>
                                    <th class="text-center">Informasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswas as $siswa)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="{{ $siswa->id }}"></td>
                                        <td>{{ $siswa->id }}</td>
                                        <td>{{ $siswa->rombel->rombel ?? 'Belum dipilih' }}</td>
                                        <td>{{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->nis }}</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-link p-0" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $siswa->id }}">
                                                <i class="fa fa-info-circle text-primary"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>

                @foreach ($siswas as $siswa)
                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal{{ $siswa->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $siswa->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="detailModalLabel{{ $siswa->id }}">Detail Siswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ $siswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIS</th>
                                            <td>{{ $siswa->nis }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rombel</th>
                                            <td>{{ $siswa->rombel->rombel ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tahun Ajaran</th>
                                            <td>{{ $siswa->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <td>
                                                {{ $siswa->tempat_lahir ?? '-' }},
                                                {{ $siswa->tanggal_lahir ? \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $siswa->alamat }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('checkAll');
            const checkboxes = document.querySelectorAll('input[name="ids[]"]');
            checkAll.addEventListener('change', function() {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
@endpush
