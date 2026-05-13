<?php
// Pastikan folder dompdf sudah ada di proyek Anda
require_once 'lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

include 'koneksi.php';

// 1. Ambil ID dari URL
$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM ppdb WHERE id = '$id'");
$d = mysqli_fetch_array($query);

if (!$d) {
    die("Data tidak ditemukan!");
}

// 2. Pengaturan Dompdf agar bisa membaca CSS dan Gambar
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'Times-Roman'); // Gunakan font standar dokumen resmi
$dompdf = new Dompdf($options);

// 3. Masukkan Desain HTML & CSS (REVISED: Moved photo box to bottom)

$html = '
<html>
<head>
    <style>
        body { font-family: serif; font-size: 11pt; color: #000; margin: 0; padding: 0; }
        .kop-surat { border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 20px; text-align: center; }
        .line-1 { font-size: 16pt; font-weight: bold; margin-bottom: 5px; }
        .line-2 { font-size: 20pt; font-weight: bold; color: #1a5c2e; margin-bottom: 5px; }
        .info-sekolah { font-size: 10pt; }
        .judul-bukti { text-align: center; font-weight: bold; text-decoration: underline; font-size: 14pt; margin: 20px 0; }
        
        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .table-data th, .table-data td { padding: 8px; vertical-align: top; text-align: left; border-bottom: 1px solid #eee; }
        .table-data th { width: 35%; font-weight: bold; }
        
        .footer-table { width: 100%; margin-top: 20px; }
        .footer-table td { text-align: center; vertical-align: top; width: 50%; }
        
        .foto-box {
            width: 80px; height: 100px; 
            border: 1px solid #000; 
            margin: 20px auto 0 auto;
            line-height: 100px; font-size: 8pt; color: #666;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <div class="line-1">PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</div>
        <div class="line-2">SDS ISLAM AN NUR</div>
        <div class="info-sekolah">
            Gg. An Nur Jl. Kp. Baru, RT.002/RW.012, Ciapus, Kec. Ciomas, Kabupaten Bogor<br>
            Email: sdsannur9@gmail.com | NPSN: 20230630
        </div>
    </div>

    <div class="judul-bukti">BUKTI PENDAFTARAN PESERTA DIDIK BARU</div>

    <table class="table-data">
        <tr>
            <th align="left" width="35%">Nomor Registrasi</th>
            <td>: ' . $d['no_registrasi'] . '</td>
        </tr>
        <tr>
            <th align="left">Nama Lengkap</th>
            <td>: ' . strtoupper($d['nama_siswa']) . '</td>
        </tr>
        <tr>
            <th align="left">NIK / NISN</th>
            <td>: ' . $d['nik'] . ' / ' . $d['nisn'] . '</td>
        </tr>
        <tr>
            <th align="left">Tempat, Tanggal Lahir</th>
            <td>: ' . $d['tempat_lahir'] . ', ' . date('d F Y', strtotime($d['tgl_lahir'])) . '</td>
        </tr>
        <tr>
            <th align="left">Jenis Kelamin</th>
            <td>: ' . $d['jenis_kelamin'] . '</td>
        </tr>
        <tr>
            <th align="left">Agama</th>
            <td>: ' . $d['agama'] . '</td>
        </tr>
        <tr>
            <th align="left">Alamat Lengkap</th>
            <td>: ' . $d['alamat'] . '</td>
        </tr>
        <tr>
            <th align="left">Asal Sekolah</th>
            <td>: ' . $d['asal_sekolah'] . '</td>
        </tr>
        <tr>
            <th align="left">Nama Orang Tua</th>
            <td>: ' . $d['nama_ayah'] . ' (Ayah) / ' . $d['nama_ibu'] . ' (Ibu)</td>
        </tr>
        <tr>
            <th align="left">Nomor HP / WhatsApp</th>
            <td>: ' . $d['no_hp'] . '</td>
        </tr>
        <tr>
            <th align="left">Status Pendaftaran</th>
            <td>: <b>' . strtoupper($d['status']) . '</b></td>
        </tr>
    </table>

    <table class="footer-table">
        <tr>
            <td>
                Pendaftar,<br><br><br><br>
                ( ........................... )
                <div class="foto-box">PAS FOTO 3x4</div>
            </td>
            <td>
                Bogor, ' . date('d F Y') . '<br>
                Panitia PPDB,<br><br><br><br>
                <strong>Admin PPDB</strong>
            </td>
        </tr>
    </table>
</body>
</html>';


// 4. Proses Eksekusi PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 5. Download Otomatis
$dompdf->stream("Bukti_PPDB_" . $d['nama_siswa'] . ".pdf", array("Attachment" => 1));
