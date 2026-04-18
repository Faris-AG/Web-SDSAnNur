<?php
include 'koneksi.php';
include 'header.php';

if (isset($_POST['daftar'])) {
    $no_reg = "REG-" . date('YmdHis');

    // Data Siswa
    $nama    = htmlspecialchars($_POST['nama']);
    $nik     = htmlspecialchars($_POST['nik']);
    $nisn    = htmlspecialchars($_POST['nisn']);
    $tempat  = htmlspecialchars($_POST['tempat_lahir']);
    $tgl     = htmlspecialchars($_POST['tgl_lahir']);
    $jk      = $_POST['jk'];
    $agama   = $_POST['agama'];
    $sekolah = htmlspecialchars($_POST['sekolah']);

    // Data Ayah & Ibu
    $n_ayah  = htmlspecialchars($_POST['nama_ayah']);
    $p_ayah  = htmlspecialchars($_POST['pekerjaan_ayah']);
    $h_ayah  = $_POST['pendidikan_ayah'];
    $n_ibu   = htmlspecialchars($_POST['nama_ibu']);
    $p_ibu   = htmlspecialchars($_POST['pekerjaan_ibu']);
    $h_ibu   = $_POST['pendidikan_ibu'];

    $hp      = htmlspecialchars($_POST['hp']);
    $alamat  = htmlspecialchars($_POST['alamat']);

    // Upload Berkas
    $folder = "uploads/";
    if (!is_dir($folder)) mkdir($folder, 0777, true);

    function uploadFile($fileInput, $folder, $prefix)
    {
        if ($_FILES[$fileInput]['name'] == "") return "";
        $ext = pathinfo($_FILES[$fileInput]['name'], PATHINFO_EXTENSION);
        $newName = $prefix . "_" . date('YmdHis') . "_" . rand(100, 999) . "." . $ext;
        move_uploaded_file($_FILES[$fileInput]['tmp_name'], $folder . $newName);
        return $newName;
    }

    $file_kk    = uploadFile('file_kk', $folder, 'KK');
    $file_akta  = uploadFile('file_akta', $folder, 'AKTA');
    $file_foto   = uploadFile('file_foto', $folder, 'FOTO');

    // Pastikan query sesuai dengan struktur tabel terbaru Anda
    $query = "INSERT INTO ppdb (no_registrasi, nama_siswa, nik, nisn, tempat_lahir, tgl_lahir, jenis_kelamin, agama, asal_sekolah, nama_ayah, pekerjaan_ayah, pendidikan_ayah, nama_ibu, pekerjaan_ibu, pendidikan_ibu, no_hp, alamat, file_kk, file_akta, file_foto, status) 
              VALUES ('$no_reg', '$nama', '$nik', '$nisn', '$tempat', '$tgl', '$jk', '$agama', '$sekolah', '$n_ayah', '$p_ayah', '$h_ayah', '$n_ibu', '$p_ibu', '$h_ibu', '$hp', '$alamat', '$file_kk', '$file_akta', '$file_foto', 'Pending')";

    $simpan = mysqli_query($conn, $query);

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if ($simpan) {
        echo "<script>
            setTimeout(function() {
                Swal.fire({
                    title: 'Pendaftaran Berhasil!',
                    html: 'Simpan Nomor Registrasi Anda: <br><b class=\"text-danger\" style=\"font-size:24px;\">$no_reg</b>',
                    icon: 'success',
                    confirmButtonText: 'Cek Status Sekarang'
                }).then(() => { window.location = 'cek-status.php'; });
            }, 100);
        </script>";
    }
}
?>

