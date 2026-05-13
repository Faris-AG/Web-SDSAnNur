<?php
include 'koneksi.php';

// 1. Ambil ID dan Action
$id = mysqli_real_escape_string($conn, $_GET['id']);
$action = isset($_GET['action']) ? $_GET['action'] : 'print';

// 2. Query disesuaikan dengan struktur database di laporan-ppdb.php
$query = mysqli_query($conn, "SELECT * FROM ppdb WHERE id = '$id'");
$d = mysqli_fetch_array($query);

if (!$d) {
    echo "<script>alert('Data tidak ditemukan!'); window.close();</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - <?= $d['nama_siswa']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
        }

        .kop-surat {
            border-bottom: 4px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .line-1 {
            font-size: 18pt;
            font-weight: bold;
        }

        .line-2 {
            font-size: 22pt;
            font-weight: bold;
            color: #1a5c2e;
        }

        .judul-bukti {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .table-data th,
        .table-data td {
            padding: 8px;
            vertical-align: top;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .table-data th {
            width: 35%;
            font-weight: bold;
        }

        .footer-table {
            width: 100%;
            margin-top: 20px;
        }

        .footer-table td {
            text-align: center;
            width: 50%;
            vertical-align: top;
        }

        .foto-box {
            width: 80px;
            height: 100px;
            border: 1px solid #000;
            margin: 20px auto 0;
            line-height: 100px;
            font-size: 9pt;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }
        }
    </style>
</head>

<body onload="<?= ($action == 'download') ? 'window.print()' : '' ?>">

    <div class="no-print bg-light border-bottom p-3 mb-4 text-center">
        <h6 class="mb-3">Mode: <?= ($action == 'download') ? 'Download PDF' : 'Pratinjau Cetak' ?></h6>
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="bi bi-printer"></i> Konfirmasi Cetak / Save PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Tutup Halaman</button>
    </div>

    <div class="container my-3">
        <div class="kop-surat d-flex align-items-center pb-3">
            <div class="text-center w-100 me-5">
                <div class="line-1">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</div>
                <div class="line-2">SDS ISLAM AN NUR</div>
                <div class="small">Gg. An Nur Jl. Kp. Baru, RT.002/RW.012, Ciapus, Kec. Ciomas, Kabupaten Bogor</div>
                <div class="small">Email: sdsannur9@gmail.com | NPSN: 20230630</div>
            </div>
        </div>

        <div class="text-center mb-4">
            <h4 class="fw-bold text-decoration-underline">BUKTI PENDAFTARAN PESERTA DIDIK BARU</h4>
        </div>

        <div class="row">
            <div class="col-8">
                <table class="table-data">
                    <tr>
                        <th width="30%">Nomor Registrasi</th>
                        <td>: <?= $d['no_registrasi']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>: <?= strtoupper($d['nama_siswa']); ?></td>
                    </tr>
                    <tr>
                        <th>NIK / NISN</th>
                        <td>: <?= $d['nik']; ?> / <?= $d['nisn']; ?></td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>: <?= $d['tempat_lahir']; ?>, <?= date('d F Y', strtotime($d['tgl_lahir'])); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>: <?= $d['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>: <?= $d['agama']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat Lengkap</th>
                        <td>: <?= $d['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td>: <?= $d['asal_sekolah']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Orang Tua</th>
                        <td>: <?= $d['nama_ayah']; ?> (Ayah) / <?= $d['nama_ibu']; ?> (Ibu)</td>
                    </tr>
                    <tr>
                        <th>Nomor HP / WhatsApp</th>
                        <td>: <?= $d['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <th>Status Pendaftaran</th>
                        <td class="fw-bold text-uppercase">: <?= $d['status']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="footer-table">
            <tr>
                <td>
                    Pendaftar,<br><br><br><br>
                    ( ........................... )
                    <div class="foto-box">PAS FOTO</div>
                </td>
                <td>
                    Bogor, <?= date('d F Y') ?><br>
                    Panitia PPDB,<br><br><br><br>
                    <strong>Admin PPDB</strong>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>