# Mini Project (Simplified): Belajar Struktur Custom WordPress Plugin — Portal & Authentication

> **Versi revisi.** Tidak perlu install WordPress, XAMPP, Laragon, atau database apa pun.
> Cukup PHP terinstall di komputer, lalu jalankan lewat **PHP built-in server** dan buka di browser.
> Tujuannya: memahami **struktur folder plugin** dan **alur/flow-nya**, bukan deploy production.

---

## 1. Tujuan

Belajar bagaimana sebuah custom WordPress plugin **disusun** (folder, file, penamaan) dan bagaimana **flow-nya bekerja** (homepage → login → dashboard → admin), tanpa harus punya WordPress sungguhan dulu.

Yang dipelajari:

- struktur folder plugin WordPress yang umum dipakai
- konsep shortcode (disimulasikan)
- pemisahan public UI vs authenticated UI
- konsep "capability check" untuk admin page (disimulasikan)
- flow login/logout sederhana

Nanti kalau sudah nyaman dengan strukturnya, project ini tinggal dipindahkan ke `wp-content/plugins/` di WordPress asli, dan fungsi-fungsi mock diganti dengan fungsi WordPress asli (`wp_signon()`, `is_user_logged_in()`, dst).

Jangan menggunakan Laravel, React, Vue, Next.js, Tailwind, atau framework lain.

---

## 2. Tech Stack (disederhanakan)

- PHP Native (tanpa WordPress)
- HTML5 + CSS3
- JavaScript vanilla (opsional)
- **Tidak perlu MySQL/MariaDB** — data user cukup array PHP biasa (in-memory / hardcoded)
- **Tidak perlu XAMPP/Laragon/Docker** — cukup jalankan:

```bash
php -S localhost:8000
```

lalu buka `http://localhost:8000/` di browser.

Syarat: PHP sudah terinstall di komputer (cek dengan `php -v`).

---

## 3. Konsep Project

Nama project tetap dibuat menyerupai struktur plugin:

`custom-portal/`

Karena tidak ada WordPress, kita simulasikan "plugin" sebagai aplikasi PHP kecil yang **strukturnya identik** dengan struktur plugin WordPress, plus satu file router (`index.php`) yang menggantikan peran WordPress rewrite/routing.

Flow tetap sama seperti rencana awal:

```text
PUBLIC USER
    |
    v
Homepage
    |
    +--> CTA "Login"
    v
Login
    |
    +--> Login gagal --> kembali ke Login
    +--> Login berhasil --> Dashboard

ADMIN (simulasi)
Admin Page --> Status --> Version --> "Shortcode" Info
```

---

## 4. Struktur Folder

```text
custom-portal/
│
├── index.php                 <-- router sederhana (pengganti WordPress routing)
├── custom-portal.php         <-- header plugin (dokumentasi saja, tidak dieksekusi WP)
│
├── includes/
│   ├── mock-wp-functions.php <-- versi mock dari fungsi WP: is_user_logged_in(), wp_signon(), dll
│   ├── class-pages.php
│   ├── class-auth.php
│   └── class-admin.php
│
├── templates/
│   ├── home.php
│   ├── login.php
│   ├── dashboard.php
│   └── admin.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
│
└── README.md
```

Struktur ini **sengaja dibuat sama** dengan struktur plugin WordPress asli, supaya nanti gampang dipindahkan.

---

## 5. Cara Menjalankan (Testing di Browser)

```bash
cd custom-portal
php -S localhost:8000
```

Buka browser:

| Halaman | URL |
|---|---|
| Homepage | `http://localhost:8000/` |
| Login | `http://localhost:8000/?page=login` |
| Dashboard (butuh login) | `http://localhost:8000/?page=dashboard` |
| Admin (simulasi) | `http://localhost:8000/?page=admin` |

`index.php` membaca parameter `?page=` dan me-load template yang sesuai dari folder `templates/` — ini mensimulasikan cara WordPress memetakan shortcode/URL ke template plugin.

---

## 6. Mock WordPress Functions

Karena tidak pakai WordPress, buat file `includes/mock-wp-functions.php` berisi fungsi-fungsi dengan **nama dan perilaku mirip** fungsi WordPress asli, supaya konsepnya tetap kebawa:

