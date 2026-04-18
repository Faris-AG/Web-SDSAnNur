<?php session_start(); ?>
<!doctype html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/x-icon" href="img/icon.png">
  <title>Hubungi Kami - SDS Islam An Nur</title>

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
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <?php
  // 1. NAVBAR (Sticky-top ada di sini)
  // Ditaruh di LUAR wrapper agar tetap menempel saat scroll
  include "header.php";
  include "koneksi.php";

  // Logika Pengiriman Pesan
  if (isset($_POST['kirim'])) {
      
      // Cek Captcha
      if (!isset($_SESSION['hasil_captcha'])) {
        $captcha_valid = false;
      } else {
        $captcha_valid = ($_POST['jawaban_user'] == $_SESSION['hasil_captcha']);
      }

      if (!$captcha_valid) {
          echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
          echo "<script>
              setTimeout(function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Hitungan Salah!',
                      text: 'Mohon isi jawaban matematika dengan benar.',
                  }).then(function() {
                      window.history.back(); 
                  });
              }, 100);
          </script>";
          exit;
      }
      
      // Tangkap Data
      $nama   = htmlspecialchars($_POST['nama']);
      $email  = htmlspecialchars($_POST['email']);
      $subjek = htmlspecialchars($_POST['subjek']);
      $pesan  = htmlspecialchars($_POST['pesan']);

      // Simpan ke Database
      $insert = mysqli_query($conn, "INSERT INTO bukutamu (nama, email, subjek, pesan) 
                                     VALUES ('$nama', '$email', '$subjek', '$pesan')");

      // Notifikasi Sukses/Gagal
      echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
      if ($insert) {
        echo "<script>
              setTimeout(() => {
                  Swal.fire({
                      title: 'Terkirim!',
                      text: 'Terima kasih, pesan Anda telah kami terima.',
                      icon: 'success',
                      confirmButtonColor: '#155e37'
                  });
              }, 100);
          </script>";
      } else {
        echo "<script>setTimeout(() => Swal.fire('Gagal!', 'Sistem sedang sibuk.', 'error'), 100);</script>";
      }
  }
  ?>

  <div style="overflow-x: hidden;">

      <header
        class="page-header py-5 text-white position-relative overflow-hidden">
        <div
          class="container py-5 position-relative z-2 text-center text-lg-start">
          <h1 class="display-4 fw-bold" data-aos="fade-down">Hubungi Kami</h1>
          <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
            <ol
              class="breadcrumb justify-content-center justify-content-lg-start mb-0">
              <li class="breadcrumb-item">
                <a href="/" class="text-white-50 text-decoration-none">Beranda</a>
              </li>
              <li class="breadcrumb-item active text-white" aria-current="page">
                Kontak
              </li>
            </ol>
          </nav>
        </div>
      </header>

      <section class="py-5">
        <div class="container py-4">
          <div class="row g-5">
            <div class="col-lg-4" data-aos="fade-right">
              <div class="bg-light p-4 rounded-4 shadow-sm h-100">
                <h4 class="fw-bold mb-4 text-primary">Informasi Sekolah</h4>

                <div class="d-flex align-items-start mb-4">
                  <div class="icon-box me-3 flex-shrink-0">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-1">Alamat</h6>
                    <p class="text-muted small mb-0">
                      Gg. An Nur Jl. Kp. Baru, RT.002/RW.012, Ciapus, Kec. Ciomas,
                      Kabupaten Bogor, Jawa Barat 16610
                    </p>
                  </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                  <div class="icon-box me-3 flex-shrink-0">
                    <i class="bi bi-telephone-fill"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-1">Telepon</h6>
                    <p class="text-muted small mb-0">(0251) 8345678</p>
                    <p class="text-muted small mb-0">+62 896-9608-3849 (WA)</p>
                  </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                  <div class="icon-box me-3 flex-shrink-0">
                    <i class="bi bi-envelope-fill"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-1">Email</h6>
                    <p class="text-muted small mb-0">info@sdsannur.sch.id</p>
                    <p class="text-muted small mb-0">admin@sdsannur.sch.id</p>
                  </div>
                </div>

                <div class="d-flex align-items-start">
                  <div class="icon-box me-3 flex-shrink-0">
                    <i class="bi bi-clock-fill"></i>
                  </div>
                  <div>
                    <h6 class="fw-bold mb-1">Jam Operasional</h6>
                    <p class="text-muted small mb-0">
                      Senin - Jumat: 07.00 - 13.00
                    </p>
                    <p class="text-muted small mb-0">Sabtu - Minggu: Tutup</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
              <div class="mb-5">
                <h2 class="fw-bold mb-3">Kirim Pesan</h2>
                <p class="text-muted mb-4">
                  Punya pertanyaan seputar pendaftaran atau kegiatan sekolah?
                  Silakan isi form di bawah ini.
                </p>

                <form action="" method="post">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <input
                        type="text"
                        name="nama"
                        class="form-control py-3 bg-light border-0"
                        placeholder="Nama Lengkap"
                        required />
                    </div>
                    <div class="col-md-6">
                      <input
                        type="email"
                        name="email"
                        class="form-control py-3 bg-light border-0"
                        placeholder="Alamat Email"
                        required />
                    </div>
                    <div class="col-12">
                      <input
                        type="text"
                        name="subjek"
                        class="form-control py-3 bg-light border-0"
                        placeholder="Subjek / Judul Pesan"
                        required />
                    </div>
                    <div class="col-12">
                      <textarea
                        name="pesan"
                        class="form-control py-3 bg-light border-0"
                        rows="5"
                        placeholder="Tulis pesan Anda di sini..."
                        required></textarea>
                    </div>
                    
                    <div class="col-12">
                        <div class="p-3 border rounded bg-white">
                            <label class="form-label fw-bold text-success">Keamanan (Anti Spam) <span class="text-danger">*</span></label>
                            <?php
                                $angka1 = rand(1, 9);
                                $angka2 = rand(1, 9);
                                $_SESSION['hasil_captcha'] = $angka1 + $angka2;
                            ?>
                            <p class="mb-2">Berapa hasil dari: <strong class="fs-5"><?php echo $angka1; ?> + <?php echo $angka2; ?></strong> ?</p>
                            <input type="number" name="jawaban_user" class="form-control py-3 bg-light" required placeholder="Tulis jawabannya (angka)">
                        </div>
                    </div>

                    <div class="col-12">
                      <button
                        type="submit"
                        name="kirim"
                        class="btn btn-primary px-5 py-3 rounded-pill fw-bold">
                        <i class="bi bi-send me-2"></i> Kirim Pesan
                      </button>
                    </div>
                  </div>
                </form>
              </div>

              <div>
                <h4 class="fw-bold mb-3">Lokasi Kami</h4>
                <div class="rounded-4 overflow-hidden shadow-sm border">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.372791485109!2d106.75438439999999!3d-6.600508199999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c510eec413c9%3A0xf736c80163f47cca!2sSDS%20Islam%20An-Nur%20Ciomas!5e0!3m2!1sen!2sid!4v1769232212712!5m2!1sen!2sid"
                    width="100%"
                    height="350"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php include "footer.php"; ?>

  </div> <div id="popup-success" class="popup-overlay">
    <div class="popup-content">
      <div class="popup-icon">
        <i class="bi bi-check-circle-fill"></i>
      </div>
      <h3 class="fw-bold mb-2">Pesan Terkirim!</h3>
      <p class="text-muted mb-4">
        Terima kasih telah menghubungi kami.<br />Admin akan segera membalas
        pesan Anda.
      </p>
      <button
        onclick="tutupPopup()"
        class="btn btn-primary rounded-pill px-5 fw-bold">
        Oke, Siap!
      </button>
    </div>
  </div>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="script.js"></script>
</body>
</html>