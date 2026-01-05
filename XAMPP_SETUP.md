# Panduan Setup XAMPP untuk Project PBO-CI

## Perubahan yang Telah Dilakukan

Project ini telah dimodifikasi untuk menggunakan base URL XAMPP menggantikan virtual host. Berikut perubahan yang dilakukan:

### 1. File: `app/Config/App.php`
- **baseURL** diubah dari `http://pbo-wildan/` menjadi `http://localhost/pbo-ci/`
- **indexPage** diubah dari `'index.php'` menjadi `''` (kosong) untuk URL yang lebih bersih

### 2. File: `public/.htaccess`
- **RewriteBase** di-uncomment dan diset menjadi `/pbo-ci/`

## Cara Setup di XAMPP

### Langkah 1: Pindahkan Project ke htdocs
```bash
# Pindahkan atau copy folder project ke direktori htdocs XAMPP
# Contoh di Windows:
C:\xampp\htdocs\pbo-ci\

# Contoh di macOS:
/Applications/XAMPP/htdocs/pbo-ci/

# Contoh di Linux:
/opt/lampp/htdocs/pbo-ci/
```

### Langkah 2: Setup Database
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Buat database baru sesuai dengan konfigurasi di `app/Config/Database.php`
3. Import database jika ada file SQL backup

### Langkah 3: Konfigurasi Database (Jika Diperlukan)
Edit file `app/Config/Database.php` sesuai dengan setting XAMPP Anda:
```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',  // biasanya kosong di XAMPP
'database' => 'nama_database_anda',
```

### Langkah 4: Akses Aplikasi
Buka browser dan akses:
```
http://localhost/pbo-ci/
```

atau untuk langsung ke public folder:
```
http://localhost/pbo-ci/public/
```

## Catatan Penting

### Mod Rewrite
Pastikan mod_rewrite sudah diaktifkan di Apache XAMPP:
1. Buka file `httpd.conf` (biasanya di `xampp/apache/conf/httpd.conf`)
2. Cari baris: `#LoadModule rewrite_module modules/mod_rewrite.so`
3. Hapus tanda `#` di awal baris jika masih ada
4. Restart Apache

### Jika Nama Folder Berbeda
Jika Anda meletakkan project di folder dengan nama berbeda (misal: `pbo-project`), ubah:

1. **app/Config/App.php**:
   ```php
   public string $baseURL = 'http://localhost/pbo-project/';
   ```

2. **public/.htaccess**:
   ```apache
   RewriteBase /pbo-project/
   ```

### Jika Menggunakan Port Berbeda
Jika XAMPP menggunakan port selain 80 (misal: 8080):
```php
public string $baseURL = 'http://localhost:8080/pbo-ci/';
```

## Troubleshooting

### Problem: 404 Not Found
- Pastikan mod_rewrite aktif
- Periksa RewriteBase di `.htaccess` sudah sesuai
- Pastikan `indexPage` di `App.php` sudah kosong

### Problem: CSS/JS Tidak Load
- Periksa baseURL di `App.php` sudah benar
- Pastikan folder `public/assets` ada dan accessible
- Clear cache browser

### Problem: Redirect Loop
- Periksa konfigurasi RewriteBase
- Pastikan tidak ada konflik dengan .htaccess lain

## Kembali ke Virtual Host (Opsional)

Jika ingin kembali menggunakan virtual host, ubah:

1. **app/Config/App.php**:
   ```php
   public string $baseURL = 'http://pbo-wildan/';
   public string $indexPage = 'index.php';
   ```

2. **public/.htaccess**:
   ```apache
   # RewriteBase /
   ```
   (comment kembali atau hapus baris RewriteBase)