```php
function is_user_logged_in() {
    return isset($_SESSION['user']);
}

function wp_signon($username, $password) {
    // dummy user, hanya untuk simulasi login
    $valid_users = ['admin' => 'admin123'];
    if (isset($valid_users[$username]) && $valid_users[$username] === $password) {
        $_SESSION['user'] = [
            'display_name' => 'Administrator',
            'user_login'   => $username,
            'user_email'   => 'admin@example.test',
            'role'         => 'administrator',
        ];
        return true;
    }
    return false;
}

function wp_get_current_user() {
    return $_SESSION['user'] ?? null;
}

function wp_logout() {
    unset($_SESSION['user']);
}
```

Ini hanya untuk latihan struktur. Password di sini **hanya contoh untuk simulasi lokal**, bukan praktik yang direkomendasikan untuk sistem sungguhan.

---

## 7. Homepage

Sama seperti rencana awal:

- Header + Navigation (berubah sesuai status login)
- Hero section + CTA "Get Started"
- About section
- Footer

CTA "Get Started":
- Belum login → arahkan ke `?page=login`
- Sudah login → arahkan ke `?page=dashboard`

---

## 8. Login

Form sederhana (Username + Password), submit ke `?page=login`, proses dengan `wp_signon()` versi mock.

- Login gagal → tampilkan error, tetap di halaman login
- Login berhasil → redirect ke `?page=dashboard`

Kredensial contoh untuk testing: `admin` / `admin123`

---

## 9. Dashboard (Protected)

Cek `is_user_logged_in()` di awal template. Kalau belum login → redirect ke `?page=login`.

Tampilkan data dari `wp_get_current_user()`:
- display name
- username
- email
- role

Tombol **Logout** memanggil `wp_logout()` lalu redirect ke `?page=login`.

---

## 10. Admin Page (Simulasi)

Halaman `?page=admin` menampilkan info statis, mensimulasikan custom admin page di WordPress:

```text
Custom Portal
Status: Active
Version: 1.0.0
Site URL: http://localhost:8000/
Available Shortcode: [custom_portal_home]
```

Di versi ini, tidak ada capability check sungguhan (karena tidak ada sistem role WordPress) — cukup catat di komentar kode bahwa nantinya harus dibatasi dengan `current_user_can('manage_options')`.

---

## 11. Yang TIDAK perlu dilakukan di versi sederhana ini

- Install WordPress
- Install XAMPP/Laragon/Docker
- Setup database MySQL
- Membuat WordPress page/shortcode sungguhan
- Nonce & capability check sungguhan (cukup dicatat sebagai TODO)

---

## 12. Rencana Migrasi ke WordPress Asli (Fase Berikutnya)

Setelah struktur & flow ini dipahami, langkah lanjutan (di luar scope project ini):

```text
mock-wp-functions.php  →  dihapus
is_user_logged_in()    →  pakai fungsi WordPress asli
wp_signon()            →  pakai fungsi WordPress asli
index.php router       →  diganti shortcode API WordPress
templates/*.php        →  tetap dipakai, tinggal disesuaikan
```

Folder `custom-portal/` lalu dipindahkan ke `wp-content/plugins/custom-portal/` di instalasi WordPress lokal.

---

## 13. Testing Checklist (Browser Saja)

- [ ] `php -S localhost:8000` berjalan tanpa error
- [ ] Homepage tampil di `/`
- [ ] Navigation berubah setelah login
- [ ] Login gagal menampilkan error
- [ ] Login berhasil redirect ke dashboard
- [ ] Dashboard tidak bisa diakses tanpa login (redirect ke login)
- [ ] Dashboard menampilkan display name, username, email, role
- [ ] Logout mengembalikan ke login & session hilang
- [ ] Admin page menampilkan status, version, site URL, shortcode info
- [ ] Tidak ada PHP fatal error di semua halaman

---

## 14. Catatan Penting

Project ini adalah **sandbox belajar struktur**, bukan plugin WordPress yang bisa langsung di-upload dan diaktifkan di WordPress. Untuk versi yang benar-benar bisa diaktifkan sebagai plugin WordPress, tetap dibutuhkan instalasi WordPress (bisa menyusul kapan saja setelah struktur dan flow-nya sudah dipahami).
