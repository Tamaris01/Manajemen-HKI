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
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('permohonan-add') }}" id="myForm" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="p" value="{{ $p }}">
        @if ($p == 1)
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #191970; color: white;">
                        Detail
                    </div>
                    <div class="card-body">
                        @auth('admin')
                        <div class="form-group mb-3">
                            <label>Id Pemohon</label>
                            <select class="form-control" required name="pemohon_id">
                                <option disabled selected>Pilih</option>
                                @foreach ($pemohon as $k => $v)
                                <option value="{{ $v->id }}" @if ($draft) @if ($draft->pemohon_id == $v->id) selected @endif
                                    @endif>{{ $v->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endauth
                        @if ($draft)
                        <input type="hidden" name="id" value="{{ $draft->id }}">
                        @endif
                        <div class="form-group mb-3">
                            <label>Jenis Ciptaan <span class="text-danger">*</span></label>
                            <select class="form-control" required name="jenis_ciptaan">
                                @if ($draft)
                                <option value="{{ $draft->jenis_ciptaan }}" selected>{{ $draft->jenis_ciptaan }}
                                </option>
                                @else
                                <option disabled selected>Pilih</option>
                                @endif
                                <option value="Karya Tulis">Karya Tulis</option>
                                <option value="Karya Seni">Karya Seni</option>
                                <option value="Komposisi Musik">Komposisi Musik</option>
                                <option value="Karya Audio Visual">Karya Audio Visual</option>
                                <option value="Karya Fotografi">Karya Fotografi</option>
                                <option value="Karya Drama dan Koreografi">Karya Drama dan Koreografi</option>
                                <option value="Karya Rekaman">Karya Rekaman</option>
                                <option value="Karya Lainnya">Karya Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Sub Jenis Ciptaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required name="sub_jenis_ciptaan" value="{{ $draft ? $draft->sub_jenis_ciptaan : '' }}">
                            <small class="form-text text-muted" style="color: #FF0000;"> Keterangan: Sub jenis ciptaan dapat dilihat <a href="{{ asset('pdf/file.pdf') }}" target="_blank">di sini</a>.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label>Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required name="judul" value="{{ $draft ? $draft->judul : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Uraian Singkat Ciptaan <span class="text-danger">*</span></label>
                            <textarea class="form-control" required name="uraian_singkat" rows="3">{{ $draft ? $draft->uraian_singkat : '' }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tanggal Pertama Kali Diumumkan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" required name="tanggal_pertama" value="{{ $draft ? $draft->tanggal_pertama : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Kota Pertama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required name="kota_pertama" value="{{ $draft ? $draft->kota_pertama : '' }}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-success " value="Selanjutnya">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @elseif($p == 2)
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="background-color: #191970; color: white;">
                        Data Pencipta - id permohonan {{ $hak_cipta_id }}
                        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#tambah">
                        <i class="fas fa-plus-circle"></i> Tambah
                        </button>
                    </diV>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered nowrap">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Kode Pos</th>
                                    <th>Provinsi</th>
                                    <th>Kota</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @if ($draft2)
                                @foreach ($draft2 as $k => $v)
                                <tr>
                                    <td><input type="text" required value="{{ $v->nama }}" class="form-control" name="nama[]"></td>
                                    <td><input type="text" required value="{{ $v->alamat }}" class="form-control" name="alamat[]"></td>
                                    <td><input type="text" required value="{{ $v->kode_pos }}" class="form-control" name="kode_pos[]"></td>
                                    <td><input type="text" required value="{{ $v->provinsi }}" class="form-control" name="provinsi[]"></td>
                                    <td><input type="text" required value="{{ $v->kota }}" class="form-control" name="kota[]"></td>
                                    <td><input type="email" required value="{{ $v->email }}" class="form-control" name="email[]"></td>
                                    <td class="text-nowrap"><button type="button" class="btn btn-warning update">update</button>
                                        <button class="btn btn-danger hapus">hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-form') }}?p={{ $p - 1 }}" class="btn btn-dark btn-sm">kembali</a>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right ">
                                    <input type="hidden" name="hak_cipta_id" value="{{ $hak_cipta_id }}">
                                    <input type="submit" class="btn btn-success btn-sm float-end" value="selanjutnya">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif($p == 3)
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #191970; color: white;">
                        Lampiran - id permohonan {{ $hak_cipta_id }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Scan KTP Pemohon dan Pencipta <span class="text-danger">*Ekstensi
                                            PDF</span></label>
                                    <input type="file" class="form-control" required name="ktp">
                                    <div class="invalid-feedback">
                                        Harus berupa PDF.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Surat Pernyataan <span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" required name="surat_pernyataan">
                                    <div class="invalid-feedback">
                                        Harus berupa PDF.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Contoh Ciptaan <span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" required name="contoh_ciptaan_file">
                                    <div class="invalid-feedback">
                                        Harus berupa PDF.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Bukti Pengalihan Hak Cipta <span class="text-danger">*Ekstensi
                                            PDF</span></label>
                                    <input type="file" class="form-control" required name="bukti_pengalihan">
                                    <div class="invalid-feedback">
                                        Harus berupa PDF.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Contoh Ciptaan (Link)</label>
                                    <input type="text" class="form-control" required name="contoh_ciptaan_link">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('permohonan-form') }}?p={{ $p - 1 }}" class="btn btn-dark">kembali </a>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right">
                                    <input type="hidden" name="hak_cipta_id" value="{{ $hak_cipta_id }}">
                                    <input type="submit" class="btn btn-success float-end" value="ajukan" onclick="return confirmSubmit()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pencipta</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="f_pencipta">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama </label>
                        <input type="text" class="form-control" required id="nama">
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat </label>
                        <input type="text" class="form-control" required id="alamat">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kode Pos </label>
                        <input type="text" class="form-control" required id="kode_pos">
                    </div>
                    <div class="form-group mb-3">
                        <label>Provinsi </label>
                        <input type="text" class="form-control" required id="provinsi">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kota </label>
                        <input type="text" class="form-control" required id="kota">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email </label>
                        <input type="email" class="form-control" required id="email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Pencipta</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="f_update">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama </label>
                        <input type="text" class="form-control" required id="update_nama">
                    </div>
                    <div class="form-group mb-3">
                        <label>Alamat </label>
                        <input type="text" class="form-control" required id="update_alamat">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kode Pos </label>
                        <input type="text" class="form-control" required id="update_kode_pos">
                    </div>
                    <div class="form-group mb-3">
                        <label>Provinsi </label>
                        <input type="text" class="form-control" required id="update_provinsi">
                    </div>
                    <div class="form-group mb-3">
                        <label>Kota </label>
                        <input type="text" class="form-control" required id="update_kota">
                    </div>
                    <div class="form-group mb-3">
                        <label>Email </label>
                        <input type="email" class="form-control" required id="update_email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    (function() {
        'use strict';

        // Mendapatkan semua elemen input file
        var fileInputs = document.querySelectorAll('input[type="file"]');

        // Menambahkan event listener pada setiap input file
        fileInputs.forEach(function(fileInput) {
            fileInput.addEventListener('change', function() {
                // Mendapatkan file yang diunggah
                var file = fileInput.files[0];

                // Memeriksa ekstensi file
                var fileExtension = file.name.split('.').pop().toLowerCase();
                if (fileExtension !== 'pdf') {
                    // Menandai input file sebagai tidak valid
                    fileInput.classList.add('is-invalid');
                    fileInput.value = '';
                } else {
                    // Menghapus tanda tidak valid jika file valid
                    fileInput.classList.remove('is-invalid');
                }
            });
        });
    })();
</script>
<script>
    function confirmSubmit() {
        Swal.fire({
            title: 'Yakin?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengklik OK, formulir akan disubmit
                document.getElementById("myForm").submit();
            }
        });

        return false;
    }
</script>
<script>
    $(document).ready(function() {
        var indexToUpdate; // Variabel untuk menyimpan indeks data yang akan diupdate
        var namaToUpdate, alamatToUpdate, kodePosToUpdate, provinsiToUpdate, kotaToUpdate,
            emailToUpdate; // Variabel untuk menyimpan data yang akan diupdate

        // Function untuk menampilkan modal update dengan data yang telah dipilih
        function showModalWithData() {
            // Set value input pada form update
            $('#update_nama').val(namaToUpdate);
            $('#update_alamat').val(alamatToUpdate);
            $('#update_kode_pos').val(kodePosToUpdate);
            $('#update_provinsi').val(provinsiToUpdate);
            $('#update_kota').val(kotaToUpdate);
            $('#update_email').val(emailToUpdate);

            // Buka modal update
            $('#update').modal('show');
        }

        // Function untuk melakukan update data
        function updateData() {
            // Set value data yang telah diupdate
            $('input[name="nama[]"]').eq(indexToUpdate).val(namaToUpdate);
            $('input[name="alamat[]"]').eq(indexToUpdate).val(alamatToUpdate);
            $('input[name="kode_pos[]"]').eq(indexToUpdate).val(kodePosToUpdate);
            $('input[name="provinsi[]"]').eq(indexToUpdate).val(provinsiToUpdate);
            $('input[name="kota[]"]').eq(indexToUpdate).val(kotaToUpdate);
            $('input[name="email[]"]').eq(indexToUpdate).val(emailToUpdate);
        }

        $('#f_pencipta').on('submit', function(e) {
            e.preventDefault(); // prevent the form from submitting

            // Get the input values
            var nama = $('#nama').val();
            var alamat = $('#alamat').val();
            var kode_pos = $('#kode_pos').val();
            var provinsi = $('#provinsi').val();
            var kota = $('#kota').val();
            var email = $('#email').val();

            //tambah ke tabel
            $('#tbody').append(
                '<tr><td><input type="text" required readonly class="form-control" value="' +
                nama +
                '" name="nama[]"></td><td><input type="text" required readonly class="form-control" value="' +
                alamat +
                '" name="alamat[]"></td><td><input type="text" required readonly class="form-control" value="' +
                kode_pos +
                '" name="kode_pos[]"></td><td><input type="text" required readonly class="form-control" value="' +
                provinsi +
                '" name="provinsi[]"></td><td><input type="text" required readonly class="form-control" value="' +
                kota +
                '" name="kota[]"></td><td><input type="email" required readonly class="form-control" value="' +
                email +
                '" name="email[]"></td><td class="text-nowrap"><button type="button" class="btn btn-warning btn-sm update">Update</button> <button class="btn btn-danger btn-sm hapus">Hapus</button></td></tr>'
            );


            // Reset the form values
            $('#nama').val('');
            $('#alamat').val('');
            $('#kode_pos').val('');
            $('#provinsi').val('');
            $('#kota').val('');
            $('#email').val('');

            // Close the modal
            $('#tambah').modal('hide');
        });
        $("#tbody").on("click", ".hapus", function() {
            $(this).closest("tr").remove(); // Hapus baris tabel terkait
        });
        $('#tbody').on('click', '.update', function() {
            // Simpan indeks data yang akan diupdate
            indexToUpdate = $(this).closest('tr').index();

            // Simpan data yang akan diupdate
            namaToUpdate = $('input[name="nama[]"]').eq(indexToUpdate).val();
            alamatToUpdate = $('input[name="alamat[]"]').eq(indexToUpdate).val();
            kodePosToUpdate = $('input[name="kode_pos[]"]').eq(indexToUpdate).val();
            provinsiToUpdate = $('input[name="provinsi[]"]').eq(indexToUpdate).val();
            kotaToUpdate = $('input[name="kota[]"]').eq(indexToUpdate).val();
            emailToUpdate = $('input[name="email[]"]').eq(indexToUpdate).val();

            // Tampilkan modal update dengan data yang telah dipilih
            showModalWithData();
        });
        $('#f_update').on('submit', function(e) {
            e.preventDefault();
            // ... mengambil data
            namaToUpdate = $('#update_nama').val();
            alamatToUpdate = $('#update_alamat').val();
            kodePosToUpdate = $('#update_kode_pos').val();
            provinsiToUpdate = $('#update_provinsi').val();
            kotaToUpdate = $('#update_kota').val();
            emailToUpdate = $('#update_email').val();

            updateData();
            $('#update').modal('hide');
        });
    });
</script>
@endsection