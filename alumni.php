<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="img/icon.png">
  <title>Alumni - SDS Islam An Nur</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
  <style>
    /* WRAPPER UTAMA */
    .alumni-wrapper {
      display: flex !important;
      flex-wrap: nowrap !important;
      /* Dilarang turun ke bawah */
      gap: 20px;
      overflow-x: auto !important;
      /* Wajib scroll */
      padding: 20px 5px;

      /* Matikan smooth scroll CSS agar JS Drag lancar */
      scroll-behavior: auto !important;

      /* UX Kursor */
      cursor: grab;
      user-select: none;
      -webkit-user-select: none;
      /* Teks jangan ke-blok saat ditarik */

      /* Sembunyikan Scrollbar */
      scrollbar-width: none;
      -ms-overflow-style: none;
    }

    .alumni-wrapper::-webkit-scrollbar {
      display: none;
    }

    .alumni-wrapper.active {
      cursor: grabbing;
    }

    /* KARTU ITEM */
    .alumni-card-scroll {
      /* RAHASIANYA DI SINI: */
      flex: 0 0 auto !important;
      /* 0: Gak boleh ngecil, 0: Gak boleh membesar, Auto: Ikut width */
      width: 350px !important;
      /* Lebar Paksa */
      min-width: 350px !important;
      /* Cadangan lebar paksa */

      background: white;
      border-radius: 15px;
      border-left: 5px solid #198754;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
      pointer-events: none;
    }
  </style>
</head>

