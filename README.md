# Custom Portal

Contoh custom plugin WordPress berbasis PHP untuk belajar struktur plugin, autentikasi, routing halaman, template, dan asset. Project ini dibuat sebagai sandbox sehingga dapat dijalankan tanpa instalasi WordPress atau database.

## Cara Menjalankan Project

Project ini menggunakan PHP built-in development server.

### 1. Pastikan PHP tersedia

PHP yang digunakan project ini berada di:

```text
C:\php-8.5.10\php.exe
```

Periksa versinya dari PowerShell:

```powershell
& "C:\php-8.5.10\php.exe" -v
```

### 2. Masuk ke folder project

Jalankan dari folder :

```powershell
cd .\custom-portal
```

### 3. Jalankan server PHP

```powershell
& "C:\php-8.5.10\php.exe" -S 127.0.0.1:8000
```

Jika berhasil, buka alamat berikut di browser:

```text
http://127.0.0.1:8000/
```

Untuk menghentikan server, tekan `Ctrl+C` di terminal.

### Login Demo

```text
Username: admin
Password: admin123
```

## Route yang Tersedia

| URL | Fungsi |
| --- | --- |
| `/?page=home` | Halaman utama portal |
| `/?page=login` | Halaman login |
| `/?page=dashboard` | Dashboard user yang sudah login |
| `/?page=admin` | Informasi administrasi portal |
| `/?page=logout` | Menghapus session dan keluar |

Dashboard akan mengarahkan user ke halaman login jika belum memiliki session login.

## Struktur Project

```text
custom-portal/
├── custom-portal.php
├── index.php
├── README.md
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── includes/
│   ├── class-admin.php
│   ├── class-auth.php
│   ├── class-pages.php
│   └── mock-wp-functions.php
└── templates/
    ├── admin.php
    ├── dashboard.php
    ├── home.php
    └── login.php
```

## Contoh Struktur Custom Plugin WordPress

Pada plugin WordPress sungguhan, struktur umumnya dapat dibuat seperti berikut:

```text
custom-portal/
├── custom-portal.php          # File utama dan header plugin
├── includes/                  # Class dan fungsi backend
│   ├── class-auth.php         # Login, logout, dan autentikasi
│   ├── class-pages.php        # Registrasi atau pengaturan halaman
│   └── class-admin.php        # Fitur halaman admin
├── templates/                 # File tampilan frontend dan admin
├── assets/                    # CSS, JavaScript, gambar, dan asset lain
│   ├── css/
│   └── js/
└── README.md                  # Dokumentasi plugin
```

WordPress biasanya memuat file utama plugin melalui header `Plugin Name`, kemudian file tersebut memanggil class, hook, shortcode, asset, dan fitur lain yang dibutuhkan. Project ini meniru pola tersebut dengan router sederhana agar dapat dipelajari tanpa WordPress.

## Fungsi Folder dan File

### File Root

- `custom-portal.php`: berisi header plugin WordPress seperti nama, deskripsi, dan versi. Dalam sandbox ini file tersebut hanya dokumentasi header; router yang dijalankan adalah `index.php`.
- `index.php`: entry point aplikasi. File ini memulai session, memuat dependency, membaca parameter `page`, memproses login/logout, dan meminta class halaman untuk menampilkan template.
- `README.md`: dokumentasi cara menjalankan project, route, struktur folder, serta fungsi file.

### Folder `includes/`

- `class-auth.php`: membungkus proses login dan logout melalui fungsi mock WordPress `wp_signon()` dan `wp_logout()`.
- `class-pages.php`: memilih template berdasarkan route yang diizinkan, mengirim data ke template, menyediakan informasi admin, dan melindungi dashboard dari user yang belum login.
- `class-admin.php`: menyediakan data informasi portal seperti nama, status, versi, URL site, dan shortcode untuk halaman admin.
- `mock-wp-functions.php`: berisi implementasi fungsi WordPress tiruan seperti login, logout, pengecekan user login, dan data user. File ini memungkinkan sandbox berjalan tanpa WordPress.

### Folder `templates/`

- `home.php`: tampilan halaman utama dan pengenalan portal.
- `login.php`: form untuk memasukkan username dan password serta menampilkan pesan error login.
- `dashboard.php`: tampilan dashboard setelah autentikasi berhasil.
- `admin.php`: tampilan informasi teknis dan status portal.

Template dipilih oleh `class-pages.php`, lalu dimuat dari folder ini menggunakan `require`.

### Folder `assets/`

- `css/style.css`: stylesheet utama untuk layout, warna, tipografi, form, dashboard, dan tampilan responsive.
- `js/app.js`: JavaScript frontend. Saat ini fungsinya menandai bahwa JavaScript aktif pada elemen HTML utama.

## Alur Kerja Aplikasi

```text
Browser membuka URL
	|
	v
index.php membaca route dan session
	|
	+--> class-auth.php untuk login/logout
	|
	+--> class-pages.php memilih halaman
	|
	v
templates/*.php menghasilkan HTML
	|
	v
assets/css/style.css dan assets/js/app.js memperindah halaman
```

## Catatan Untuk WordPress Sungguhan

Project ini hanya contoh pembelajaran. Saat dipindahkan ke WordPress asli:

- `index.php` dan router query sederhana diganti dengan hook WordPress.
- `mock-wp-functions.php` dihapus dan diganti fungsi WordPress asli.
- Login menggunakan sistem user WordPress melalui API yang sesuai.
- Asset didaftarkan menggunakan `wp_enqueue_style()` dan `wp_enqueue_script()`.
- Proteksi halaman admin perlu menggunakan capability seperti `current_user_can('manage_options')`.
- Data yang saat ini masih hard-coded sebaiknya diambil dari database atau pengaturan WordPress.