<style>
    .step-form { display: none; }
    .step-form.active { display: block; }
    .progress-container { margin-bottom: 30px; }
    .step-indicator { font-size: 0.8rem; color: #6c757d; }
    .step-indicator.active { color: #198754; font-weight: bold; }
</style>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="progress-container">
                    <div class="progress mb-2" style="height: 10px;">
                        <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 25%;"></div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="step-indicator active" id="ind-1">Siswa</span>
                        <span class="step-indicator" id="ind-2">Orang Tua</span>
                        <span class="step-indicator" id="ind-3">Kontak</span>
                        <span class="step-indicator" id="ind-4">Berkas</span>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form id="ppdbForm" action="" method="post" enctype="multipart/form-data">

                            <div class="step-form active" id="step-1">
                                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Step 1: Identitas Calon Siswa</h5>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap siswa" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">NIK</label>
                                    <input type="text" name="nik" class="form-control" pattern="\d{16}" maxlength="16" placeholder="Contoh: 3201xxxxxxxxxxxx" onkeypress="return isNumberKey(event)" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">NISN</label>
                                    <input type="text" name="nisn" class="form-control" pattern="\d{10}" maxlength="10" placeholder="Contoh: 0098xxxxxx" onkeypress="return isNumberKey(event)" required>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Jakarta" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label small fw-bold">Tgl Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Jenis Kelamin</label>
                                    <select name="jk" class="form-select" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Agama</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Asal TK/RA</label>
                                    <input type="text" name="sekolah" class="form-control" placeholder="Masukkan nama sekolah asal" required>
                                </div>
                            </div>

                            <div class="step-form" id="step-2">
                                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Step 2: Data Orang Tua</h5>
                                <div class="p-3 rounded mb-4 border-4">
                                    <p class="fw-bold mb-2 text-dark small">Data Ayah Kandung</p>
                                    <input type="text" name="nama_ayah" class="form-control mb-2" placeholder="Nama Lengkap Ayah" required>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <select name="pendidikan_ayah" class="form-select" required>
                                                <option value="">Pendidikan Terakhir</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                <option value="SD/SMP/SMA">SD/SMP/SMA</option>
                                                <option value="D3/S1">D3/S1</option>
                                                <option value="S2/S3">S2/S3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3 rounded border-4">
                                    <p class="fw-bold mb-2 text-dark small">Data Ibu Kandung</p>
                                    <input type="text" name="nama_ibu" class="form-control mb-2" placeholder="Nama Lengkap Ibu" required>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <select name="pendidikan_ibu" class="form-select" required>
                                                <option value="">Pendidikan Terakhir</option>
                                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                                                <option value="SD/SMP/SMA">SD/SMP/SMA</option>
                                                <option value="D3/S1">D3/S1</option>
                                                <option value="S2/S3">S2/S3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-form" id="step-3">
                                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Step 3: Kontak & Alamat</h5>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Nomor WhatsApp Aktif</label>
                                    <input type="text" name="hp" class="form-control" placeholder="Contoh: 08123456789" onkeypress="return isNumberKey(event)" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Jl. Merdeka No. 123, RT 01/02, Kecamatan..." required></textarea>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="checkWali" onchange="toggleWali()">
                                    <label class="form-check-label small" for="checkWali">Tinggal dengan Wali</label>
                                </div>
                                <div id="sectionWali" style="display: none;" class="p-3 bg-light rounded">
                                    <input type="text" name="nama_wali" class="form-control mb-2" placeholder="Masukkan nama lengkap wali">
                                    <input type="text" name="pekerjaan_wali" class="form-control mb-2" placeholder="Pekerjaan wali">
                                </div>
                            </div>

                            <div class="step-form" id="step-4">
                                <h5 class="fw-bold mb-4 border-bottom pb-2 text-primary">Step 4: Berkas Pendukung</h5>
                                <div class="mb-3">
                                    <label class="small fw-bold">Pas Foto 3x4</label>
                                    <input type="file" name="file_foto" class="form-control" accept="image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold">Kartu Keluarga (KK)</label>
                                    <input type="file" name="file_kk" class="form-control" accept=".pdf,image/*" required>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold">Akta Kelahiran</label>
                                    <input type="file" name="file_akta" class="form-control" accept=".pdf,image/*" required>
                                </div>
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" required>
                                    <label class="form-check-label small">Saya menyatakan data di atas benar.</label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <button type="button" class="btn btn-light" id="prevBtn" onclick="nextPrev(-1)" style="display: none;">Previous</button>
                                <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next Step</button>
                                <button type="submit" name="daftar" class="btn btn-primary" id="submitBtn" style="display: none;">Kirim Pendaftaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var currentStep = 0;
    showStep(currentStep);

    function showStep(n) {
        var steps = document.getElementsByClassName("step-form");
        steps[n].className += " active";
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (steps.length - 1)) {
            document.getElementById("nextBtn").style.display = "none";
            document.getElementById("submitBtn").style.display = "inline";
        } else {
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("submitBtn").style.display = "none";
        }
        updateProgress(n);
    }

    function nextPrev(n) {
        var steps = document.getElementsByClassName("step-form");
        if (n == 1 && !validateForm()) return false;
        steps[currentStep].classList.remove("active");
        currentStep = currentStep + n;
        showStep(currentStep);
    }

    function validateForm() {
        var steps = document.getElementsByClassName("step-form");
        var inputs = steps[currentStep].querySelectorAll("input, select, textarea");
        var valid = true;
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].hasAttribute("required") && inputs[i].value.trim() == "") {
                inputs[i].classList.add("is-invalid");
                valid = false;
                inputs[i].addEventListener('input', function() {
                    if (this.value.trim() !== "") {
                        this.classList.remove("is-invalid");
                    }
                });
                inputs[i].addEventListener('change', function() {
                    if (this.value !== "") {
                        this.classList.remove("is-invalid");
                    }
                });
            }
        }
        if (!valid) {
            steps[currentStep].querySelector(".is-invalid").focus();
        }
        return valid;
    }

    function updateProgress(n) {
        var progress = ((n + 1) / 4) * 100;
        document.getElementById("progress-bar").style.width = progress + "%";
        for (var i = 1; i <= 4; i++) {
            document.getElementById("ind-" + i).classList.remove("active", "text-success");
        }
        document.getElementById("ind-" + (n + 1)).classList.add("active", "text-success");
    }

    function toggleWali() {
        var section = document.getElementById("sectionWali");
        section.style.display = document.getElementById("checkWali").checked ? "block" : "none";
    }

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    // Filter otomatis untuk menghapus karakter non-angka saat input/paste
    document.querySelectorAll('input[name="nik"], input[name="nisn"], input[name="hp"]').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

    // --- TAMBAHAN FITUR ANTI-RELOAD ---

    // 1. Fungsi untuk menyimpan setiap input ke localStorage
    function saveToLocal() {
        const formData = new FormData(document.getElementById("ppdbForm"));
        formData.forEach((value, key) => {
            // Jangan simpan data file ke localStorage karena tidak didukung
            if (!(value instanceof File)) {
                localStorage.setItem('ppdb_' + key, value);
            }
        });
        // Simpan langkah terakhir ke sessionStorage
        sessionStorage.setItem('ppdb_step', currentStep);
    }

    // 2. Fungsi untuk memuat data saat halaman di-refresh
    function loadFromLocal() {
        const inputs = document.querySelectorAll("#ppdbForm input, #ppdbForm select, #ppdbForm textarea");
        inputs.forEach(input => {
            const savedValue = localStorage.getItem('ppdb_' + input.name);
            if (savedValue !== null && input.type !== 'file') {
                if (input.type === 'checkbox') {
                    input.checked = (savedValue === 'on');
                    if (input.id === 'checkWali') toggleWali(); // Sesuaikan tampilan wali
                } else {
                    input.value = savedValue;
                }
            }
        });

        // Kembalikan ke step terakhir
        const savedStep = sessionStorage.getItem('ppdb_step');
        if (savedStep !== null) {
            document.getElementsByClassName("step-form")[currentStep].classList.remove("active");
            currentStep = parseInt(savedStep);
            showStep(currentStep);
        }
    }

    // 3. Jalankan fungsi saat halaman siap
    document.addEventListener('DOMContentLoaded', function() {
        loadFromLocal();

        // Tambahkan event listener pada semua input untuk simpan otomatis
        const allInputs = document.querySelectorAll("#ppdbForm input, #ppdbForm select, #ppdbForm textarea");
        allInputs.forEach(input => {
            input.addEventListener('input', saveToLocal);
            input.addEventListener('change', saveToLocal);
        });
    });

    // 4. Bersihkan penyimpanan jika form berhasil dikirim
    document.getElementById("ppdbForm").addEventListener('submit', function() {
        const keys = Object.keys(localStorage);
        keys.forEach(key => {
            if (key.startsWith('ppdb_')) localStorage.removeItem(key);
        });
        sessionStorage.removeItem('ppdb_step');
    });
</script>

<?php include 'footer.php'; ?>