<body>

  <div class="top-bar bg-dark text-white py-2 small">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-8 d-none d-md-block">
          <span><i class="bi bi-envelope-fill me-2 text-warning"></i>info@sdsannur.sch.id</span>
          <span class="ms-3"><i class="bi bi-telephone-fill me-2 text-warning"></i>(0251) 8345678</span>
        </div>
        <div class="col-md-4 text-md-end text-center">
          <span class="me-2">Ikuti Kami:</span>
          <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>
  </div>

  <?php
  include "header.php";
  include "koneksi.php";

  // HITUNG TOTAL ALUMNI SECARA OTOMATIS
  $query_total = mysqli_query($conn, "SELECT * FROM alumni WHERE status_akun = 'aktif' ORDER BY tahun_lulus DESC");
  $total_alumni = mysqli_num_rows($query_total);
  ?>

  <header class="page-header py-5 text-white position-relative overflow-hidden" style="background-color: #155e37;">
    <div class="container py-5 position-relative z-2 text-center text-lg-start">
      <h1 class="display-4 fw-bold" data-aos="fade-down">Jejak Alumni</h1>
      <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
        <ol class="breadcrumb justify-content-center justify-content-lg-start mb-0">
          <li class="breadcrumb-item"><a href="/" class="text-white-50 text-decoration-none">Beranda</a></li>
          <li class="breadcrumb-item active text-white" aria-current="page">Alumni</li>
        </ol>
      </nav>
    </div>
  </header>

  <section class="py-5 bg-white">
    <div class="container">
      <div class="row g-4 text-center">
        <div class="col-md-3 col-6" data-aos="fade-up">
          <h2 class="fw-bold text-success display-4"><?= $total_alumni; ?>+</h2>
          <p class="text-muted">Total Alumni Terdaftar</p>
        </div>
        <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
          <h2 class="fw-bold text-success display-4">98%</h2>
          <p class="text-muted">Diterima PTN/Kerja</p>
        </div>
        <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
          <h2 class="fw-bold text-success display-4">50+</h2>
          <p class="text-muted">Mitra Perusahaan</p>
        </div>
        <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
          <h2 class="fw-bold text-success display-4">15</h2>
          <p class="text-muted">Angkatan Lulus</p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-5 bg-light">
    <div class="container py-4">

      <div class="text-center mb-5" data-aos="fade-up">
        <h5 class="text-success fw-bold text-uppercase">Kata Mereka</h5>
        <h2 class="fw-bold">Kisah Sukses Alumni</h2>
        <div class="mx-auto bg-success mt-3" style="height: 3px; width: 60px;"></div>
      </div>

      <div class="alumni-wrapper" id="alumniScroll" style="scroll-behavior: auto;">

        <?php
        // Query Data Alumni (Diurutkan dari yang terbaru lulus)
        $query_alumni = mysqli_query($conn, "SELECT * FROM alumni WHERE status_akun = 'aktif' ORDER BY tahun_lulus DESC");

        if (mysqli_num_rows($query_alumni) > 0) {
          while ($row = mysqli_fetch_assoc($query_alumni)) {
            // Cek foto
            $foto = !empty($row['foto']) ? "img/" . $row['foto'] : "https://cdn-icons-png.flaticon.com/512/3135/3135715.png";
        ?>

            <div class="alumni-card-scroll p-4" data-aos="fade-right">
              <div class="d-flex align-items-center mb-3">
                <img src="<?= $foto; ?>" class="rounded-circle shadow-sm object-fit-cover me-3" style="width: 60px; height: 60px;" alt="<?= $row['nama']; ?>">
                <div>
                  <h6 class="fw-bold mb-0 text-dark"><?= $row['nama']; ?></h6>
                  <small class="text-success fw-bold">
                    Lulusan <?= $row['tahun_lulus']; ?>
                  </small>
                </div>
              </div>

              <div class="badge bg-light text-secondary mb-3 border">
                <i class="bi bi-briefcase-fill me-1"></i> <?= $row['status']; ?>
              </div>

              <div class="bg-light p-3 rounded-3 fst-italic text-muted small position-relative">
                <i class="bi bi-quote fs-1 position-absolute text-secondary opacity-25" style="top: -10px; left: 10px;"></i>
                <span class="position-relative z-1">"<?= $row['testimoni']; ?>"</span>
              </div>
            </div>

        <?php
          }
        } else {
          echo '<div class="w-100 text-center text-muted py-5">Belum ada data alumni yang ditampilkan.</div>';
        }
        ?>

      </div>

      <div class="text-center mt-3 text-muted small d-md-none">
        <i class="bi bi-arrow-left-right me-1"></i> Geser untuk melihat lainnya
      </div>

    </div>
  </section>

  <section class="py-5 bg-white" id="info-reuni">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <h5 class="text-warning fw-bold text-uppercase">Agenda Temu Kangen</h5>
        <h2 class="fw-bold">Info Reuni & Agenda Alumni</h2>
      </div>

      <div class="row g-4 justify-content-center">
        <?php
        // Query Info Reuni
        $query_reuni = mysqli_query($conn, "SELECT * FROM info_reuni ORDER BY tanggal_acara DESC");

        if (mysqli_num_rows($query_reuni) > 0) {
          while ($reuni = mysqli_fetch_assoc($query_reuni)) {
            $foto_reuni = !empty($reuni['foto']) ? "img/" . $reuni['foto'] : "https://via.placeholder.com/400x200";

            // KITA BUAT ID UNIK UNTUK SETIAP MODAL
            // Contoh: modalReuni1, modalReuni2, dst.
            $modal_id = "modalReuni" . $reuni['id'];
        ?>

            <div class="col-md-6" data-aos="fade-up">
              <div class="card border-0 shadow overflow-hidden h-100">
                <div class="row g-0 h-100">
                  <div class="col-md-5">
                    <img src="<?= $foto_reuni; ?>" class="img-fluid h-100 w-100 object-fit-cover" style="min-height: 200px;" alt="Poster Reuni">
                  </div>
                  <div class="col-md-7">
                    <div class="card-body p-4 d-flex flex-column h-100">
                      <h5 class="card-title fw-bold text-dark"><?= $reuni['judul_acara']; ?></h5>

                      <div class="text-muted small mb-2">
                        <i class="bi bi-calendar-event me-2 text-success"></i> <?= date('d F Y', strtotime($reuni['tanggal_acara'])); ?> <br>
                      </div>
                      <div class="text-muted small mb-3">
                        <i class="bi bi-geo-alt me-2 text-success"></i> <?= $reuni['lokasi']; ?>
                      </div>

                      <p class="card-text small text-secondary mb-4"><?= substr($reuni['deskripsi'], 0, 80); ?>...</p>

                      <button type="button" class="btn btn-sm btn-outline-success rounded-pill mt-auto w-100" data-bs-toggle="modal" data-bs-target="#<?= $modal_id; ?>">
                        Lihat Detail
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="<?= $modal_id; ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content rounded-4 border-0">

                  <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-info-circle me-2"></i>Detail Acara</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body p-0">
                    <img src="<?= $foto_reuni; ?>" class="w-100 object-fit-cover" style="height: 300px;">

                    <div class="p-4">
                      <h3 class="fw-bold mb-3"><?= $reuni['judul_acara']; ?></h3>

                      <div class="row mb-4 bg-light p-3 rounded mx-0">
                        <div class="col-md-4 mb-2 mb-md-0 border-end">
                          <small class="text-muted fw-bold text-uppercase">Tanggal</small><br>
                          <span class="fw-bold text-success"><?= date('d M Y', strtotime($reuni['tanggal_acara'])); ?></span>
                        </div>
                        <div class="col-md-4 mb-2 mb-md-0 border-end">
                          <small class="text-muted fw-bold text-uppercase">Waktu</small><br>
                          <span class="fw-bold text-success"><?= $reuni['waktu_acara']; ?> WIB</span>
                        </div>
                        <div class="col-md-4">
                          <small class="text-muted fw-bold text-uppercase">Lokasi</small><br>
                          <span class="fw-bold text-success"><?= $reuni['lokasi']; ?></span>
                        </div>
                      </div>

                      <h6 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Lengkap</h6>
                      <p class="text-secondary lh-lg" style="text-align: justify;">
                        <?= nl2br($reuni['deskripsi']); ?>
                      </p>
                    </div>
                  </div>

                  <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($reuni['lokasi']); ?>" target="_blank" class="btn btn-success rounded-pill px-4">
                      <i class="bi bi-map-fill me-2"></i> Cek Lokasi Maps
                    </a>
                  </div>

                </div>
              </div>
            </div>
          <?php
          }
        } else {
          ?>
          <div class="col-md-8 text-center bg-light p-5 rounded border border-dashed">
            <i class="bi bi-calendar-x display-4 text-muted opacity-50"></i>
            <h5 class="mt-3 text-muted">Belum ada agenda reuni dalam waktu dekat.</h5>
          </div>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="py-5">
    <div class="container">
      <div class="bg-success rounded-4 p-5 text-center text-white shadow" data-aos="zoom-in">
        <h2 class="fw-bold mb-3">Anda Alumni Sekolah Ini?</h2>
        <p class="mb-4 opacity-75">
          Mari pererat tali silaturahmi. Update data diri Anda agar tetap terhubung dengan almamater.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <a href="daftar-alumni" class="btn btn-light text-success fw-bold rounded-pill px-4">Isi Data Alumni</a>
          <a href="#info-reuni" class="btn btn-outline-light rounded-pill px-4">Info Reuni</a>
        </div>
      </div>
    </div>
  </section>

  <style>
    .hover-top {
      transition: transform 0.3s ease;
    }

    .hover-top:hover {
      transform: translateY(-5px);
    }
  </style>

  <?php include "footer.php"; ?>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>

    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.getElementById('alumniScroll');

        if (!slider) return;

        // --- KONFIGURASI ---
        const autoSpeed = 1;  // Kecepatan Auto Scroll (Makin kecil makin pelan/halus)
        const dragSpeed = 0.8;    // Kecepatan Drag (1 = Natural mengikuti mouse, 2 = Cepat)

        // --- VARIABEL ---
        let isHovered = false;
        let isDown = false;
        let startX;
        let scrollLeft;
        let direction = 1; // 1 = Kanan, -1 = Kiri
        let animationId;   // Untuk mengontrol loop animasi

        // ==========================================
        //  BAGIAN A: MOUSE DRAG (MANUAL)
        // ==========================================
        
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            isHovered = true; 
            slider.classList.add('active');
            
            // Catat posisi awal
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
            
            // Batalkan animasi auto scroll sementara agar tidak tabrakan
            cancelAnimationFrame(animationId);
        });

        slider.addEventListener('mouseleave', () => {
            isDown = false;
            isHovered = false;
            slider.classList.remove('active');
            // Lanjut auto scroll saat mouse keluar
            animationId = requestAnimationFrame(autoScroll);
        });

        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
            // Mouse masih di atas elemen, jadi auto scroll tetap STOP (biar user bisa baca)
        });

        slider.addEventListener('mouseenter', () => {
            isHovered = true;
            // Stop auto scroll saat mouse masuk
            cancelAnimationFrame(animationId);
        });

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            
            const x = e.pageX - slider.offsetLeft;
            
            // RUMUS SMOOTH DRAG
            // Ganti pengali jadi 1 (atau variabel dragSpeed) agar natural
            const walk = (x - startX) * dragSpeed; 
            
            slider.scrollLeft = scrollLeft - walk;
        });

        // ==========================================
        //  BAGIAN B: AUTO SCROLL (PING-PONG HALUS)
        // ==========================================
        
        function autoScroll() {
            // Hanya jalan jika tidak sedang di-hover dan tidak sedang di-klik
            if (!isHovered && !isDown) {
                // Pastikan konten cukup lebar untuk di-scroll
                if (slider.scrollWidth > slider.clientWidth) {
                    
                    // Gerakkan scroll
                    slider.scrollLeft += (autoSpeed * direction);

                    // LOGIKA BOLAK-BALIK (PING-PONG)
                    // Pakai toleransi 1px untuk akurasi float
                    if (slider.scrollLeft >= (slider.scrollWidth - slider.clientWidth - 1)) {
                        direction = -1; // Mundur ke Kiri
                    } else if (slider.scrollLeft <= 0) {
                        direction = 1;  // Maju ke Kanan
                    }
                }
            }
            animationId = requestAnimationFrame(autoScroll);
        }

        // Mulai Mesin
        animationId = requestAnimationFrame(autoScroll);
    });
  </script>
</body>

</html>