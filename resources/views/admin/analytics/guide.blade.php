<x-app-layout>
    <x-slot name="title">Panduan Setup Google API</x-slot>
    <x-slot name="header">📖 Panduan Mendapatkan Google API Keys</x-slot>

    @push('styles')
    <style>
        .guide-card { background:var(--glass); border:1px solid var(--glass-border); border-radius:14px; padding:24px; margin-bottom:20px; }
        .guide-card h3 { font-size:1rem; font-weight:800; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
        .step { display:flex; gap:14px; margin-bottom:18px; }
        .step-num { background:rgba(59,183,126,.15); border:1px solid rgba(59,183,126,.3); color:#3bb77e; font-weight:800; font-size:.78rem; border-radius:50%; width:28px; height:28px; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
        .step h4 { font-size:.88rem; font-weight:700; color:var(--text-main); margin-bottom:4px; }
        .step p  { font-size:.8rem; color:var(--text-muted); line-height:1.65; }
        .step a  { color:#63b3ed; text-decoration:underline; }
        .env-box { background:rgba(0,0,0,.35); border:1px solid rgba(255,255,255,.08); border-radius:8px; padding:16px; margin-top:12px; font-family:monospace; font-size:.78rem; color:#68d391; line-height:2; white-space:pre-wrap; }
        .tag { display:inline-block; padding:2px 8px; border-radius:8px; font-size:.68rem; font-weight:700; margin-left:6px; }
        .tag.required { background:rgba(252,129,129,.15); color:#fc8181; }
        .tag.optional { background:rgba(246,173,85,.15); color:#f6ad55; }
        .alert-warn { background:rgba(246,173,85,.08); border:1px solid rgba(246,173,85,.3); border-radius:10px; padding:14px 18px; font-size:.82rem; color:#f6ad55; margin-bottom:16px; }
        .back-btn { display:inline-flex; align-items:center; gap:8px; padding:8px 18px; border-radius:8px; background:var(--glass); border:1px solid var(--glass-border); color:var(--text-muted); font-size:.8rem; font-weight:700; cursor:pointer; text-decoration:none; margin-bottom:20px; transition:all .2s; }
        .back-btn:hover { border-color:rgba(59,183,126,.4); color:#3bb77e; }
    </style>
    @endpush

    <div class="max-w-4xl mx-auto px-2 lg:px-0 pb-12">
        <a href="{{ route('admin.analytics.index') }}" class="back-btn">← Kembali ke Dashboard Analytics</a>

        <div class="alert-warn">
            ⚠️ Jangan pernah simpan API Key/Secret langsung di kode. Selalu gunakan file <strong>.env</strong> dan tambahkan ke <strong>.gitignore</strong>.
        </div>

        {{-- STEP 1: Google Cloud Console --}}
        <div class="guide-card">
            <h3>☁️ Step 1 — Buat Project di Google Cloud Console <span class="tag required">Wajib</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Buka Google Cloud Console</h4><p>Kunjungi <a href="https://console.cloud.google.com" target="_blank">console.cloud.google.com</a> → Login dengan akun Google yang sama dengan Google Ads & GA4.</p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Buat Project Baru</h4><p>Klik dropdown project di header → "New Project" → beri nama misal <strong>"Amtech EV Analytics"</strong> → Create.</p></div></div>
            <div class="step"><div class="step-num">3</div><div><h4>Aktifkan API yang dibutuhkan</h4><p>Masuk ke <strong>APIs & Services → Library</strong>, cari dan aktifkan:<br>
                • <strong>Google Analytics Data API</strong> (GA4)<br>
                • <strong>Google Ads API</strong><br>
                • <strong>Tag Manager API</strong>
            </p></div></div>
        </div>

        {{-- STEP 2: OAuth2 Credentials --}}
        <div class="guide-card">
            <h3>🔑 Step 2 — Buat OAuth2 Credentials (Client ID & Secret) <span class="tag required">Wajib</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Buka Credentials</h4><p>Menu kiri → <strong>APIs & Services → Credentials</strong> → klik <strong>"+ Create Credentials"</strong> → pilih <strong>"OAuth client ID"</strong>.</p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Isi Form</h4><p>• Application type: <strong>Web application</strong><br>• Name: Amtech EV<br>• Authorized redirect URIs: tambahkan <code>https://developers.google.com/oauthplayground</code></p></div></div>
            <div class="step"><div class="step-num">3</div><div><h4>Simpan Client ID & Secret</h4><p>Copy <strong>Client ID</strong> dan <strong>Client Secret</strong> yang muncul. Ini untuk <code>.env</code>.</p></div></div>
        </div>

        {{-- STEP 3: Refresh Token --}}
        <div class="guide-card">
            <h3>🔄 Step 3 — Dapatkan Refresh Token via OAuth Playground <span class="tag required">Wajib</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Buka OAuth Playground</h4><p>Kunjungi <a href="https://developers.google.com/oauthplayground" target="_blank">developers.google.com/oauthplayground</a></p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Setting OAuth</h4><p>Klik ⚙️ (kanan atas) → centang <strong>"Use your own OAuth credentials"</strong> → masukkan Client ID & Secret tadi.</p></div></div>
            <div class="step"><div class="step-num">3</div><div><h4>Pilih Scope (Step 1 di playground)</h4><p>Cari dan pilih scope berikut:<br>
                • <code>https://www.googleapis.com/auth/analytics.readonly</code><br>
                • <code>https://www.googleapis.com/auth/adwords</code><br>
                • <code>https://www.googleapis.com/auth/tagmanager.readonly</code><br>
                → Klik <strong>"Authorize APIs"</strong> → Login & Allow.
            </p></div></div>
            <div class="step"><div class="step-num">4</div><div><h4>Exchange Token (Step 2)</h4><p>Klik <strong>"Exchange authorization code for tokens"</strong> → Copy nilai <strong>Refresh token</strong> yang muncul.</p></div></div>
        </div>

        {{-- STEP 4: GA4 Property ID --}}
        <div class="guide-card">
            <h3>📈 Step 4 — Dapatkan GA4 Property ID <span class="tag required">Wajib</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Buka Google Analytics</h4><p>Kunjungi <a href="https://analytics.google.com" target="_blank">analytics.google.com</a> → pilih property Amtech EV.</p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Ambil Property ID</h4><p>Klik ⚙️ Admin → <strong>Property Settings</strong> → copy angka di kolom <strong>"Property ID"</strong> (format: <code>123456789</code>).</p></div></div>
        </div>

        {{-- STEP 5: Google Ads --}}
        <div class="guide-card">
            <h3>📢 Step 5 — Dapatkan Google Ads Developer Token & Customer ID <span class="tag required">Wajib</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Developer Token</h4><p>Buka <a href="https://ads.google.com/aw/apicenter" target="_blank">ads.google.com/aw/apicenter</a> → Copy <strong>Developer Token</strong>. Jika belum ada, apply dulu (bisa pakai test token untuk development).</p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Customer ID</h4><p>Di Google Ads, angka di pojok kanan atas (format: <code>123-456-7890</code>). Masukkan tanpa tanda hubung: <code>1234567890</code>.</p></div></div>
        </div>

        {{-- STEP 6: GTM Account ID --}}
        <div class="guide-card">
            <h3>🏷️ Step 6 — Dapatkan GTM Account ID <span class="tag optional">Opsional</span></h3>
            <div class="step"><div class="step-num">1</div><div><h4>Buka GTM</h4><p>Kunjungi <a href="https://tagmanager.google.com" target="_blank">tagmanager.google.com</a> → pilih akun Amtech EV.</p></div></div>
            <div class="step"><div class="step-num">2</div><div><h4>Ambil Account ID</h4><p>URL akan terlihat: <code>tagmanager.google.com/#/accounts/<strong>XXXXXXXX</strong>/containers/...</code> → angka setelah <code>/accounts/</code> adalah Account ID Anda.</p></div></div>
        </div>

        {{-- .env config --}}
        <div class="guide-card">
            <h3>📄 Konfigurasi .env & config/services.php</h3>
            <p style="font-size:.82rem;color:var(--text-muted);margin-bottom:12px">Tambahkan baris berikut ke file <strong>.env</strong> di root project Laravel:</p>
            <div class="env-box"># Google OAuth2
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REFRESH_TOKEN=your_refresh_token_here

# Google Analytics 4
GA4_PROPERTY_ID=123456789

# Google Ads
GOOGLE_ADS_DEVELOPER_TOKEN=your_developer_token
GOOGLE_ADS_CUSTOMER_ID=1234567890

# Google Tag Manager
GTM_ACCOUNT_ID=123456789</div>

            <p style="font-size:.82rem;color:var(--text-muted);margin:16px 0 8px">Kemudian di <strong>config/services.php</strong>, tambahkan:</p>
            <div class="env-box">'google' => [
    'client_id'           => env('GOOGLE_CLIENT_ID'),
    'client_secret'       => env('GOOGLE_CLIENT_SECRET'),
    'refresh_token'       => env('GOOGLE_REFRESH_TOKEN'),
    'ga4_property_id'     => env('GA4_PROPERTY_ID'),
    'ads_developer_token' => env('GOOGLE_ADS_DEVELOPER_TOKEN'),
    'ads_customer_id'     => env('GOOGLE_ADS_CUSTOMER_ID'),
    'gtm_account_id'      => env('GTM_ACCOUNT_ID'),
],</div>

            <p style="font-size:.82rem;color:var(--text-muted);margin-top:14px">Setelah mengubah .env, jalankan: <code style="background:rgba(255,255,255,.07);padding:3px 8px;border-radius:4px;color:#f6ad55">php artisan config:clear</code></p>
        </div>

    </div>
</x-app-layout>
