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

    .card-header {
        background: linear-gradient(to right, #192A56, #0056b3);
    }

    .card {
        background-color: #ffffff;
        box-shadow: 0px 1px 3px 3px rgba(0, 123, 255, 0.5)
    }
</style>
<div class="container">
    <div class="alert alert-success">
        <h4>Update Data</h4>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('hakcipta-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="background-color: #192A56; color: white;">
                        Detail
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Jenis Ciptaan<span class="text-danger">*</span></label>
                            <input type="hidden" name="id" value="{{ $hakCipta->id }}">
                            <select class="form-control" required name="jenis_ciptaan">

                                <option disabled selected>Pilih</option>
                                <option value="Karya Tulis" @if ($hakCipta->jenis_ciptaan == 'Karya Tulis') selected @endif>Karya
                                    Tulis</option>
                                <option value="Karya Seni" @if ($hakCipta->jenis_ciptaan == 'Karya Seni') selected @endif>Karya Seni
                                </option>
                                <option value="Komposisi Musik" @if ($hakCipta->jenis_ciptaan == 'Komposisi Musik') selected @endif>
                                    Komposisi Musik</option>
                                <option value="Karya Audio Visual" @if ($hakCipta->jenis_ciptaan == 'Karya Audio Visual') selected @endif>
                                    Karya Audio Visual</option>
                                <option value="Karya Fotografi" @if ($hakCipta->jenis_ciptaan == 'Karya Fotografi') selected @endif>Karya
                                    Fotografi</option>
                                <option value="Karya Drama dan Koreografi" @if ($hakCipta->jenis_ciptaan == 'Karya Drama dan Koreografi') selected @endif>Karya Drama dan Koreografi
                                </option>
                                <option value="Karya Rekaman" @if ($hakCipta->jenis_ciptaan == 'Karya Rekaman') selected @endif>Karya
                                    Rekaman</option>
                                <option value="Karya Lainnya" @if ($hakCipta->jenis_ciptaan == 'Karya Lainnya') selected @endif>Karya
                                    Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Sub Jenis Ciptaan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $hakCipta->sub_jenis_ciptaan }}" required name="sub_jenis_ciptaan">
                        </div>
                        <div class="form-group mb-3">
                            <label>Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $hakCipta->judul }}" required name="judul">
                        </div>
                        <div class="form-group mb-3">
                            <label>Uraian Singkat Ciptaan <span class="text-danger">*</span></label>
                            <textarea class="form-control" required name="uraian_singkat" rows="3">{{ $hakCipta->uraian_singkat }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tanggal Pertama Kali Diumumkan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" required value="{{ $hakCipta->tanggal_pertama }}" name="tanggal_pertama">
                        </div>
                        <div class="form-group mb-3">
                            <label>Kota Pertama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required value="{{ $hakCipta->kota_pertama }}" name="kota_pertama">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="background-color: #192A56; color: white;">
                        Data pencipta
                        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#tambah">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
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
                                @foreach ($hakCipta->pencipta as $k => $v)
                                <tr>
                                    <td><input type="text" required value="{{ $v->nama }}" class="form-control" name="nama[]"></td>
                                    <td><input type="text" required value="{{ $v->alamat }}" class="form-control" name="alamat[]"></td>
                                    <td><input type="text" required value="{{ $v->kode_pos }}" class="form-control" name="kode_pos[]"></td>
                                    <td><input type="text" required value="{{ $v->provinsi }}" class="form-control" name="provinsi[]"></td>
                                    <td><input type="text" required value="{{ $v->kota }}" class="form-control" name="kota[]"></td>
                                    <td><input type="email" required value="{{ $v->email }}" class="form-control" name="email[]"></td>
                                    <td class="text-nowrap"><button class="btn btn-warning update">update</button>
                                        <button class="btn btn-danger hapus">hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="background-color: #192A56; color: white;">
                        Lampiran Preview
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Scan KTP Pemohon dan Pencipta</th>
                                    <th class="text-center">Surat Pernyataan</th>
                                    <th class="text-center">Bukti Pengalihan Hak Cipta</th>
                                    <th class="text-center">Contoh Ciptaan (file)</th>
                                    <th class="text-center">Contoh Ciptaan (Link)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><a href="{{ asset('lampiran/' . $hakCipta->lampiran->ktp) }}" target="blank">lihat</td>
                                    <td class="text-center"><a href="{{ asset('lampiran/' . $hakCipta->lampiran->surat_pernyataan) }}" target="blank">lihat</td>
                                    <td class="text-center"><a href="{{ asset('lampiran/' . $hakCipta->lampiran->bukti_pengalihan) }}" target="blank">lihat</td>
                                    <td class="text-center"><a href="{{ asset('lampiran/' . $hakCipta->lampiran->contoh_ciptaan_file) }}" target="blank">lihat</td>
                                    <td class="text-center"><a href="https://{{ $hakCipta->lampiran->contoh_ciptaan_link }}" target="_blank">{{ $hakCipta->lampiran->contoh_ciptaan_link }}</a></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between" style="background-color: #192A56; color: white;">
                        Lampiran (hanya isi ketika ingin mengganti)
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Scan KTP Pemohon dan Pencipta<span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" name="ktp">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Surat Pernyataan <span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" name="surat_pernyataan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Contoh Ciptaan <span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" name="contoh_ciptaan_file">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Bukti Pengalihan Hak Cipta <span class="text-danger">*Ekstensi PDF</span></label>
                                    <input type="file" class="form-control" name="bukti_pengalihan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Contoh Ciptaan (Link)</label>
                                    <input type="text" class="form-control" required value="{{ $hakCipta->contoh_ciptaan_link }}" name="contoh_ciptaan_link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3 mt-3">
                                    <input type="submit" class="btn btn-success w-100" value="simpan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                '" name="email[]"></td><td class="text-nowrap"><button class="btn btn-warning update">update</button> <button class="btn btn-danger hapus">hapus</button></td></tr>'
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
        $("#tbody").on("click", ".hapus", function(e) {
            e.preventDefault();
            $(this).closest("tr").remove(); // Hapus baris tabel terkait
        });
        $('#tbody').on('click', '.update', function(e) {
            e.preventDefault();
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
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "order": [], // Untuk menghilangkan sorting default pada footer
            "columnDefs": [{
                "targets": 'no-sort',
                "orderable": false,
            }],
            "drawCallback": function(settings) {
                var api = this.api();
                if (api.page.info().pages > 1) { // Hanya menampilkan footer jika ada beberapa halaman
                    $(api.table().footer()).show();
                } else {
                    $(api.table().footer()).hide();
                }
            }
        });
    });
</script>
@endsection