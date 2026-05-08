<?php

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$title = "The Road Ahead: How New EV Rules are Transforming Malaysia's Auto Industry";
$title_ms = "Langkah Ke Hadapan: Bagaimana Peraturan Baru EV Mentransformasi Industri Automotif Malaysia";

$excerpt = "Malaysia's automotive landscape is shifting as experts predict new EV regulations will boost local production and accelerate the nation's transition to sustainable mobility.";
$excerpt_ms = "Landskap automotif Malaysia sedang beralih apabila pakar meramalkan peraturan EV baharu akan meningkatkan pengeluaran tempatan dan mempercepatkan peralihan negara kepada mobiliti mampan.";

$content_en = '
<p>The Malaysian electric vehicle (EV) sector is on the verge of a major transformation. Recent announcements regarding new EV regulations and road tax structures are expected to significantly boost the local automotive industry. According to industry experts, these rules provide the clarity and incentive needed for both manufacturers and consumers to embrace electric mobility.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog10-08052026.png" alt="Amtech EV Professional" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">Professional installation is key to safe EV adoption in Malaysia.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Driving Local Innovation</h3>
<p>Experts suggest that the new rules will encourage local carmakers, such as Proton with its e.MAS initiative, to accelerate their EV development. By providing a stable framework, Malaysia is positioning itself as a potential regional hub for EV production and components.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog11-08052026.png" alt="Proton e.MAS Charging" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">The rise of local EV brands like Proton e.MAS signifies a new era for the industry.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Infrastructure and Policy Alignment</h3>
<p>One of the key takeaways from the recent expert panel is the importance of aligning infrastructure growth with policy changes. As road tax rules become more favorable, the demand for high-quality, reliable home and public charging solutions will skyrocket. This is where specialized installers like Amtech EV play a crucial role in ensuring that the transition is seamless and safe for every Malaysian home.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog12-08052026.jpg" alt="Amtech EV Specialist Verification" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">Verified charging solutions are essential for the growing EV market.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Looking Forward</h3>
<p>As we move towards 2026 and beyond, the collaboration between the government, automotive experts, and technology providers will be the driving force behind a cleaner, more efficient transport system. For many Malaysians, the question is no longer "if" they should buy an EV, but "when."</p>
';

$content_ms = '
<p>Sektor kenderaan elektrik (EV) Malaysia kini berada di ambang transformasi besar. Pengumuman terbaru mengenai peraturan EV dan struktur cukai jalan baru dijangka akan meningkatkan industri automotif tempatan secara signifikan. Menurut pakar industri, peraturan ini memberikan kejelasan dan insentif yang diperlukan oleh pengeluar dan pengguna untuk menerima mobiliti elektrik.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog10-08052026.png" alt="Profesional Amtech EV" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">Pemasangan profesional adalah kunci kepada penggunaan EV yang selamat di Malaysia.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Memacu Inovasi Tempatan</h3>
<p>Pakar mencadangkan bahawa peraturan baharu ini akan menggalakkan pengeluar kereta tempatan, seperti Proton dengan inisiatif e.MAS, untuk mempercepatkan pembangunan EV mereka. Dengan menyediakan rangka kerja yang stabil, Malaysia meletakkan dirinya sebagai hab serantau yang berpotensi untuk pengeluaran dan komponen EV.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog11-08052026.png" alt="Pengecasan Proton e.MAS" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">Kebangkitan jenama EV tempatan seperti Proton e.MAS menandakan era baharu bagi industri ini.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Penyelarasan Infrastruktur dan Dasar</h3>
<p>Salah satu perkara utama daripada panel pakar baru-baru ini adalah kepentingan menyelaraskan pertumbuhan infrastruktur dengan perubahan dasar. Apabila peraturan cukai jalan menjadi lebih menguntungkan, permintaan untuk penyelesaian pengecasan rumah dan awam yang berkualiti tinggi dan boleh dipercayai akan meningkat secara mendadak. Di sinilah pemasang pakar seperti Amtech EV memainkan peranan penting dalam memastikan peralihan itu lancar dan selamat bagi setiap kediaman di Malaysia.</p>

<div class="my-8 text-center">
    <img src="/blog-assets/blog12-08052026.jpg" alt="Verifikasi Pakar Amtech EV" class="rounded-2xl shadow-lg mx-auto w-full md:w-3/4 border border-white/10">
    <p class="text-xs text-gray-500 mt-3 italic">Penyelesaian pengecasan yang disahkan adalah penting bagi pasaran EV yang sedang berkembang.</p>
</div>

<h3 class="text-2xl font-bold text-ev-green mt-10 mb-4">Melihat ke Hadapan</h3>
<p>Sambil kita menuju ke tahun 2026 dan seterusnya, kerjasama antara kerajaan, pakar automotif, dan penyedia teknologi akan menjadi penggerak di sebalik sistem pengangkutan yang lebih bersih dan cekap. Bagi kebanyakan rakyat Malaysia, persoalannya bukan lagi "jika" mereka patut membeli EV, tetapi "bila."</p>
';

$slug = Str::slug($title);

$post = BlogPost::updateOrCreate(
    ['slug' => $slug],
    [
        'title' => $title,
        'title_ms' => $title_ms,
        'excerpt' => $excerpt,
        'excerpt_ms' => $excerpt_ms,
        'content' => $content_en,
        'content_ms' => $content_ms,
        'image_url' => 'blog-assets/blog11-08052026.png', // Using the charger image as featured
        'published_at' => Carbon::now(),
        'author_id' => 1, // Assuming admin author ID is 1
        'is_featured' => true,
        'meta_title' => $title,
        'meta_description' => $excerpt,
    ]
);

echo "Blog post created/updated: " . $post->title . "\n";
echo "Slug: " . $post->slug . "\n";
