<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="img/icon.png">
  <title>SDS Islam An Nur - Mewujudkan Generasi Unggul</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet" />

  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet" />

  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

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
  // 2. NAVBAR (Ini yang biasanya ada class sticky-top di dalamnya)
  // Ditaruh DI LUAR wrapper agar stickynya jalan
  include "header.php";
  include "koneksi.php";
  ?>

  <div style="overflow-x: hidden;">

    <section id="beranda" class="hero-section text-center text-lg-start">
      <div class="container">
        <div class="row align-items-center">
          <div
            class="col-lg-8 mx-auto text-center"
            data-aos="fade-up"
            data-aos-duration="1000">
            <h1 class="display-3 fw-bold mb-4">
              Wujudkan Masa Depan Gemilang Bersama Kami
            </h1>
            <p class="lead mb-4 opacity-75">
              Sekolah berbasis teknologi dan karakter yang siap mencetak
              generasi pemimpin masa depan yang kompeten dan berakhlak mulia.
            </p>

            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
              <a href="panduan">
                <button
                  type="button"
                  class="btn btn-orange btn-lg px-4 gap-3 rounded-pill shadow">
                  Daftar Sekarang
                </button>
              </a>
              <a href="profile">
                <button
                  type="button"
                  class="btn btn-outline-light btn-lg px-4 rounded-pill">
                  Lihat Profil
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-wave">
        <svg
          viewBox="0 0 1440 320"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="none">
          <path
            fill="#ffffff"
            fill-opacity="1"
            d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
      </div>
    </section>

    <section id="tentang" class="py-5">
      <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
          <h2 class="section-title">Kenapa Memilih Kami?</h2>
          <p class="text-muted">
            Fasilitas dan kurikulum terbaik untuk menunjang prestasi siswa.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card feature-card p-4 h-100 shadow-sm">
              <div class="icon-box">
                <i class="bi bi-laptop"></i>
              </div>
              <h4 class="card-title fw-bold">Digital Learning</h4>
              <p class="card-text text-muted">
                Sistem pembelajaran berbasis digital dengan fasilitas
                laboratorium komputer modern dan akses internet cepat.
              </p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card feature-card p-4 h-100 shadow-sm">
              <div class="icon-box">
                <i class="bi bi-award"></i>
              </div>
              <h4 class="card-title fw-bold">Akreditasi A</h4>
              <p class="card-text text-muted">
                Diakui oleh pemerintah dengan predikat unggul dalam manajemen
                sekolah dan kualitas pengajaran.
              </p>
            </div>
          </div>
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card feature-card p-4 h-100 shadow-sm">
              <div class="icon-box">
                <i class="bi bi-globe-americas"></i>
              </div>
              <h4 class="card-title fw-bold">Ekstrakurikuler</h4>
              <p class="card-text text-muted">
                Lebih dari 20 kegiatan ekstrakurikuler untuk mengembangkan bakat
                non-akademis siswa.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="ekskul" class="py-5 bg-light">
      <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
          <h5 class="text-primary fw-bold text-uppercase">Bakat & Minat</h5>
          <h2 class="fw-bold">Ekstrakurikuler Sekolah</h2>
          <p class="text-muted">
            Wadah bagi siswa untuk mengembangkan potensi, kreativitas, dan
            karakter di luar jam pelajaran.
          </p>
        </div>

        <div class="row g-4">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card border-0 shadow-sm h-100 card-hover">
              <div class="overflow-hidden" style="height: 200px">
                <img
                  src="img/2e777ee37f4ae91254f8aadf078347af.jpg"
                  class="card-img-top h-100 w-100 object-fit-cover"
                  alt="Pramuka" />
              </div>
              <div class="card-body p-4 text-center">
                <div
                  class="icon-circle bg-primary text-white mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 60px; height: 60px">
                  <i class="bi bi-compass-fill fs-3"></i>
                </div>
                <h4 class="fw-bold">Pramuka</h4>
                <p class="text-muted small">
                  Membentuk karakter mandiri, disiplin, dan cinta alam. Wajib
                  bagi seluruh siswa kelas 3-6.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card border-0 shadow-sm h-100 card-hover">
              <div class="overflow-hidden" style="height: 200px">
                <img
                  src="img/seni & tari.jpeg"
                  class="card-img-top h-100 w-100 object-fit-cover"
                  alt="Seni Tari" />
              </div>
              <div class="card-body p-4 text-center">
                <div
                  class="icon-circle bg-warning text-white mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 60px; height: 60px">
                  <i class="bi bi-music-note-beamed fs-3"></i>
                </div>
                <h4 class="fw-bold">Seni & Tari</h4>
                <p class="text-muted small">
                  Melestarikan budaya daerah dan mengembangkan bakat seni siswa
                  dalam menari dan bermusik.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card border-0 shadow-sm h-100 card-hover">
              <div class="overflow-hidden" style="height: 200px">
                <img
                  src="img/IMG_5648-scaled-1.webp"
                  class="card-img-top h-100 w-100 object-fit-cover"
                  alt="Futsal" />
              </div>
              <div class="card-body p-4 text-center">
                <div
                  class="icon-circle bg-success text-white mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle"
                  style="width: 60px; height: 60px">
                  <i class="bi bi-dribbble fs-3"></i>
                </div>
                <h4 class="fw-bold">Futsal Cilik</h4>
                <p class="text-muted small">
                  Melatih kerjasama tim, sportivitas, dan ketangkasan fisik
                  melalui olahraga sepak bola mini.
                </p>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
          <a
            href="kontak"
            class="btn btn-outline-primary rounded-pill px-4">Tanya Seputar Ekskul</a>
        </div>
      </div>
    </section>

    <section id="galeri" class="py-5 bg-light" data-aos="fade-up">
      <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
          <div>
            <h2 class="section-title mb-2">Galeri Kegiatan</h2>
            <p class="text-muted mb-0">Geser untuk melihat keseruan lainnya.</p>
          </div>
          <div class="d-none d-md-flex gap-2">
            <button class="btn btn-outline-primary rounded-circle shadow-sm" id="scrollLeftBtn">
              <i class="bi bi-arrow-left"></i>
            </button>
            <button class="btn btn-primary rounded-circle shadow-sm" id="scrollRightBtn">
              <i class="bi bi-arrow-right"></i>
            </button>
          </div>
        </div>

        <div class="gallery-wrapper" id="galleryScroll">

          <?php
          // Mengambil 10 foto terbaru. Pastikan kolom 'gambar' dan 'tanggal' sesuai database
          $query_galeri = mysqli_query($conn, "SELECT * FROM galeri ORDER BY tanggal DESC LIMIT 10");

          if (mysqli_num_rows($query_galeri) > 0) {
            while ($g = mysqli_fetch_assoc($query_galeri)) {
          ?>
              <div class="gallery-card">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                  <a href="img/<?= $g['gambar']; ?>" class="glightbox" data-gallery="galeri-sekolah">
                    <img src="img/<?= $g['gambar']; ?>" draggable="false" alt="<?= $g['judul']; ?>" style="height: 200px; width: 100%; object-fit: cover;" />
                  </a>
                  <div class="card-body">
                    <h6 class="fw-bold"><?= $g['judul']; ?></h6>
                    <small class="text-muted"><?= date('d M Y', strtotime($g['tanggal'])); ?></small>
                  </div>
                </div>
              </div>
          <?php
            }
          }
          ?>

          <div class="gallery-card d-flex align-items-center justify-content-center">
            <a href="galeri.php" class="text-decoration-none text-center see-all-animated">
              <div class="icon-circle-ripple shadow-sm">
                <div class="ripple"></div>
                <div class="ripple ripple-delay"></div>
                <i class="bi bi-arrow-right"></i>
              </div>
              <span class="d-block mt-3 fw-bold text-success">Lihat Semua</span>
            </a>
          </div>

        </div>
      </div>
    </section>

    <section class="stats-section">
      <div class="container text-center">
        <div class="row g-4">
          <div class="col-md-3">
            <h2 class="fw-bold display-4">500+</h2>
            <p class="mb-0">Siswa Aktif</p>
          </div>
          <div class="col-md-3">
            <h2 class="fw-bold display-4">15</h2>
            <p class="mb-0">Guru Bersertifikasi</p>
          </div>
          <div class="col-md-3">
            <h2 class="fw-bold display-4">10+</h2>
            <p class="mb-0">Ekstrakurikuler</p>
          </div>
          <div class="col-md-3">
            <h2 class="fw-bold display-4">98%</h2>
            <p class="mb-0">Lulusan PTN</p>
          </div>
        </div>
      </div>
    </section>

    <section id="kontak" class="py-5 bg-white">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-6" data-aos="fade-right">
            <h2 class="fw-bold mb-4">Kunjungi Sekolah Kami</h2>
            <p class="text-muted mb-4">
              Kami mengundang Anda untuk melihat langsung fasilitas dan
              lingkungan belajar yang asri di SDS Islam An Nur.
            </p>

            <div class="d-flex mb-3">
              <div
                class="icon-box me-3"
                style="width: 50px; height: 50px; font-size: 1.2rem">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">Alamat</h6>
                <p class="text-muted mb-0">
                  Gg. An Nur Jl. Kp. Baru, RT.002/RW.012, Ciapus, Kec. Ciomas,
                  Kabupaten Bogor, Jawa Barat 16610
                </p>
              </div>
            </div>

            <div class="d-flex mb-3">
              <div
                class="icon-box me-3"
                style="width: 50px; height: 50px; font-size: 1.2rem">
                <i class="bi bi-envelope-fill"></i>
              </div>
              <div>
                <h6 class="fw-bold mb-1">Email</h6>
                <p class="text-muted mb-0">info@sdsannur.sch.id</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left">
            <div class="map-container shadow rounded overflow-hidden">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.372791485109!2d106.75438439999999!3d-6.600508199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c510eec413c9%3A0xf736c80163f47cca!2sSDS%20Islam%20An-Nur%20Ciomas!5e0!3m2!1sen!2sid!4v1769232212712!5m2!1sen!2sid"
                width="100%"
                height="350"
                style="border: 0"
                allowfullscreen=""
                loading="lazy">
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="text-lg-start">
      <div class="container pb-5">
        <div class="row">
          <div class="col-lg-4 mb-4">
            <h5 class="text-white mb-3 fw-bold">SDS ISLAM AN NUR</h5>
            <p>
              Membentuk karakter, meraih prestasi, dan menyiapkan masa depan
              yang cerah bagi generasi bangsa.
            </p>
          </div>
          <div class="col-lg-2 mb-4">
            <h6 class="text-white mb-3 fw-bold">Tautan</h6>
            <ul class="list-unstyled">
              <li class="mb-2"><a href="profile">Profil Sekolah</a></li>
              <li class="mb-2"><a href="guru">Tenaga Pengajar</a></li>
              <li class="mb-2"><a href="alumni">Alumni</a></li>
              <li class="mb-2"><a href="kontak">Kontak</a></li>
            </ul>
          </div>
          <div class="col-lg-3 mb-4">
            <h6 class="text-white mb-3 fw-bold">Kontak Kami</h6>
            <ul class="list-unstyled">
              <li class="mb-2">
                <i class="bi bi-geo-alt me-2"></i> Gg. An Nur Jl. Kp. Baru,
                RT.002/RW.012, Ciapus, Kec. Ciomas, Kabupaten Bogor, Jawa Barat
                16610
              </li>
              <li class="mb-2">
                <i class="bi bi-telephone me-2"></i> 089696083849
              </li>
              <li class="mb-2">
                <i class="bi bi-envelope me-2"></i> info@sdsannur.sch.id
              </li>
            </ul>
          </div>
          <div class="col-lg-3 mb-4">
            <h6 class="text-white mb-3 fw-bold">Sosial Media</h6>
            <div class="d-flex gap-3">
              <a href="https://www.facebook.com/sdislamannur.sdislamannur/" target="_blank" rel="noopener noreferrer" class="fs-4"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/sekolahdasarannur?igsh=eHA0Y2FncHJva2Jp" target="_blank" rel="noopener noreferrer" class="fs-4"><i class="bi bi-instagram"></i></a>
              <a href="https://www.youtube.com/@sdsannur3943" target="_blank" rel="noopener noreferrer" class="fs-4"><i class="bi bi-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div
        class="text-center p-3 bg-dark text-white border-top border-secondary">
        © 2026 SDS Islam An Nur. All Rights Reserved.
      </div>
    </footer>

  </div> <a
    href="#"
    class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

  <script>
    const lightbox = GLightbox({
      selector: '.glightbox',
      touchNavigation: true,
      loop: true,
      descPosition: 'none'
    });
  </script>

  <script src="script.js"></script>
</body>

</html>