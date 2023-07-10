@extends('layouts.app')

@section('content')
<style>
    .custom-alert {
        background: linear-gradient(to right, #007bff, #0056b3, #ffffff);
        color: #fff;
        animation: gradientAnimation 5s ease infinite;
    }
    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 50% 50%; }
        100% { background-position: 100% 50%; }
    }

    .bg-info {
        background: linear-gradient(to right,#b3d9ff, #17a2b8, #007bff);
    }

    
    .bg-success {
        background: linear-gradient(to right, #b3ffbb, #1aff33, #00b300);
    }

    .bg-warning {
        background: linear-gradient(to right,#ffebcc, #ffc107, #ff7800);
    }

    .bg-danger {
        background: linear-gradient(to right,#ffdddd, #ff4444, #c82333);
    }
.card {
  background-color: #fff!important;
  box-shadow: 0px 2px 4px 3px rgba(0, 123, 255, 0.5);
}
.small-box.bg-warning .inner h3,
.small-box.bg-warning .inner p,
.small-box.bg-warning .small-box-footer {
    color: #fff !important;
}



</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Home</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert custom-alert">
                Selamat Datang {{ Auth::user()->name }} di Sistem Informasi Manajemen HKI!
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
   <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
        <div class="inner">
            <h3>{{ $accPusat }}</h3>
            <p>Diterima Pusat</p>
        </div>
        <div class="icon">
            <i class="fas fa-building fa-2x""></i>
        </div>
        <a href="{{ route('hakcipta') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ $accAdmin }}</h3>
            <p>Diterima Admin</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-check"></i>
        </div>
        <a href="{{ route('hakcipta-terima-admin') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <h3>{{ $tolakAdmin }}</h3>
            <p>Ditolak Admin</p>
        </div>
        <div class="icon">
            <i class="fas fa-user-times"></i>
        </div>
        <a href="{{ route('hakcipta-tolak-admin') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
        <div class="inner">
            <h3>{{ $tolakPusat }}</h3>
            <p>Ditolak Pusat</p>
        </div>
        <div class="icon">
          <i class="fas fa-building"></i>
            <i class="fas fa-slash"></i>
        </div>
        <a href="{{ route('hakcipta-tolak-pusat') }}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
    </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Chart Bar</h2>
                </div>
                <div class="card-body" style="height: 400px">
                    <canvas id="barChart"></canvas>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Chart Pie</h2>
                </div>
                <div class="card-body" style="height: 400px">
                    <canvas id="pieChart"></canvas>
                </div>

            </div>
        </div>
    </div>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"><strong>Apakah Hak Cipta itu?</strong></h3>
					<br>
                    <p class="card-text">Hak Cipta adalah hak eksklusif pencipta yang timbul secara otomatis
                        berdasarkan
                        prinsip deklaratif setelah suatu ciptaan diwujudkan dalam bentuk nyata tanpa mengurangi
                        pembatasan
                        sesuai dengan ketentuan peraturan perundang-undangan.</p>
                    <p class="card-text"><strong>Apakah Hak Terkait itu?</strong></p>
                    <p class="card-text">Hak terkait adalah hak yang berkaitan dengan Hak Cipta yang merupakan hak
                        eksklusif
                        bagi pelaku pertunjukan, produser fonogram, atau lembaga penyiaran.</p>
                    <p class="card-text"><strong>Apa saja Ciptaan yang Dilindungi?</strong></p>
                    <ul>
                        <li>Buku, program komputer, pamflet, perwajahan (lay out) karya tulis yang diterbitkan, dan
                            semua
                            hasil karya tulis lain;</li>
                        <li>Ceramah, kuliah, pidato, dan ciptaan lain yang sejenis dengan itu;</li>
                        <li>Alat peraga yang dibuat untuk kepentingan pendidikan dan ilmu pengetahuan;</li>
                        <li>Lagu atau musik dengan atau tanpa teks;</li>
                        <li>Drama atau drama musikal, tari, koreografi, pewayangan, dan pantomim;</li>
                        <li>Seni rupa dalam segala bentuk seperti seni lukis, gambar, seni ukir, seni kaligrafi,
                            seni
                            pahat,
                            seni patung, kolase, dan seni terapan;</li>
                        <li>Arsitektur;</li>
                        <li>Peta;</li>
                        <li>Seni batik;</li>
                        <li>Fotografi;</li>
                        <li>Terjemahan, tafsir, saduran, bunga rampai, dan karya lain dari hasil pengalihwujudan.
                        </li>
						 </ul>
					<p class="card-text"><strong>Sub jenis ciptaan berdasarkan jenis ciptaannya dapat dilihat disini</strong>
                            <a href="{{ asset('pdf/file.pdf') }}" target="_blank" class="btn btn-primary btn-xs">
					<i class="fas fa-file-alt"></i> Sub Jenis Ciptaan
					</a> 
					</p>
                    <p class="card-text"><strong>Bagaimana cara mengajukan permohonan pendaftaran ciptaan?</strong></p>
                    <ol>
                        <li>Mengisi formulir pendaftaran ciptaan yang telah disediakan
                        </li>
                        <li>Surat permohonan pendaftaran ciptaan hanya dapat diajukan untuk satu ciptaan</li>
                        <li>Mengisi data pencipta</li>
                        <li>Melampirkan bukti kewarganegaraan pencipta dan pemegang Hak Cipta berupa fotokopi KTP</li>
                        <li>Melampirkan Surat Pernyataan</li>
                        <li>Melampirkan Surat Pengalihan</li>
                        <li>Melampirkan Contoh Ciptaan (file)</li>
                        <li>Melampirkan Link Ciptaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center" style="background: linear-gradient(to right, #0059b3, #0073e6); color: white">
				Alur
                </div>
                <div class="card-body">
                    <img src="{{ asset('img/postern.jpg') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center" style="background: linear-gradient(to right, #0059b3, #0073e6); color: white">
                    Surat Pernyataan
                </div>
                <div class="card-body">
                    <iframe src="{{ asset('pdf/pernyataan_hak_cipta.pdf') }}" width="100%" height="800"></iframe>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-center" style="background: linear-gradient(to right, #0059b3, #0073e6); color: white">
                    Surat Pengalihan
                </div>
                <div class="card-body">
                    <iframe src="{{ asset('pdf/SURAT PENGALIHAN HAK CIPTA.pdf') }}" width="100%" height="800"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data yang dikirimkan dari view
    var accPusat = {!! $accPusat !!};
    var accAdmin = {!! $accAdmin !!};
    var tolakPusat = {!! $tolakPusat !!};
    var tolakAdmin = {!! $tolakAdmin !!};

    // Inisialisasi grafik Bar
    var barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Diterima Pusat', 'Diterima Admin', 'Ditolak Admin', 'Ditolak Pusat'],
            datasets: [{
                label: 'Jumlah',
                data: [accPusat, accAdmin, tolakAdmin, tolakPusat],
                backgroundColor: ['teal', 'green', 'orange', 'red'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Inisialisasi grafik Pie
    var pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Diterima Pusat', 'Diterima Admin', 'Ditolak Admin', 'Ditolak Pusat'],
            datasets: [{
                data: [accPusat, accAdmin, tolakAdmin, tolakPusat],
                backgroundColor: ['teal', 'green', 'orange', 'red'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

@endsection