<?php
include 'koneksi.php';
include 'header.php';

// 1. TANGKAP ID REUNI DARI URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Pastikan angka untuk keamanan

    // 2. AMBIL DATA REUNI
    $query  = "SELECT * FROM info_reuni WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        // Data tidak ditemukan
        echo "<script>window.location='alumni.php';</script>";
        exit;
    }
} else {
    // Tidak ada ID
    echo "<script>window.location='alumni.php';</script>";
    exit;
}
?>

<header class="py-5 bg-dark text-white position-relative" style="background-image: url('img/header-bg.jpg'); background-size: cover; background-position: center;">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>
    <div class="container position-relative z-2 py-5 text-center">
        <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill fw-bold">Agenda Reuni</span>
        <h1 class="display-4 fw-bold"><?= $data['judul_acara']; ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="alumni" class="text-white-50 text-decoration-none">Alumni</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">Detail Acara</li>
            </ol>
        </nav>
    </div>
</header>

<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-8">
            
            <div class="rounded-4 overflow-hidden shadow mb-4">
                <?php $foto = !empty($data['foto']) ? "img/".$data['foto'] : "https://via.placeholder.com/800x400?text=Tidak+Ada+Poster"; ?>
                <img src="<?= $foto; ?>" class="img-fluid w-100" alt="<?= $data['judul_acara']; ?>">
            </div>

            <h3 class="fw-bold mb-3 text-success">Tentang Acara</h3>
            <div class="text-muted lh-lg" style="text-align: justify;">
                <?= nl2br($data['deskripsi']); ?>
            </div>

            <hr class="my-5">

            <a href="alumni" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Alumni
            </a>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm bg-light p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4 border-start border-4 border-success ps-3">Detail Pelaksanaan</h5>
                
                <div class="d-flex mb-4">
                    <div class="icon-box bg-white shadow-sm rounded-circle p-3 me-3 text-success">
                        <i class="bi bi-calendar-check-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase fw-bold">Tanggal</small>
                        <span class="fs-5 fw-bold text-dark">
                            <?= date('d F Y', strtotime($data['tanggal_acara'])); ?>
                        </span>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="icon-box bg-white shadow-sm rounded-circle p-3 me-3 text-success">
                        <i class="bi bi-clock-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase fw-bold">Waktu</small>
                        <span class="fs-5 fw-bold text-dark">
                            <?= $data['waktu_acara']; ?> WIB
                        </span>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <div class="icon-box bg-white shadow-sm rounded-circle p-3 me-3 text-success">
                        <i class="bi bi-geo-alt-fill fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block text-uppercase fw-bold">Lokasi</small>
                        <span class="fw-bold text-dark">
                            <?= $data['lokasi']; ?>
                        </span>
                    </div>
                </div>

                <hr>

                <div class="d-grid gap-2">
                    <a href="kontak" class="btn btn-success fw-bold py-2">
                        <i class="bi bi-whatsapp me-2"></i> Hubungi Panitia
                    </a>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($data['lokasi']); ?>" target="_blank" class="btn btn-outline-success fw-bold py-2">
                        <i class="bi bi-map me-2"></i> Lihat di Peta
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>