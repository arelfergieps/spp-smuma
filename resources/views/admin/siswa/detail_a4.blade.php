<div class="container mt-4 mb-5">
    <div class="card shadow-sm p-4">
        <div class="d-flex align-items-center mb-4">
            @if($siswa->foto)
            <img src="{{ asset('storage/foto/' . $siswa->foto) }}" class="rounded-circle me-3" width="64" height="64" alt="Foto Siswa">
            @else
            <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center me-3" style="width: 64px; height: 64px; font-size: 1.5rem;">
                {{ strtoupper(substr($siswa->nama, 0, 1)) }}
            </div>
            @endif
            <div>
                <div class="fw-semibold">{{ $siswa->nama }}</div>
                <div class="text-muted">{{ $siswa->rombel->rombel ?? '-' }}</div>
            </div>
        </div>

        <div class="row gy-3">
            <div class="col-md-4">
                <div>NIS :</div>
                <div class="fw-bold">{{ $siswa->nis }}</div>
            </div>
            <div class="col-md-4">
                <div>Kelas :</div>
                <div class="fw-bold">{{ $siswa->rombel->rombel ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div>Jurusan :</div>
                <div class="fw-bold">{{ $siswa->jurusan->jurusan ?? '-' }}</div>
            </div>
            <div class="col-md-4">
                <div>Email :</div>
                <div class="fw-bold">{{ $siswa->email }}</div>
            </div>
            <div class="col-md-4">
                <div>Agama :</div>
                <div class="fw-bold">{{ $siswa->agama }}</div>
            </div>
            <div class="col-md-4">
                <div>Alamat :</div>
                <div class="fw-bold">{{ $siswa->alamat }}</div>
            </div>
            <div class="col-md-4">
                <div>Jenis Kelamin :</div>
                <div class="fw-bold">{{ $siswa->jenis_kelamin }}</div>
            </div>
            <div class="col-md-4">
                <div>Tempat, Tanggal Lahir :</div>
                <div class="fw-bold">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->translatedFormat('d F Y') }}</div>
            </div>
            <div class="col-md-4">
                <div>Orang Tua :</div>
                <div class="fw-bold">{{ $siswa->nama_ortu }}</div>
            </div>
            <div class="col-md-4">
                <div>Telepon Orang Tua :</div>
                <div class="fw-bold">{{ $siswa->telepon_ortu }}</div>
            </div>
        </div>
    </div>
</div>