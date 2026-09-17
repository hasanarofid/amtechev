# Panduan Integrasi Google Ads Conversion Tracking & Google Tag Manager (GTM)
**Project:** Amtech EV Specialist (`amtechev.com`)  
**GTM ID:** `GTM-MMCTRBZH`  
**Google Ads Tag ID:** `AW-18308241649`  

---

## 1. Ringkasan Arsitektur Pelacakan Kode (Coding Side)

Kode frontend website telah disesuaikan di `resources/js/tracking.js` dan `resources/views/frontend/booking_success.blade.php`. Setiap kali pengguna melakukan aktivitas bernilai (konversi), website otomatis mengirimkan event ke `window.dataLayer`:

| Aktivitas Pengguna | Event DataLayer | Parameter yang Dikirim |
|---|---|---|
| Klik Tombol WhatsApp | `whatsapp_click` | `link_url`, `link_text`, `page_location` |
| Klik Nomor Telepon | `phone_click` | `phone_number`, `page_location` |
| Submit Form Kontak | `form_submission` | `form_name`, `page_location` |
| Booking / Pembelian Sukses | `purchase` & `booking_complete` | `transaction_id`, `value`, `currency` ('MYR'), `items` |

---

## 2. Langkah Setup di Dashboard Google Ads

### Langkah 2.1: Buat Conversion Action "WhatsApp Lead"
1. Masuk ke [Google Ads Console](https://ads.google.com).
2. Buka menu **Alatan (Tools) & Tetapan** > **Tindakan Penukaran (Conversions)**.
3. Klik **+ Tindakan Penukaran Baharu (+ New Conversion Action)**.
4. Pilih kategori **Laman Web (Website)**.
5. Masukkan domain `amtechev.com` lalu klik **Imbas (Scan)**.
6. Pilih **Tambahkan tindakan penukaran secara manual (Add a conversion action manually)**:
   * **Kategori:** *Hubungi (Contact)* atau *Petunjuk (Lead)*.
   * **Nama Penukaran:** `WhatsApp Lead - Amtech EV`.
   * **Nilai (Value):** Gunakan nilai sama untuk setiap penukaran (contoh: RM10) atau jangan gunakan nilai.
   * **Kiraan (Count):** *Satu (One)* (karena 1 pengguna klik WA berkali-kali tetap dihitung 1 lead).
7. Klik **Simpan dan Teruskan**.
8. Pada pilihan metode pemasangan, pilih **Gunakan Pengurus Tag Google (Use Google Tag Manager)**.
9. **Catat nilainya:**
   * **ID Penukaran (Conversion ID):** contoh `AW-18308241649`
   * **Label Penukaran (Conversion Label):** contoh `aBCdEFgHIjKLmNOp`

---

### Langkah 2.2: Buat Conversion Action "Booking Completed"
1. Ulangi langkah pembuatan konversi di atas.
2. **Kategori:** *Pembelian (Purchase)* atau *Serahkan borang petunjuk (Submit lead form)*.
3. **Nama Penukaran:** `Booking Completed - Amtech EV`.
4. **Nilai (Value):** Gunakan nilai dinamik dari setiap penukaran (*Use different values for each conversion*).
5. **Kiraan (Count):** *Setiap (Every)*.
6. Klik **Simpan dan Teruskan** lalu catat **Label Penukaran (Conversion Label)** untuk Booking.

---

## 3. Langkah Setup di Google Tag Manager (GTM-MMCTRBZH)

Buka [Google Tag Manager](https://tagmanager.google.com) untuk container **GTM-MMCTRBZH**.

### Langkah 3.1: Buat Tag "Conversion Linker" (WAJIB)
1. Klik **Tag** > **Baharu (New)**.
2. Nama Tag: `Google Ads - Conversion Linker`.
3. Konfigurasi Tag: Pilih jenis **Pautan Penukaran (Conversion Linker)**.
4. Pencetus (Trigger): Pilih **Semua Halaman (All Pages)**.
5. Klik **Simpan**.

---

### Langkah 3.2: Setup Konversi WhatsApp Click

#### A. Buat Trigger (Pencetus)
1. Klik **Pencetus (Triggers)** > **Baharu (New)**.
2. Nama Trigger: `Event - whatsapp_click`.
3. Jenis Pencetus: **Acara Tersuai (Custom Event)**.
4. Nama Acara (Event name): `whatsapp_click`.
5. Pencetus ini dimainkan pada: **Semua Acara Tersuai**.
6. Klik **Simpan**.

#### B. Buat Tag Konversi
1. Klik **Tag** > **Baharu (New)**.
2. Nama Tag: `Google Ads - WhatsApp Lead`.
3. Jenis Tag: **Penjejakan Penukaran Google Ads (Google Ads Conversion Tracking)**.
4. Isikan kredensial:
   * **ID Penukaran:** `AW-18308241649` (atau gunakan tag ID Ads Anda).
   * **Label Penukaran:** *(Paste Label Penukaran WhatsApp dari Langkah 2.1)*.
5. Pencetus (Triggering): Pilih `Event - whatsapp_click`.
6. Klik **Simpan**.

---

### Langkah 3.3: Setup Konversi Booking Purchase

#### A. Buat Trigger (Pencetus)
1. Klik **Pencetus (Triggers)** > **Baharu (New)**.
2. Nama Trigger: `Event - purchase`.
3. Jenis Pencetus: **Acara Tersuai (Custom Event)**.
4. Nama Acara (Event name): `purchase`.
5. Klik **Simpan**.

#### B. Buat Variabel DataLayer (Untuk Nilai & ID Transaksi Dinamik)
1. Klik **Pemboleh Ubah (Variables)** > **Baharu (New)**.
2. Pemboleh Ubah DataLayer 1:
   * Nama: `dlv - transaction_id`
   * Jenis: **Pemboleh Ubah DataLayer**
   * Nama Pemboleh Ubah DataLayer: `ecommerce.transaction_id`
3. Pemboleh Ubah DataLayer 2:
   * Nama: `dlv - value`
   * Jenis: **Pemboleh Ubah DataLayer**
   * Nama Pemboleh Ubah DataLayer: `ecommerce.value`

#### C. Buat Tag Konversi Booking
1. Klik **Tag** > **Baharu (New)**.
2. Nama Tag: `Google Ads - Booking Purchase`.
3. Jenis Tag: **Penjejakan Penukaran Google Ads**.
4. Kredensial:
   * **ID Penukaran:** `AW-18308241649`
   * **Label Penukaran:** *(Paste Label Penukaran Booking dari Langkah 2.2)*.
   * **Nilai Penukaran:** `{{dlv - value}}`
   * **ID Transaksi:** `{{dlv - transaction_id}}`
   * **Kod Mata Wang:** `MYR`
5. Pencetus (Triggering): Pilih `Event - purchase`.
6. Klik **Simpan**.

---

### Langkah 3.4: Terbitkan (Publish) Container GTM
1. Klik tombol **Serahkan (Submit)** di pojok kanan atas GTM.
2. Muka versi: `V1.1 - Added WhatsApp and Purchase Google Ads Conversions`.
3. Klik **Terbitkan (Publish)**.

---

## 4. Cara Pengujian (Verification & Testing)

1. Di GTM, klik tombol **Pratonton (Preview)**.
2. Masukkan URL `https://amtechev.com`.
3. Buka tab **Tag Assistant**, klik tombol WhatsApp pada website.
4. Pastikan event `whatsapp_click` muncul di sidebar kiri Tag Assistant dan Tag `Google Ads - WhatsApp Lead` berstatus **Fired Successfully**.
5. Di dashboard Google Ads, status konversi akan berubah dari *Tidak Diverifikasi (Unverified)* menjadi *Aktif / Tiada penukaran terkini (No recent conversions)* dalam kurun waktu 3 - 24 jam.
