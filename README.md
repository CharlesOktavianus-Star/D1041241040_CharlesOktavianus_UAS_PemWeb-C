TANYAIN - FORUM DISKUSI AKADEMIK
================================

TEKNOLOGI
- PHP native
- HTML
- CSS internal (di header.php)
- MySQL
- Tidak memakai framework atau JavaScript eksternal.

CARA MENJALANKAN (XAMPP)
1. Salin folder tanyain ke C:\xampp\htdocs\
2. Jalankan Apache dan MySQL dari XAMPP.
3. Buka http://localhost/phpmyadmin
4. Pilih menu Import, lalu impor file database.sql.
5. Buka config.php. Sesuaikan $dbuser dan $dbpass dengan MySQL kamu.
6. Buka http://localhost/tanyain/ di browser.
7. Daftar akun pertama. Akun pertama otomatis menjadi Developer.
8. Daftar akun kedua dan seterusnya akan menjadi Member.

ATURAN ROLE
- Pengunjung: hanya membaca pertanyaan dan jawaban.
- Member: membuat pertanyaan dan menjawab; mengubah/menghapus pertanyaan miliknya sendiri.
- Developer: membuat pertanyaan dan menjawab; mengubah/menghapus semua pertanyaan.
- Akun pertama yang mendaftar otomatis mendapat role Developer.

FILE PENTING
- config.php       : koneksi database dan session.
- functions.php    : fungsi bantuan dan pemeriksaan hak akses.
- header.php       : navigasi dan desain CSS.
- index.php        : halaman utama, pencarian, dan kategori.
- register.php     : pendaftaran dan penentuan Developer pertama.
- login.php        : autentikasi pengguna.
- ask.php          : tambah pertanyaan.
- edit.php         : ubah pertanyaan.
- delete.php       : hapus pertanyaan.
- view.php         : detail pertanyaan dan jawaban.
- theme.php        : switch light/dark mode.
- database.sql     : struktur database.

CATATAN
Untuk pengujian, jangan hapus akun Developer pertama sebelum menunjuk akun lain sebagai Developer.
Gunakan hanya untuk pembelajaran/lokal sebelum deployment publik. Untuk produksi, tambahkan HTTPS,
rate limiting, verifikasi email, dan pengelolaan akun yang lebih lengkap.

Jalankan :
& "C:\xampp\php\php.exe" -v
saat di VS Code, untuk memastikan php sudah terinstal

di Terminal :
& "C:\xampp\php\php.exe" -S localhost:8000
untuk runningnya

Pastikan akun root tidak ada passwordnya:
& "C:\xampp\mysql\bin\mysql.exe" -u root

masuk ke database MySQL bernama tanyain melalui terminal VS Code:
& "C:\xampp\mysql\bin\mysql.exe" -u root tanyain
## Progres Tahap 1
- Repository GitHub: https://github.com/CharlesOktavianus-Star/D1041241040_CharlesOktavianus_UAS_PemWeb-C
- Ringkasan progres tahap 1: Inisialisasi repository, setup konfigurasi/database/layout, autentikasi pengguna (register, login, logout), dan fitur CRUD forum pada branch feat/forum-core.
