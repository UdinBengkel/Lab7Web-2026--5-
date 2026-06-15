# Praktikum 5 - Pagination dan Pencarian

**Nama:** Syafarudiansya  
**NIM:** 312410381  
**Kelas:** I241A  
**Mata Kuliah:** Pemrograman Web 2  

---

## Tujuan

1. Memahami konsep dasar Pagination pada Framework CodeIgniter 4.
2. Memahami konsep dasar Pencarian (Search) pada Framework CodeIgniter 4.
3. Mampu mengimplementasikan fitur Paging dan Pencarian menggunakan CodeIgniter 4.

---

## Langkah-langkah Praktikum

### 1. Membuat Pagination

Pagination digunakan untuk membatasi tampilan data yang banyak menjadi beberapa halaman. CodeIgniter 4 sudah menyediakan library pagination sehingga mudah digunakan.

Buka `app/Controllers/Artikel.php`, kemudian modifikasi method `admin_index` untuk menggunakan fungsi `paginate()`:

```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $data = [
        'title'   => $title,
        'artikel' => $model->paginate(10), // data dibatasi 10 record per halaman
        'pager'   => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```

Kemudian buka `app/Views/artikel/admin_index.php` dan tambahkan kode berikut di bawah tabel untuk menampilkan link pagination:

```php
<?= $pager->links(); ?>
```

**Screenshot:**

![Pagination]([https://github.com/user-attachments/assets/xxx...](https://private-user-images.githubusercontent.com/145629080/607694811-e5f549c3-0570-45dd-8b71-e55531edb459.png?jwt=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3ODE0OTU3OTcsIm5iZiI6MTc4MTQ5NTQ5NywicGF0aCI6Ii8xNDU2MjkwODAvNjA3Njk0ODExLWU1ZjU0OWMzLTA1NzAtNDVkZC04YjcxLWU1NTUzMWVkYjQ1OS5wbmc_WC1BbXotQWxnb3JpdGhtPUFXUzQtSE1BQy1TSEEyNTYmWC1BbXotQ3JlZGVudGlhbD1BS0lBVkNPRFlMU0E1M1BRSzRaQSUyRjIwMjYwNjE1JTJGdXMtZWFzdC0xJTJGczMlMkZhd3M0X3JlcXVlc3QmWC1BbXotRGF0ZT0yMDI2MDYxNVQwMzUxMzdaJlgtQW16LUV4cGlyZXM9MzAwJlgtQW16LVNpZ25hdHVyZT1kMjE4ZGNkNDk0M2Q2YjI0OGUwNjQ4MzMxNjM4MWUxYzgwMGUwMmM2NGI0NTgzNGI4NDQ4OTk1OTgxYjViYTYwJlgtQW16LVNpZ25lZEhlYWRlcnM9aG9zdCZyZXNwb25zZS1jb250ZW50LXR5cGU9aW1hZ2UlMkZwbmcifQ.5MM9ItUlxmGTZNIJ7zRqgUQp0smOkszYv63kU-jAXJ4))

---

### 2. Membuat Pencarian

Fitur pencarian digunakan untuk memfilter data berdasarkan kata kunci yang dimasukkan pengguna.

Modifikasi kembali method `admin_index` pada `app/Controllers/Artikel.php`:

```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $q = $this->request->getVar('q') ?? '';
    $model = new ArtikelModel();
    $data = [
        'title'   => $title,
        'q'       => $q,
        'artikel' => $model->like('judul', $q)->paginate(10),
        'pager'   => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```

Tambahkan form pencarian di `app/Views/artikel/admin_index.php` sebelum deklarasi tabel:

```html
<form method="get" class="search-box">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari judul artikel...">
    <button type="submit" class="btn btn-primary">Cari</button>
</form>
```

Ubah link pager agar pencarian tetap terbawa saat berpindah halaman:

```php
<?= $pager->only(['q'])->links(); ?>
```

**Screenshot:**

> ![Pencarian](screenshots/pencarian.png)

---

### 3. Improvisasi Tampilan

Sebagai improvisasi, tampilan halaman admin artikel diperbarui menggunakan CSS custom agar lebih rapi dan modern, meliputi:

- **Badge status** — kolom status menampilkan badge berwarna hijau untuk *Publish* dan abu-abu untuk *Draft*, menggantikan angka 0/1.
- **Tabel dalam card** — tabel dibungkus dalam card dengan border radius dan shadow ringan.
- **Tombol aksi** — tombol Ubah dan Hapus diperbarui tampilannya dengan ikon dan warna yang lebih jelas.
- **Pagination di dalam card** — link pagination diletakkan di dalam card tabel agar tampilan lebih menyatu.
- **Navbar dan footer full width** — struktur template diperbaiki agar navbar dan footer tidak terpotong oleh container.

**Screenshot:**

> ![Tampilan Improvisasi](screenshots/improvisasi.png)

---

## Kesimpulan

Pada praktikum ini telah berhasil diimplementasikan fitur **pagination** dan **pencarian** menggunakan CodeIgniter 4. Pagination memecah tampilan data menjadi beberapa halaman menggunakan method `paginate()` dari Model, sedangkan pencarian dilakukan menggunakan method `like()` yang memfilter data berdasarkan kolom `judul`. Keduanya dapat dikombinasikan sekaligus sehingga pencarian tetap berfungsi saat berpindah halaman menggunakan `$pager->only(['q'])->links()`.
