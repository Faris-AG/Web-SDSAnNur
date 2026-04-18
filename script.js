// Inisialisasi AOS (Animate on Scroll)
AOS.init({
  once: true, // Animasi hanya terjadi sekali saat scroll
  offset: 100, // Mulai animasi sedikit sebelum elemen terlihat penuh
});

// Navbar Script: Ubah background saat discroll
const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 50) {
    navbar.classList.add("navbar-scrolled");
    navbar.classList.remove("navbar-dark");
    navbar.classList.add("navbar-light");
  } else {
    navbar.classList.remove("navbar-scrolled");
  }
});

// Back to top button logic
const backToTop = document.querySelector(".back-to-top");

if (backToTop) {
  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      backToTop.classList.add("active");
    } else {
      backToTop.classList.remove("active");
    }
  });
}

// --- Logic Tombol Scroll Galeri ---
const scrollContainer = document.getElementById("galleryScroll");
const leftBtn = document.getElementById("scrollLeftBtn");
const rightBtn = document.getElementById("scrollRightBtn");

if (scrollContainer && leftBtn && rightBtn) {
  // Tombol Kanan diklik
  rightBtn.addEventListener("click", () => {
    scrollContainer.scrollBy({
      left: 320, // Geser sejauh 320px (lebar kartu + gap)
      behavior: "smooth",
    });
  });

  // Tombol Kiri diklik
  leftBtn.addEventListener("click", () => {
    scrollContainer.scrollBy({
      left: -320, // Geser balik ke kiri
      behavior: "smooth",
    });
  });
}

// --- Logic Drag to Scroll (Mouse) ---
const slider = document.getElementById("galleryScroll");
let isDown = false;
let startX;
let scrollLeft;

if (slider) {
  // 1. Saat Mouse Ditekan (Klik Kiri Tahan)
  slider.addEventListener("mousedown", (e) => {
    isDown = true;
    slider.classList.add("active"); // Ubah kursor jadi menggenggam
    startX = e.pageX - slider.offsetLeft; // Catat posisi awal mouse
    scrollLeft = slider.scrollLeft; // Catat posisi scroll saat ini
  });

  // 2. Saat Mouse Keluar dari Area Galeri
  slider.addEventListener("mouseleave", () => {
    isDown = false;
    slider.classList.remove("active");
  });

  // 3. Saat Klik Dilepas
  slider.addEventListener("mouseup", () => {
    isDown = false;
    slider.classList.remove("active");
  });

  // 4. Saat Mouse Bergerak (Sambil ditekan)
  slider.addEventListener("mousemove", (e) => {
    if (!isDown) return; // Jika tidak sedang diklik, abaikan

    e.preventDefault(); // Mencegah blok teks atau drag gambar browser bawaan

    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2; // Angka 2 adalah kecepatan scroll (bisa diganti 1 atau 3)
    slider.scrollLeft = scrollLeft - walk;
  });
}

// Fungsi saat tombol Kirim ditekan
function KirimPesan(event) {
  event.preventDefault(); // 1. Tahan loading halaman

  // 2. Munculkan Popup
  const popup = document.getElementById("popup-success");
  popup.classList.add("show");

  // 3. Bersihkan Formulir
  event.target.reset();
}

// Fungsi saat tombol "Oke, Siap!" ditekan
function tutupPopup() {
  const popup = document.getElementById("popup-success");
  popup.classList.remove("show");
}

// ==================================================
// AUTO ACTIVE LINK & PREVENT RELOAD
// ==================================================

document.addEventListener("DOMContentLoaded", function () {
  // 1. Ambil nama halaman saat ini (misal: "profile.html")
  // window.location.pathname akan mengambil "/profile.html"
  // .split("/").pop() akan mengambil bagian terakhirnya saja
  let currentPage = window.location.pathname.split("/").pop();

  // Jika kosong (buka root folder), anggap itu index.html
  if (currentPage === "") currentPage = "index.html";

  // 2. Cari semua link di navigasi (Menu Atas & Dropdown)
  const navLinks = document.querySelectorAll(".nav-link, .dropdown-item");

  // 3. Cek satu per satu
  navLinks.forEach((link) => {
    // Ambil tujuan link (href)
    const linkPage = link.getAttribute("href");

    // 4. Jika tujuan link SAMA dengan halaman yang sedang dibuka...
    if (linkPage === currentPage) {
      // A. Tambahkan class 'active' (Biar warnanya hijau)
      link.classList.add("active");

      // B. Matikan fungsi klik (Biar GAK RELOAD)
      link.addEventListener("click", function (e) {
        e.preventDefault(); // Mencegah reload
      });

      // (Opsional) Jika ini adalah anak dropdown, bapaknya juga dikasih aktif
      if (link.classList.contains("dropdown-item")) {
        // Cari bapaknya (dropdown-toggle) dan kasih active juga
        const parentDropdown = link
          .closest(".dropdown")
          .querySelector(".dropdown-toggle");
        if (parentDropdown) {
          parentDropdown.classList.add("active");
        }
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const slider = document.getElementById("galleryScroll");
  let isDown = false;
  let startX;
  let scrollLeft;
  let moveDistance = 0; // Menghitung seberapa jauh mouse bergerak

  slider.addEventListener("mousedown", (e) => {
    isDown = true;
    slider.classList.add("active");
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    moveDistance = 0; // Reset jarak setiap klik baru
  });

  slider.addEventListener("mouseleave", () => {
    isDown = false;
  });

  slider.addEventListener("mouseup", (e) => {
    isDown = false;
    slider.classList.remove("active");
  });

  slider.addEventListener("mousemove", (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 2; // Kecepatan scroll
    slider.scrollLeft = scrollLeft - walk;

    // Tambahkan akumulasi jarak pergerakan
    moveDistance += Math.abs(e.movementX);
  });

  // LOGIKA PEMBEDA: Cegah Lightbox jika mouse bergeser
  const links = slider.querySelectorAll(".glightbox");
  links.forEach((link) => {
    link.addEventListener(
      "click",
      function (e) {
        // Jika mouse bergerak lebih dari 5px, batalkan pembukaan gambar
        if (moveDistance > 5) {
          e.preventDefault();
          e.stopImmediatePropagation();
        }
      },
      true,
    ); // Gunakan capturing phase (true) agar lebih prioritas
  });
});
