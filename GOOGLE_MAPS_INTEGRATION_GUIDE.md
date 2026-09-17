# Panduan Integrasi Google My Business & Google Maps — Amtech EV

Dokumen ini berisi panduan lengkap cara menghubungkan profil **Google My Business (Google Business Profile)** dan **Google Maps** ke dalam website **amtechev.com**.

---

## 📍 Bagian 1: Alamat Resmi & Embed Peta

### Alamat Resmi yang Digunakan:
> **Menara Dquince, 13A Go Wise Box, Tower A, Jalan PJU 8/8, Damansara Perdana, 47820 Petaling Jaya, Selangor**

### A. Jika Anda Mengakses dari Indonesia (Opsi Tercepat):
Karena pencarian Google Maps dari Indonesia memprioritaskan IP lokal, website sudah otomatis dikonfigurasikan menggunakan query alamat lengkap gedung di atas:
- **Embed URL:**
  `https://maps.google.com/maps?q=Menara+Dquince+Damansara+Perdana+Jalan+PJU+8/8+47820+Petaling+Jaya+Selangor&t=&z=16&ie=UTF8&iwloc=&output=embed`
- Peta interaktif di halaman `/contact` sudah otomatis terpusat ke lokasi Menara Dquince Damansara Perdana.

### B. Mendapatkan Link Akurat dari Klien (Owner di Malaysia):
Klien/Owner Anda yang berada di Malaysia dan mengelola profil bisnis di Google Maps dapat langsung mengirimkan link resmi profil bisnisnya dengan 1 langkah mudah:
1. Owner membuka aplikasi **Google Maps** di ponselnya (pada halaman profil bisnis yang ada tulisan *"You manage this Business Profile"*).
2. Klik tombol **Share (Bagikan)** (seperti yang terlihat pada screenshot chat WhatsApp).
3. Pilih **Copy link** / Kirim via WhatsApp ke Anda.
4. Link tersebut bisa langsung dimasukkan ke website.

---

## ⭐ Bagian 2: Cara Mengambil Link Google Reviews ("Ask for Reviews")

Agar klien bisa langsung diarahkan ke halaman popup menulis review bintang 5 di Google:

1. Buka Google dan pastikan login dengan akun Google pemilik profil bisnis.
2. Ketik **"My Business"** di Google Search atau buka aplikasi **Google Maps** di ponsel (seperti pada screenshot Anda).
3. Klik menu **"Ask for reviews"** / **"Minta ulasan"** (atau klik ikon profil bisnis $\rightarrow$ **Dapatkan ulasan lainnya**).
4. Salin link ulasan khusus yang diberikan (contoh format: `https://g.page/r/.../review`).

---

## 🛠️ Bagian 3: Implementasi di Kode Website (Blade Templates)

Sistem sudah disiapkan secara dinamis dan siap pakai pada file-file berikut:

### 1. Halaman Kontak: `resources/views/frontend/contact/index.blade.php`
- Menampilkan kartu profil Google Business + peta interaktif responsif.
- Terdapat tombol langsung **Directions** dan **Open in Google Maps**.

### 2. Halaman Testimonial / Home: `resources/views/frontend/testimonials.blade.php`
- Menampilkan rating badge resmi **5.0 ★★★★★ Google Reviews**.
- Tombol **"Review us on Google"** yang mengarahkan pengunjung untuk menulis review.

### 3. Footer: `resources/views/frontend/footer.blade.php`
- Menampilkan link lokasi **"View on Google Maps"** tepat di bawah alamat kantor.

---

## ⚙️ Bagian 4: Pengaturan Dinamis (Opsional via Site Settings)

Jika ingin mengubah URL/Embed tanpa menyentuh kode Blade, Anda dapat menambahkan kunci berikut di tabel `site_settings`:

| Key Setting | Deskripsi | Contoh Nilai |
|---|---|---|
| `google_maps_url` | Link profil Google Maps | `https://maps.app.goo.gl/xxxxx` |
| `google_review_url` | Link langsung form review | `https://g.page/r/xxxxx/review` |
| `google_maps_query` | Kata kunci pencarian peta fallback | `Amtech EV Charger Specialist Menara Dquince Damansara Perdana` |
| `google_map_embed` | Kode iframe kustom (opsional) | `<iframe src="..." ...></iframe>` |

---

## 🚀 Tips Optimasi Google Business Profile (SEO Lokal)

1. **Lengkapi Data Kategori:** Pastikan kategori utama adalah *Electric Vehicle Charging Station Contractor* atau *Electrician*.
2. **Foto Berkualitas:** Unggah foto instalasi charger (seperti ARC7, Neta, kabel SIRIM & DB box) secara berkala pada tab *Photos*.
3. **Kumpulkan Review:** Setelah selesai pemasangan charger ke klien, kirimkan *Link Google Review* via WhatsApp untuk menambah reputasi bintang 5.
