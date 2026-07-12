SIPPEL-DUKCAPIL
Sistem Informasi Pengaduan Pelayanan Dispendukcapil
Deskripsi Sistem
SIPPEL-DUKCAPIL merupakan sistem informasi berbasis web yang digunakan sebagai media pengaduan masyarakat terhadap pelayanan Dinas Kependudukan dan Pencatatan Sipil (Dispendukcapil). Sistem ini memungkinkan masyarakat menyampaikan pengaduan secara online, memantau status pengaduan, serta menerima notifikasi perkembangan pengaduan secara real-time. Sistem juga menerapkan distribusi pengaduan secara otomatis berdasarkan kategori layanan yang ditangani oleh petugas terkait.
________________________________________
Spesifikasi Perangkat Lunak
Komponen	Teknologi
Sistem Operasi	Windows 10 / Windows 11
Bahasa Pemrograman	PHP 8.2+
Framework	Laravel 12
Database	MySQL
Dependency Manager	Composer
Code Editor	Visual Studio Code
Version Control	Git & GitHub
________________________________________
Aktor Sistem
1. Masyarakat
Fitur
•	Registrasi Akun
•	Login
•	Dashboard
•	Membuat Pengaduan
•	Riwayat Pengaduan
•	Detail Pengaduan
•	Notifikasi
•	Profil Pengguna
•	Ubah Password
________________________________________
2. Petugas
Fitur
•	Login
•	Dashboard
•	Pengaduan Masuk Berdasarkan Kategori
•	Detail Pengaduan
•	Memberikan Tanggapan
•	Update Status Pengaduan
•	Notifikasi
•	Profil
•	Ubah Password
________________________________________
3. Super Admin
Fitur
•	Login
•	Dashboard
•	Kelola Data Masyarakat
•	Kelola Data Petugas
•	Kelola Kategori Pengaduan
•	Kelola Penugasan Kategori Petugas
•	Kelola Pengaduan
•	Kelola Banner Informasi
•	Monitoring Pengaduan
•	Laporan
•	Profil
•	Ubah Password
________________________________________
Dashboard Sistem
Landing Page
Menu dan Informasi
•	Banner Informasi
•	Tentang Sistem
•	Panduan Pengaduan
•	Kontak
•	Tombol Login
•	Tombol Registrasi
•	QR Code Website (Tidak perlu)
________________________________________
Dashboard Masyarakat
Informasi yang Ditampilkan
•	Total Pengaduan
•	Pengaduan Menunggu
•	Pengaduan Diproses
•	Pengaduan Selesai
•	Riwayat Pengaduan Terbaru
________________________________________
Dashboard Petugas
Informasi yang Ditampilkan
•	Jumlah Pengaduan Baru
•	Jumlah Pengaduan Diproses
•	Jumlah Pengaduan Selesai
•	Daftar Pengaduan Berdasarkan Kategori yang Ditangani
•	Daftar Kategori Tugas Petugas
________________________________________
Dashboard Super Admin
Informasi yang Ditampilkan
•	Total Pengaduan
•	Total Masyarakat
•	Total Petugas
•	Total Kategori
•	Total Penugasan Kategori
•	Grafik Pengaduan per Bulan
•	Grafik Pengaduan per Kategori
•	Grafik Status Pengaduan
________________________________________
Status Pengaduan
Status	Keterangan
Menunggu	Pengaduan berhasil dikirim dan belum ditindaklanjuti
Diproses	Pengaduan sedang ditangani petugas
Selesai	Pengaduan telah selesai ditindaklanjuti
Ditolak	Pengaduan tidak dapat diproses karena alasan tertentu
________________________________________
Kategori Pengaduan
1.	KTP Elektronik (e-KTP)
2.	Kartu Keluarga (KK)
3.	Akta Kelahiran
4.	Akta Kematian
5.	Kartu Identitas Anak (KIA)
6.	Surat Pindah Datang
7.	Perubahan Data Kependudukan
8.	Layanan Administrasi Kependudukan Lainnya

________________________________________
Alur Sistem
Scan QR Code / Buka Website
            │
            ▼
       Landing Page
            │
            ▼
    Login / Registrasi
            │
            ▼
   Dashboard Masyarakat
            │
            ▼
      Buat Pengaduan
            │
            ▼
      Pilih Kategori
            │
            ▼
      Upload Lampiran
            │
            ▼
     Simpan Pengaduan
            │
            ▼
    Status: Menunggu
            │
            ▼
 Sistem Mencari Petugas
 Berdasarkan Kategori
            │
            ▼
 Pengaduan Masuk ke
 Daftar Petugas Terkait
            │
            ▼
 Petugas Membuka Pengaduan
            │
            ▼
 Petugas Memberikan
      Tanggapan
            │
            ▼
   Status: Diproses
            │
            ▼
 Notifikasi ke Masyarakat
            │
            ▼
 Status: Selesai / Ditolak
            │
            ▼
 Notifikasi ke Masyarakat
            │
            ▼
 Riwayat Pengaduan
      Tersimpan
