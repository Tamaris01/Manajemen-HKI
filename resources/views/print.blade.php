<!DOCTYPE html>
<html>

<head>
    <title>Sentra HKI Polibatam</title>
    <style>
        /* Gaya untuk header */
        header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        header img {
            height: 80px;
            /* Sesuaikan dengan ukuran logo */
            position: absolute;
            top: 10px;
            left: 10px;
        }

        /* Gaya untuk judul */
        header h3 {
            margin: 0;
            padding-top: 30px;
            padding-bottom: 30px
        }


        /* Gaya untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 20px;
            text-align: center;
            /* Mengatur teks di sel menjadi rata tengah */
            vertical-align: right;
        }

        .garis {
            border-top: 3px solid black;
            margin: 20px 0;
            padding-bottom: 20px
        }

        /* Gaya untuk thead */
        thead {
            background-color: #2196F3;
            color: white;
        }

        /* Gaya untuk judul kolom pada thead */
        th {
            white-space: nowrap;
            /* Mencegah pemisahan teks pada kolom */
        }

        .total {
            float: right;
            width: 400px;
            height: 20px;
            background-color: #2196F3;
            color: white;
            text-align: center;
            margin-top: 20px;
            padding: 5px;
            /* Menambahkan padding agar lebih terlihat */
        }

        @media print {
            thead {
                -webkit-print-color-adjust: exact;
                /* Mengizinkan latar belakang dicetak */
                print-color-adjust: exact;
                background-color: #2196F3;
                !important;
                color: white !important;
            }

            .total {
                -webkit-print-color-adjust: exact;
                /* Mengizinkan latar belakang dicetak */
                print-color-adjust: exact;
                background-color: #2196F3;
                !important;
                color: white !important;
            }
        }
    </style>
    <script>
        window.onload = function() {
            window.print(); // Cetak halaman saat halaman dimuat
        };
    </script>
</head>

<body>
    <header>
        <h3>Laporan Hak Kekayaan Intelektual Diterima Oleh Pusat</h3> <!-- Menutup tag h3 dengan </h3> -->

        <img src="{{ asset('img/polibatam.png') }}" alt="Logo Polibatam">
    </header>
    <div class="garis"></div>
    <table>
        <thead>
            <tr>
                <th>Id Permohonan</th>
                <th>Id Pemohon</th>
                <th>Jenis Ciptaan</th>
                <th>Sub Jenis Ciptaan</th>
                <th>Judul Ciptaan</th>
                <th>Tgl Diumumkan</th> <!-- Menambahkan tag penutup th -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $k => $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->pemohon_id }}</td>
                <td>{{ $v->jenis_ciptaan }}</td>
                <td>{{ $v->sub_jenis_ciptaan }}</td>
                <td>{{ $v->judul }}</td>
                <td>{{ $v->tanggal_pertama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total">Total Permohonan Diterima Pusat: {{ $data->count() }}</div> <!-- Menambahkan spasi sebelum dan sesudah tanda ":" -->
</body>

</html>