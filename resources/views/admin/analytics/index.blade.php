<x-app-layout>
    <x-slot name="title">Google Analytics Dashboard</x-slot>
    <x-slot name="header">📊 Marketing Analytics</x-slot>

    @push('styles')
    <style>
        .ana-tabs { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:20px; }
        .ana-tab {
            padding:8px 18px; border-radius:8px; font-size:.8rem; font-weight:700;
            cursor:pointer; border:1px solid rgba(255,255,255,.08);
            background:var(--glass); color:var(--text-muted); transition:all .2s;
        }
        .ana-tab.active { background:rgba(59,183,126,.15); border-color:rgba(59,183,126,.4); color:var(--ev-green); }
        .ana-panel { display:none; }
        .ana-panel.active { display:block; }
        .kpi-row { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:14px; margin-bottom:20px; }
        .kpi-box {
            background:var(--glass); border:1px solid var(--glass-border);
            border-radius:12px; padding:18px; position:relative; overflow:hidden;
        }
        .kpi-box::before { content:''; position:absolute; top:0;left:0;right:0;height:2px; }
        .kpi-box.green::before { background:linear-gradient(90deg,#3bb77e,#68d391); }
        .kpi-box.blue::before  { background:linear-gradient(90deg,#63b3ed,#4299e1); }
        .kpi-box.red::before   { background:linear-gradient(90deg,#fc8181,#e53e3e); }
        .kpi-box.orange::before{ background:linear-gradient(90deg,#f6ad55,#dd6b20); }
        .kpi-box.purple::before{ background:linear-gradient(90deg,#9f7aea,#805ad5); }
        .kpi-lbl { font-size:.68rem; text-transform:uppercase; letter-spacing:.08em; font-weight:700; color:var(--text-muted); }
        .kpi-val { font-size:1.8rem; font-weight:800; margin:4px 0; }
        .kpi-box.green .kpi-val  { color:#3bb77e; }
        .kpi-box.blue .kpi-val   { color:#63b3ed; }
        .kpi-box.red .kpi-val    { color:#fc8181; }
        .kpi-box.orange .kpi-val { color:#f6ad55; }
        .kpi-box.purple .kpi-val { color:#9f7aea; }
        .kpi-sub { font-size:.72rem; color:var(--text-muted); }
        .config-banner {
            background:linear-gradient(135deg,rgba(99,179,237,.08),rgba(159,122,234,.05));
            border:1px solid rgba(99,179,237,.25); border-radius:12px;
            padding:16px 20px; margin-bottom:20px; display:flex; align-items:center; gap:14px;
        }
        .config-banner a { color:#63b3ed; font-weight:700; text-decoration:underline; }
        .status-dot { width:8px; height:8px; border-radius:50%; display:inline-block; margin-right:6px; }
        .dot-ok  { background:#3bb77e; box-shadow:0 0 8px rgba(59,183,126,.5); }
        .dot-err { background:#fc8181; box-shadow:0 0 8px rgba(252,129,129,.5); }
        .dot-wait{ background:#f6ad55; box-shadow:0 0 8px rgba(246,173,85,.5); }
        .loading-overlay { text-align:center; padding:40px; color:var(--text-muted); font-size:.85rem; }
        .err-box { background:rgba(252,129,129,.08); border:1px solid rgba(252,129,129,.3); border-radius:10px; padding:14px 18px; color:#fc8181; font-size:.82rem; margin-bottom:16px; }
        .guide-step { display:flex; gap:14px; margin-bottom:18px; }
        .step-num { background:rgba(59,183,126,.15); border:1px solid rgba(59,183,126,.3); color:#3bb77e; font-weight:800; font-size:.8rem; border-radius:50%; width:28px; height:28px; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
        .step-body h4 { font-size:.88rem; font-weight:700; color:var(--text-main); margin-bottom:4px; }
        .step-body p  { font-size:.8rem; color:var(--text-muted); line-height:1.6; }
        .step-body code { background:rgba(255,255,255,.07); border-radius:4px; padding:2px 6px; font-size:.78rem; color:#f6ad55; }
        .env-block { background:rgba(0,0,0,.3); border:1px solid rgba(255,255,255,.08); border-radius:8px; padding:14px 16px; margin-top:10px; font-family:monospace; font-size:.78rem; color:#68d391; line-height:1.8; white-space:pre-wrap; }
        .badge-api { display:inline-block; padding:3px 9px; border-radius:10px; font-size:.7rem; font-weight:700; }
        .badge-connected { background:rgba(59,183,126,.15); color:#3bb77e; }
        .badge-notset    { background:rgba(252,129,129,.15); color:#fc8181; }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto px-2 lg:px-0 pb-12">

        {{-- Config Status Banner --}}
        <div class="config-banner">
            <span style="font-size:1.4rem">🔐</span>
            <div style="flex:1">
                <p style="font-size:.82rem; font-weight:700; color:var(--text-main); margin-bottom:4px;">Status Koneksi API Google</p>
                <div style="display:flex; gap:16px; flex-wrap:wrap; font-size:.78rem;">
                    <span>
                        <span class="status-dot {{ config('services.google.client_id') ? 'dot-ok' : 'dot-err' }}"></span>
                        OAuth2: <strong>{{ config('services.google.client_id') ? 'Terset' : 'Belum diset' }}</strong>
                    </span>
                    <span>
                        <span class="status-dot {{ config('services.google.ga4_property_id') ? 'dot-ok' : 'dot-err' }}"></span>
                        GA4 Property: <strong>{{ config('services.google.ga4_property_id') ?: 'Belum diset' }}</strong>
                    </span>
                    <span>
                        <span class="status-dot {{ config('services.google.ads_customer_id') ? 'dot-ok' : 'dot-err' }}"></span>
                        Ads Customer ID: <strong>{{ config('services.google.ads_customer_id') ?: 'Belum diset' }}</strong>
                    </span>
                    <span>
                        <span class="status-dot {{ config('services.google.gtm_account_id') ? 'dot-ok' : 'dot-err' }}"></span>
                        GTM Account: <strong>{{ config('services.google.gtm_account_id') ?: 'Belum diset' }}</strong>
                    </span>
                </div>
            </div>
            <a href="{{ route('admin.analytics.guide') }}" class="text-xs">📖 Panduan Setup</a>
        </div>

        {{-- Tabs --}}
        <div class="ana-tabs">
            <div class="ana-tab active" onclick="anaTab('ga4',this)">📈 Google Analytics 4</div>
            <div class="ana-tab" onclick="anaTab('ads',this)">📢 Google Ads</div>
            <div class="ana-tab" onclick="anaTab('gtm',this)">🏷️ Google Tag Manager</div>
        </div>

        {{-- GA4 Panel --}}
        <div class="ana-panel active" id="panel-ga4">
            <div class="kpi-row" id="ga4-kpis">
                <div class="loading-overlay" style="grid-column:1/-1">⏳ Memuat data GA4...</div>
            </div>
            <div class="bg-glass border border-glass-border rounded-xl p-6">
                <p class="text-[10px] font-black uppercase tracking-widest text-text-muted mb-4">Sesi per Hari (28 hari terakhir)</p>
                <canvas id="ga4Chart" style="max-height:260px"></canvas>
                <div id="ga4-err" class="err-box" style="display:none"></div>
            </div>
        </div>

        {{-- Google Ads Panel --}}
        <div class="ana-panel" id="panel-ads">
            <div class="kpi-row" id="ads-kpis">
                <div class="loading-overlay" style="grid-column:1/-1">⏳ Memuat data Google Ads...</div>
            </div>
            <div class="bg-glass border border-glass-border rounded-xl p-6">
                <p class="text-[10px] font-black uppercase tracking-widest text-text-muted mb-4">Performa Kampanye</p>
                <div id="ads-table-wrap" style="overflow-x:auto"></div>
                <div id="ads-err" class="err-box" style="display:none"></div>
            </div>
        </div>

        {{-- GTM Panel --}}
        <div class="ana-panel" id="panel-gtm">
            <div class="bg-glass border border-glass-border rounded-xl p-6">
                <p class="text-[10px] font-black uppercase tracking-widest text-text-muted mb-4">Containers GTM</p>
                <div id="gtm-data">
                    <div class="loading-overlay">⏳ Memuat data GTM...</div>
                </div>
                <div id="gtm-err" class="err-box" style="display:none"></div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    function anaTab(name, el) {
        document.querySelectorAll('.ana-panel').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.ana-tab').forEach(t => t.classList.remove('active'));
        document.getElementById('panel-' + name).classList.add('active');
        el.classList.add('active');
    }

    // ─── GA4 ───────────────────────────────────────────────
    fetch('{{ route("admin.analytics.ga4") }}')
        .then(r => r.json())
        .then(data => {
            if (data.error) { showErr('ga4', data.error); return; }

            const rows   = data.rows || [];
            const labels = rows.map(r => r.dimensionValues?.[0]?.value || '');
            const sessions = rows.map(r => parseFloat(r.metricValues?.[0]?.value || 0));
            const users    = rows.map(r => parseFloat(r.metricValues?.[1]?.value || 0));

            const totSess  = sessions.reduce((a,b)=>a+b, 0);
            const totUsers = users.reduce((a,b)=>a+b, 0);
            const totPV    = rows.reduce((a,r)=>a+parseFloat(r.metricValues?.[3]?.value||0), 0);
            const totConv  = rows.reduce((a,r)=>a+parseFloat(r.metricValues?.[4]?.value||0), 0);
            const avgBounce= rows.length ? (rows.reduce((a,r)=>a+parseFloat(r.metricValues?.[2]?.value||0),0)/rows.length*100).toFixed(1) : 0;

            document.getElementById('ga4-kpis').innerHTML = `
                <div class="kpi-box green"><div class="kpi-lbl">Sesi</div><div class="kpi-val">${totSess.toLocaleString()}</div><div class="kpi-sub">28 hari</div></div>
                <div class="kpi-box blue"><div class="kpi-lbl">Pengguna</div><div class="kpi-val">${totUsers.toLocaleString()}</div><div class="kpi-sub">Unik</div></div>
                <div class="kpi-box orange"><div class="kpi-lbl">Bounce Rate</div><div class="kpi-val">${avgBounce}%</div><div class="kpi-sub">Rata-rata</div></div>
                <div class="kpi-box purple"><div class="kpi-lbl">Page Views</div><div class="kpi-val">${totPV.toLocaleString()}</div><div class="kpi-sub">Total</div></div>
                <div class="kpi-box red"><div class="kpi-lbl">Konversi</div><div class="kpi-val">${totConv}</div><div class="kpi-sub">Purchase</div></div>
            `;

            new Chart(document.getElementById('ga4Chart'), {
                type: 'line',
                data: {
                    labels,
                    datasets: [
                        { label:'Sesi', data:sessions, borderColor:'#3bb77e', backgroundColor:'rgba(59,183,126,.1)', fill:true, tension:.3 },
                        { label:'Users', data:users, borderColor:'#63b3ed', backgroundColor:'rgba(99,179,237,.07)', fill:true, tension:.3 },
                    ]
                },
                options: {
                    responsive:true,
                    plugins:{ legend:{ labels:{ color:'#a0aec0' } } },
                    scales:{
                        x:{ ticks:{color:'#718096',maxTicksLimit:10,font:{size:10}}, grid:{color:'rgba(255,255,255,.04)'} },
                        y:{ ticks:{color:'#718096'}, grid:{color:'rgba(255,255,255,.04)'} }
                    }
                }
            });
        })
        .catch(e => showErr('ga4', e.message));

    // ─── Google Ads ─────────────────────────────────────────
    fetch('{{ route("admin.analytics.ads") }}')
        .then(r => r.json())
        .then(data => {
            let apiErr = data && data.error ? data.error : (Array.isArray(data) && data[0] && data[0].error ? data[0].error : null);
            if (apiErr) { showErr('ads', apiErr.message || apiErr); renderAdsEmpty(); return; }

            let totClicks=0, totImpr=0, totCost=0;
            let rows = '';
            
            let arr = Array.isArray(data) ? data : (data && Object.keys(data).length > 0 ? [data] : []);
            arr.forEach(batch => {
                (batch.results || []).forEach(item => {
                    const c = item.campaign || {};
                    const m = item.metrics || {};
                    totClicks += parseInt(m.clicks||0);
                    totImpr   += parseInt(m.impressions||0);
                    totCost   += parseInt(m.cost_micros||0);
                    rows += `<tr>
                        <td>${c.name||'-'}</td>
                        <td><span class="badge-api ${c.status==='ENABLED'?'badge-connected':'badge-notset'}">${c.status||'-'}</span></td>
                        <td>${parseInt(m.impressions||0).toLocaleString()}</td>
                        <td>${parseInt(m.clicks||0).toLocaleString()}</td>
                        <td>${((m.ctr||0)*100).toFixed(2)}%</td>
                        <td>Rp${(parseInt(m.cost_micros||0)/1e6).toLocaleString()}</td>
                    </tr>`;
                });
            });

            document.getElementById('ads-kpis').innerHTML = `
                <div class="kpi-box blue"><div class="kpi-lbl">Tayangan</div><div class="kpi-val">${totImpr.toLocaleString()}</div><div class="kpi-sub">30 hari</div></div>
                <div class="kpi-box green"><div class="kpi-lbl">Klik</div><div class="kpi-val">${totClicks.toLocaleString()}</div><div class="kpi-sub">Total</div></div>
                <div class="kpi-box orange"><div class="kpi-lbl">Biaya</div><div class="kpi-val">Rp${(totCost/1e6).toLocaleString()}</div><div class="kpi-sub">Cost</div></div>
                <div class="kpi-box purple"><div class="kpi-lbl">CTR</div><div class="kpi-val">${totImpr?((totClicks/totImpr)*100).toFixed(2):0}%</div><div class="kpi-sub">Rata-rata</div></div>
            `;
            document.getElementById('ads-table-wrap').innerHTML = `
                <table style="width:100%;border-collapse:collapse">
                    <thead><tr>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">Kampanye</th>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">Status</th>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">Tayangan</th>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">Klik</th>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">CTR</th>
                        <th style="padding:10px 12px;background:rgba(99,179,237,.08);color:#63b3ed;font-size:.72rem;text-align:left">Biaya</th>
                    </tr></thead>
                    <tbody>${rows||'<tr><td colspan="6" style="text-align:center;padding:20px;color:#718096">Tidak ada data kampanye</td></tr>'}</tbody>
                </table>`;
        })
        .catch(e => {
            let msg = e.message === 'NetworkError when attempting to fetch resource.' ? 'Koneksi diblokir. Harap matikan Adblocker (UBlock/Adblock) atau Tracking Protection di browser Anda.' : e.message;
            showErr('ads', msg); renderAdsEmpty(); 
        });

    function renderAdsEmpty() {
        document.getElementById('ads-kpis').innerHTML = `
            <div class="kpi-box red"><div class="kpi-lbl">Tayangan</div><div class="kpi-val">0</div><div class="kpi-sub">Belum terkoneksi</div></div>
            <div class="kpi-box red"><div class="kpi-lbl">Klik</div><div class="kpi-val">0</div><div class="kpi-sub">Belum terkoneksi</div></div>`;
    }

    // ─── GTM ────────────────────────────────────────────────
    fetch('{{ route("admin.analytics.gtm") }}')
        .then(r => r.json())
        .then(data => {
            if (data.error) { showErr('gtm', data.error); return; }
            const containers = data.container || [];
            let html = containers.map(c => `
                <div class="bg-glass border border-glass-border rounded-xl p-4 mb-3 flex items-center gap-4">
                    <span style="font-size:1.4rem">🏷️</span>
                    <div>
                        <p style="font-size:.88rem;font-weight:700;color:var(--text-main)">${c.name}</p>
                        <p style="font-size:.75rem;color:var(--text-muted)">ID: ${c.publicId} &nbsp;|&nbsp; Domain: ${(c.domainName||[]).join(', ')||'-'}</p>
                    </div>
                    <span class="badge-api badge-connected ml-auto">Active</span>
                </div>`).join('');
            document.getElementById('gtm-data').innerHTML = html || '<p style="color:#718096;font-size:.84rem">Tidak ada container ditemukan.</p>';
        })
        .catch(e => {
            let msg = e.message === 'NetworkError when attempting to fetch resource.' ? 'Koneksi diblokir. Harap matikan Adblocker (UBlock/Adblock) atau Tracking Protection di browser Anda untuk melihat data GTM.' : e.message;
            showErr('gtm', msg);
        });

    function showErr(id, msg) {
        const el = document.getElementById(id+'-err');
        let errorText = typeof msg === 'object' ? JSON.stringify(msg) : msg;
        if (el) { el.style.display='block'; el.innerHTML = '⚠️ Error: ' + errorText; }
    }
    </script>
    @endpush
</x-app-layout>