________________________________________
Kebutuhan Fungsional Sistem
1. Modul Autentikasi
Fungsi
•	Registrasi Akun
•	Login
•	Logout
•	Ubah Password
________________________________________
2. Modul Pengaduan
Fungsi
•	Membuat Pengaduan
•	Memilih Kategori Pengaduan
•	Upload Lampiran/Bukti Pendukung
•	Menyimpan Pengaduan
•	Melihat Riwayat Pengaduan
•	Melihat Detail Pengaduan
________________________________________
3. Modul Distribusi Pengaduan
Fungsi
•	Pengaduan otomatis diteruskan ke petugas berdasarkan kategori yang dipilih masyarakat.
•	Satu kategori dapat ditangani oleh lebih dari satu petugas.
•	Satu petugas dapat menangani lebih dari satu kategori.
•	Petugas hanya dapat melihat pengaduan sesuai kategori yang menjadi tanggung jawabnya.
•	Super Admin dapat mengatur penugasan kategori kepada petugas.
________________________________________
4. Modul Tanggapan
Fungsi
•	Melihat Detail Pengaduan
•	Memberikan Tanggapan
•	Mengubah Status Pengaduan
________________________________________
5. Modul Notifikasi
Fungsi
•	Notifikasi Pengaduan Diterima
•	Notifikasi Pengaduan Diproses
•	Notifikasi Pengaduan Selesai
•	Notifikasi Pengaduan Ditolak
________________________________________
6. Modul Manajemen
Fungsi
•	Kelola Data Masyarakat
•	Kelola Data Petugas
•	Kelola Kategori Pengaduan
•	Kelola Penugasan Kategori Petugas
•	Monitoring Pengaduan
•	Cetak Laporan
________________________________________
Notifikasi Sistem
Contoh Notifikasi
1.	Pengaduan Anda berhasil dikirim.
2.	Pengaduan Anda sedang diproses oleh petugas.
3.	Petugas telah memberikan tanggapan pada pengaduan Anda.
4.	Pengaduan Anda telah selesai diproses.
5.	Pengaduan Anda ditolak. Silakan periksa detail tanggapan petugas.





________________________________________
Struktur Proyek Laravel 12
sipel-dukcapil/
│
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Kategori.php
│   │   ├── PetugasKategori.php
│   │   ├── Pengaduan.php
│   │   ├── Lampiran.php
│   │   ├── Tanggapan.php
│   │   ├── Notifikasi.php
│   │   ├── LogStatus.php
│   │   └── Banner.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── LandingController.php
│   │   │
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   ├── RegisterController.php
│   │   │   └── LogoutController.php
│   │   │
│   │   ├── Masyarakat/
│   │   │   ├── DashboardController.php
│   │   │   ├── PengaduanController.php
│   │   │   ├── NotifikasiController.php
│   │   │   ├── ProfilController.php
│   │   │   └── PasswordController.php
│   │   │
│   │   ├── Petugas/
│   │   │   ├── DashboardController.php
│   │   │   ├── PengaduanController.php
│   │   │   ├── TanggapanController.php
│   │   │   ├── NotifikasiController.php
│   │   │   ├── ProfilController.php
│   │   │   └── PasswordController.php
│   │   │
│   │   └── Admin/
│   │       ├── DashboardController.php
│   │       ├── UserController.php
│   │       ├── PetugasController.php
│   │       ├── KategoriController.php
│   │       ├── PetugasKategoriController.php
│   │       ├── PengaduanController.php
│   │       ├── BannerController.php
│   │       ├── LaporanController.php
│   │       ├── ProfilController.php
│   │       └── PasswordController.php
│   │
│   ├── Middleware/
│   │   ├── SuperAdminMiddleware.php
│   │   ├── PetugasMiddleware.php
│   │   └── MasyarakatMiddleware.php
│   │
│   └── Services/
│       ├── NotifikasiService.php
│       ├── PengaduanService.php
│       ├── DistribusiPengaduanService.php
│       └── LaporanService.php
│
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       ├── PetugasSeeder.php
│       ├── KategoriSeeder.php
│       └── PetugasKategoriSeeder.php
│
├── resources/
│   ├── views/
│   ├── css/
│   ├── js/
│   └── images/
│
├── routes/
│   ├── web.php
│   ├── auth.php
│   ├── masyarakat.php
│   ├── petugas.php
│   └── admin.php
│
├── storage/
│   └── app/public/
│       ├── pengaduan/
│       ├── banner/
│       └── qrcode/
│
└── public/
    ├── assets/
    ├── uploads/
    └── qrcode/

Admin master
Email: admin@sippel.com
Password: password

Petugas
Email: petugas1@sippel.com
Password: petugas123

