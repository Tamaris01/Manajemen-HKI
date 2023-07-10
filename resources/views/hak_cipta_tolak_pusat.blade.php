@extends('layouts.app')

@section('content')
<style>
    .btn-primary {
        background: linear-gradient(to right, #b3d9ff, #17a2b8, #007bff);
    }


    .btn-success {
        background: linear-gradient(to right, #b3ffbb, #1aff33, #00b300);
    }

    .btn-warning {
        background: linear-gradient(to right, #ffebcc, #ffc107, #ff7800);
    }

    .btn-danger {
        background: linear-gradient(to right, #ffdddd, #ff4444, #c82333);
    }

    .card {
        background-color: #ffffff;
        box-shadow: 0px 1px 3px 3px rgba(0, 123, 255, 0.5);
    }

    .table-footer {
        position: sticky;
        bottom: 0;
        background-color: white;
        z-index: 1;
    }
</style>

<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class=" card-header d-flex justify-content-between" style="background-color: #192A56">
                    <h4 style="color: white;">Ditolak Pusat</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead style="background-color: #008080; color: white;">
                            <tr>
                                <th class="text-center">Id Permohonan</th>
                                @auth('admin')
                                <th class="text-center">Id Pemohon</th>
                                @endauth('admin')
                                <th class="text-center">Judul Ciptaan</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hakCipta as $key => $value)
                            <tr>
                                <td class="text-center">{{ $value->id }}</td>
                                @auth('admin')
                                <td class="text-center">{{ $value->pemohon_id}}</td>
                                @endauth
                                <td class="text-center">{{ $value->judul }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detail-{{ $value->id }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('permohonan_hapus', $value->id) }}" class="btn btn-danger btn-sm alrt">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach ($hakCipta as $key => $value)
<div class="modal fade" id="detail-{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Permohonan {{ $value->judul }}</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between" style="background-color: #008080; color: white;">
                                <h5>Detail</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead style="background-color: black; color: white;">
                                            <tr>
                                                <th class="text-center">Jenis Ciptaan</th>
                                                <th class="text-center">Sub Jenis Ciptaan</th>
                                                <th class="text-center">Uraian Singkat</th>
                                                <th class="text-center">Tanggal Pertama</th>
                                                <th class="text-center">Kota Pertama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $value->jenis_ciptaan }}</td>
                                                <td class="text-center">{{ $value->sub_jenis_ciptaan }}</td>
                                                <td class="text-center">{{ $value->uraian_singkat }}</td>
                                                <td class="text-center">{{ $value->tanggal_pertama }}</td>
                                                <td class="text-center">{{ $value->kota_pertama }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between" style="background-color: #008080; color: white;">
                                <h5>Data Pencipta</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead style="background-color: black; color: white;">
                                            <tr>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Kode Pos</th>
                                                <th class="text-center">Provinsi</th>
                                                <th class="text-center">Kota</th>
                                                <th class="text-center">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            @if ($value->pencipta)
                                            @foreach ($value->pencipta as $k => $v)
                                            <tr>
                                                <td>{{ $v->nama }}</td>
                                                <td>{{ $v->alamat }}</td>
                                                <td>{{ $v->kode_pos }}</td>
                                                <td>{{ $v->provinsi }}</td>
                                                <td>{{ $v->kota }}</td>
                                                <td>{{ $v->email }}</td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6">
                                                    <h4>Data Pencipta Belum Ada</h4>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between" style="background-color: #008080; color: white;">
                                <h5>Lampiran</h5>
                            </div>
                            <div class="card-body">
                                @if ($value->lampiran)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead style="background-color: black; color: white;">
                                            <tr>
                                                <th class="text-center">Scan KTP Pemohon dan Pencipta</th>
                                                <th class="text-center">Surat Pernyataan</th>
                                                <th class="text-center">Bukti Pengalihan Hak Cipta</th>
                                                <th class="text-center">Contoh Ciptaan (File)</th>
                                                <th class="text-center">Contoh Ciptaan (Link)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><a href="{{ asset('lampiran/' . $value->lampiran->ktp) }}" target="_blank"><i class="fas fa-file-alt"></i> Lihat</a></td>
                                                <td class="text-center"><a href="{{ asset('lampiran/' . $value->lampiran->surat_pernyataan) }}" target="_blank"><i class="fas fa-file-alt"></i> Lihat</a></td>
                                                <td class="text-center"><a href="{{ asset('lampiran/' . $value->lampiran->bukti_pengalihan) }}" target="_blank"><i class="fas fa-file-alt"></i> Lihat</a></td>
                                                <td class="text-center"><a href="{{ asset('lampiran/' . $value->lampiran->contoh_ciptaan_file) }}" target="_blank"><i class="fas fa-file-alt"></i> Lihat</a></td>
                                                <td class="text-center"><a href="https://{{ $value->lampiran->contoh_ciptaan_link }}" target="_blank">{{ $value->lampiran->contoh_ciptaan_link }}</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <h4>Data Lampiran Belum Ada</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($value->keterangan)
                <h4>Keterangan ditolak: {{ $value->keterangan }}</h4>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.alrt').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan proses hapus data sesuai dengan id yang didapatkan
                    window.location.href = "{{ url('permohonan-hapus') }}/" + id;
                }
            });
        });
    });
</script>
@endpush


@endsection