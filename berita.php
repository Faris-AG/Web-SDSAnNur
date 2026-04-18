<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Berita & Artikel - SDS Islam An Nur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="top-bar bg-dark text-white py-2 small">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 d-none d-md-block">
                    <span class="me-3"><i class="bi bi-envelope-fill me-2 text-warning"></i>info@sdsannur.sch.id</span>
                    <span><i class="bi bi-telephone-fill me-2 text-warning"></i>(0251) 8345678</span>
                </div>
                <div class="col-md-4 text-md-end text-center">
                    <span class="me-2">Ikuti Kami:</span>
                    <a href="https://www.facebook.com/sdislamannur.sdislamannur/" target="_blank" rel="noopener noreferrer" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/sekolahdasarannur?igsh=eHA0Y2FncHJva2Jp" target="_blank" rel="noopener noreferrer" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/@sdsannur3943" target="_blank" rel="noopener noreferrer" class="text-white"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php
    include 'header.php';
    include 'koneksi.php';

    // 1. TENTUKAN BATAS DATA PER HALAMAN
    $jumlahDataPerHalaman = 6;
    $halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
    $awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    // 2. CEK: LAGI CARI ATAU TIDAK?
    if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
        $mode_cari = true;

        // Hitung total data pencarian (untuk tahu butuh berapa halaman)
        $queryJml = "SELECT * FROM berita WHERE judul LIKE '%$keyword%' OR isi LIKE '%$keyword%'";

        // Query Data (Pakai LIMIT)
        $queryLain = "SELECT * FROM berita WHERE judul LIKE '%$keyword%' OR isi LIKE '%$keyword%' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerHalaman";
    } else {
        $mode_cari = false;

        // Hitung total semua berita
        $queryJml = "SELECT * FROM berita";

        // Query Data Normal (Pakai LIMIT)
        // Kita skip 1 berita terbaru karena sudah dipakai di HERO section (offset + 1)
        // Jadi kalau halaman 1, dia ambil data ke 2-7.
        $offset_khusus = $awalData + 1;

        $queryUtama = "SELECT * FROM berita ORDER BY id DESC LIMIT 1";
        $hasilUtama = mysqli_query($conn, $queryUtama);
        $beritaUtama = mysqli_fetch_assoc($hasilUtama);

        $queryLain = "SELECT * FROM berita ORDER BY id DESC LIMIT $offset_khusus, $jumlahDataPerHalaman";
    }

    // 3. EKSEKUSI HITUNG HALAMAN
    $resultJml = mysqli_query($conn, $queryJml);
    $jumlahData = mysqli_num_rows($resultJml);
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

    // 4. EKSEKUSI DATA GRID
    $hasilLain = mysqli_query($conn, $queryLain);
    ?>

    <header class="page-header py-5 text-white position-relative overflow-hidden" style="background-color: #155e37;">
        <div class="container py-5 position-relative z-2 text-center text-lg-start">
            <h1 class="display-4 fw-bold" data-aos="fade-down">Kabar Sekolah</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
                <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
                    <li class="breadcrumb-item">
                        <a href="/" class="text-white-50 text-decoration-none">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
    </header>

    <section class="py-5 bg-light">
        <div class="container">

            <div class="row justify-content-end mb-5">
                <div class="col-md-4">
                    <form action="" method="get">
                        <div class="input-group shadow-sm">
                            <input type="text" name="keyword" class="form-control" placeholder="Cari berita..." value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!$mode_cari && isset($beritaUtama)) { ?>

                <div class="card border-0 shadow-sm overflow-hidden mb-5" data-aos="fade-up">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="img/<?= $beritaUtama["gambar"]; ?>" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 350px" alt="Berita Utama" />
                        </div>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5">
                                <span class="badge bg-warning text-dark mb-2">Terbaru</span>
                                <h2 class="card-title fw-bold mb-3"><?= $beritaUtama["judul"]; ?></h2>
                                <p class="card-text text-muted mb-4"><?= substr($beritaUtama["isi"], 0, 150); ?>...</p>
                                <p class="card-text">
                                    <small class="text-muted"><i class="bi bi-calendar3 me-2"></i><?= $beritaUtama["tanggal"]; ?></small>
                                </p>
                                <a href="detail-berita.php?id=<?= $beritaUtama["id"]; ?>" class="btn btn-primary rounded-pill px-4 mt-2">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                    <h4 class="fw-bold m-0 border-start border-4 border-primary ps-3">Berita Lainnya</h4>
                </div>

            <?php } ?>
            <div class="row g-4">

                <?php if (mysqli_num_rows($hasilLain) > 0) { ?>

                    <?php while ($row = mysqli_fetch_assoc($hasilLain)) { ?>
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                            <div class="card h-100 news-card shadow-sm border-0">
                                <div class="ratio ratio-16x9">
                                    <img src="img/<?= $row['gambar']; ?>" class="card-img-top object-fit-cover" alt="<?= $row['judul']; ?>">
                                </div>

                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="text-primary small mb-2">
                                        <i class="bi bi-calendar-event me-2"></i> <?= $row['tanggal']; ?>
                                    </div>
                                    <h5 class="card-title fw-bold mb-3"><?= $row['judul']; ?></h5>
                                    <p class="card-text text-muted small"><?= substr($row['isi'], 0, 100); ?>...</p>

                                    <div class="mt-auto pt-3">
                                        <a href="detail-berita.php?id=<?= $row['id']; ?>" class="btn btn-outline-success btn-sm rounded-pill px-4">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php } else { ?>

                    <div class="col-12 text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-search display-1 text-muted opacity-25"></i>
                        </div>
                        <h3 class="text-muted">Pencarian tidak ditemukan</h3>
                        <p class="text-muted">Coba gunakan kata kunci lain.</p>
                        <a href="berita" class="btn btn-primary mt-3 px-4 rounded-pill">Tampilkan Semua Berita</a>
                    </div>

                <?php } ?>

            </div>
            <?php if ($jumlahHalaman > 1) : ?>

                <nav aria-label="Page navigation" class="mt-5" data-aos="fade-up">
                    <ul class="pagination justify-content-center">

                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>&keyword=<?= $keyword ?? '' ?>">Previous</a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled"><span class="page-link">Previous</span></li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>&keyword=<?= $keyword ?? '' ?>"><?= $i; ?></a></li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>&keyword=<?= $keyword ?? '' ?>"><?= $i; ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>&keyword=<?= $keyword ?? '' ?>">Next</a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled"><span class="page-link">Next</span></li>
                        <?php endif; ?>

                    </ul>
                </nav>

            <?php endif; ?>

        </div>
    </section>

    <?php include "footer.php"; ?>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</body>

</html>