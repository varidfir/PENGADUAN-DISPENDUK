# Task Tracker: SIPPEL-DUKCAPIL

## 🛠 BACKEND PROGRESS

### Tahap 1: Setup Proyek & Struktur Dasar
- [x] Instalasi Laravel 12 via Composer
- [x] Konfigurasi file `.env` (Database MySQL)
- [x] Pembuatan folder custom (`app/Services`, dll)
- [x] Pembuatan routing custom (`routes/masyarakat.php`, `routes/petugas.php`, `routes/admin.php`)
- [x] Konfigurasi `bootstrap/app.php` atau `RouteServiceProvider` untuk memuat rute custom

### Tahap 2: Desain Database & Relasi
- [x] Migration tabel sistem
- [x] Model & Relasi
- [x] Seeder & Factory

### Tahap 3: Sistem Autentikasi & Hak Akses
- [x] Auth Controller (Login, Register, Logout)
- [x] Middleware Role-based

### Tahap 4: Modul Super Admin
- [x] Logika CRUD Data Masyarakat & Petugas
- [x] Logika CRUD Kategori Pengaduan & Kelola Penugasan
- [x] Logika CRUD Banner Landing Page
- [x] Logika Halaman Monitoring Seluruh Pengaduan (Data & Filter)
- [ ] Logika Cetak Laporan Pengaduan

### Tahap 5: Modul Masyarakat & Pengaduan
- [x] Logika Penyimpanan Pengaduan (Form + Upload)
- [x] Layanan Distribusi Pengaduan (Distribusi Pengaduan Service)

### Tahap 6: Modul Petugas & Tanggapan
- [x] Logika Detail & Simpan Tanggapan Pengaduan (Backend)
- [x] Logika Update Status & Log Status Pengaduan (Backend)

### Tahap 7: Notifikasi & Laporan
- [ ] Layanan Notifikasi (Notifikasi Service)
- [ ] Logika Pengolahan Data Statistik Dashboard
- [ ] Logika Export Laporan

### Tahap 8: Modul Profil
- [ ] Logika Update Profil
- [ ] Logika Ubah Password

---

## 🎨 FRONTEND PROGRESS

### Tahap 3: Sistem Autentikasi
- [x] Tampilan UI Login & Register

### Tahap 4: Modul Super Admin
- [x] Layout Utama Admin (Sidebar, Header)
- [x] Tampilan Halaman Dashboard Admin (Ringkasan Statistik)
- [x] Tampilan View Daftar Masyarakat & Petugas
- [x] Tampilan View Kategori & Penugasan
- [x] Tampilan View Kelola Banner
- [x] Tampilan View Monitoring Seluruh Pengaduan (Tabel)
- [x] Tampilan UI Detail Pengaduan Admin (Menampilkan Nama, NIK, dan No Telepon Pelapor)
- [ ] Tampilan UI Halaman Cetak Laporan Pengaduan

### Tahap 5: Modul Masyarakat
- [x] Tampilan Landing Page
- [x] Layout Utama Masyarakat & Halaman Dashboard
- [x] Tampilan UI Form Buat Pengaduan Baru (Beserta Upload)
- [x] Tampilan UI Detail Pengaduan dan Fitur Chat/Balasan untuk Masyarakat

### Tahap 6: Modul Petugas
- [x] Layout Utama Petugas & Halaman Dashboard
- [x] Menu Pengaduan di Sidebar Petugas & Halaman Daftar Pengaduan
- [x] Tampilan UI Detail Pengaduan Petugas (Menampilkan Nama, NIK, dan No Telepon Pelapor)

### Tahap 7: Statistik Dashboard
- [ ] Tampilan UI Statistik & Grafik Dashboard

### Tahap 8: Modul Profil
- [ ] Tampilan UI Halaman Edit Profil
- [ ] Tampilan UI Halaman Ubah Password

### Tahap 9: UI/UX & Finalisasi
- [ ] Evaluasi UX, Polish Tampilan Keseluruhan, dan Responsivitas (Tahap Akhir)
