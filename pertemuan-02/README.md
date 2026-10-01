# pertemuan-02
Fondasi MVC Buatan Sendiri

1.Tujuan Praktikum
Praktikum ini bertujuan untuk memahami dan membangun fondasi arsitektur Model-View-Controller (MVC) buatan sendiri dari awal tanpa menggunakan full framework Mahasiswa dilatih untuk mengimplementasikan konsep front controller, sistem routing, pemanfaatan Base URL dan Helper, serta memahami alur penanganan permintaan request-response secara terstruktur.

2.Struktur Direktori
Berikut adalah struktur direktori proyek pada pertemuan P2:
```text
dpwl-nim/
├── application/
│   ├── config/
│   │   ├── config.php
│   │   └── routes.php
│   ├── controllers/
│   │   └── Home.php
│   ├── helpers/
│   │   └── url_helper.php
│   └── views/
│       └── home/
│           ├── index.php
│           └── info.php
├── assets/
│   └── css/
│       └── app.css
├── system/
│   └── core/
│       ├── Controller.php
│       └── Router.php
└── index.php

application/config/: Menyimpan berkas konfigurasi aplikasi seperti pengaturan base_url dan aturan routing.

application/controllers/: Menyimpan kelas controller untuk mengatur logika alur aplikasi.

application/helpers/: Menyimpan fungsi pembantu (helper) seperti pengelolaan URL.

application/views/: Menyimpan antarmuka atau templat tampilan (HTML) bagi pengguna.

assets/: Menyimpan aset statis seperti file CSS (app.css).

system/core/: Menyimpan inti dari kerangka buatan sendiri (Base Controller dan Router).

index.php: Berkas utama sebagai front controller (titik masuk tunggal)

3.Front Controller
Berkas index.php yang terletak pada root proyek bertindak sebagai Front Controller. Perannya adalah menjadi satu-satunya titik masuk (single entry point) bagi setiap permintaan dinamis (request) yang masuk ke aplikasi. Front Controller bertugas memuat seluruh konfigurasi awal, helper, kelas inti, dan rute, sebelum akhirnya meneruskan URI ke komponen Router untuk diproses lebih lanjut

4.Router dan Pemetaan URL

| URL/Route | Controller | Method | Parameter | View |
|---|---|---|---|---|
| | Home | index | | home/index.php |
| home/index | Home | index | | home/index.php |
| home/info/mvc | Home | info | mvc | home/info.php |
| info/routing | Home | info | routing | home/info.php |
| mobil/detail/avanza | Mobil | detail | avanza | mobil/detail.php |

*Penjelasan Modifikasi ATM:* Route kustom ditambahkan pada `routes.php` untuk memetakan objek dari studi kasus rental mobil (DPW), di mana URI `mobil/detail/(:any)` diarahkan ke *Controller* `Mobil`, *method* `detail($tipe)`, dengan membawa parameter jenis kendaraan yang ditampilkan melalui *view* `mobil/detail.php`.

5.Base URL dan Helper
base_url(): Berfungsi untuk menghasilkan alamat dasar aplikasi secara dinamis. Digunakan untuk memanggil aset eksternal, contohnya penyematan file CSS:
base_url('assets/css/app.css') $\rightarrow$ menghasilkan http://localhost/dpwl-nim/assets/css/app.css

site_url(): Berfungsi untuk menghasilkan tautan URL lengkap yang menyertakan index page (index.php) untuk keperluan navigasi rute aplikasi, contohnya:
site_url('info/routing') $\rightarrow$ menghasilkan http://localhost/dpwl-nim/index.php/info/routing

6.Alur Request Respon
jelaskan dua alur berikut:
1.Alur eksekusi aktual P2:$$\text{Browser} \rightarrow \text{index.php (Front Controller)} \rightarrow \text{Router} \rightarrow \text{Controller} \rightarrow \text{View} \rightarrow \text{Response}$$

2.Posisi Model dalam arsitektur MVC lengkap:$$\text{Browser} \rightarrow \text{index.php} \rightarrow \text{Router} \rightarrow \text{Controller} \rightarrow \text{Model} \longleftrightarrow \text{Basis Data} \rightarrow \text{Model} \rightarrow \text{Controller} \rightarrow \text{View} \rightarrow \text{Response}$$

7.Hasil Pengujian dan Debugging
Pengujian Sintaks: Seluruh berkas telah diuji melalui Terminal VS Code menggunakan perintah php -l [nama_berkas] dan menghasilkan status "No syntax errors detected".

Pengujian Fungsional:

Pengujian URL default dan routing langsung berjalan dengan baik menampilkan pesan dari controller.

Pengujian kondisi galat (error handling) seperti pengubahan nama view memicu penanganan galat yang sesuai (HTTP 500 / 404).

Catatan Debugging: Tidak ditemukan kendala berarti pada struktur logika inti setelah penyesuaian penulisan nama path direktori dan pemanggilan fungsi pada url_helper.php

8.Bukti Tangkapan Layar
  Gambar 1 - Hasil Pengujian Halaman Utama
![Gambar 1 - Halaman Utama](gambar 1.jpg)

  Gambar 2 - Hasil Pengujian Counter Route
![Gambar 2 - Counter Route](ganbar 2.jpg)
  
9.Kesimpulan P2
Kerangka kerja MVC buatan sendiri ini berhasil dibangun dan mampu menangani pemetaan URL (routing), pemisahan logika kontrol (Controller), serta penyajian antarmuka (View) secara konsisten melalui satu titik masuk (front controller). Pada pertemuan berikutnya (P3), fungsionalitas kerangka ini akan diperluas dengan menambahkan komponen Model, koneksi basis data menggunakan MySQLi/prepared statement, sesi, serta integrasi antarmuka AdminLTE