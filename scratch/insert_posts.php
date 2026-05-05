<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

$posts = [
    [
        'title' => 'Charging Your EV at Home: The Ultimate Convenience for Malaysian Drivers',
        'title_ms' => 'Mengecas EV di Rumah: Keselesaan Maksimum untuk Pemandu di Malaysia',
        'excerpt' => 'Discover why having a home charging station is a game-changer for EV ownership in Malaysia. We explore the benefits of landed property installations and solar integration.',
        'excerpt_ms' => 'Ketahui mengapa memiliki stesen pengecasan di rumah adalah pengubah keadaan bagi pemilik EV di Malaysia. Kami meneroka kelebihan pemasangan di rumah bertanah dan integrasi solar.',
        'content' => '<h3>The Luxury of Home Charging</h3><p>Owning an electric vehicle (EV) in Malaysia is about more than just avoiding petrol stations. It\'s about a lifestyle shift toward convenience and sustainability. One of the most significant advantages is the ability to charge your car right at home.</p><h3>Why Landed Properties Have the Edge</h3><p>For those living in landed properties, installing a wallbox charger is a straightforward process that provides ultimate peace of mind. No more searching for public chargers or waiting in line. Plus, if you have solar panels installed, you can charge your vehicle using clean energy, further reducing your carbon footprint and monthly electricity bills.</p><h3>What About Condo Dwellers?</h3><p>If you live in a high-rise, don\'t worry. Many modern condominiums in Malaysia are starting to provide dedicated EV charging bays. It\'s important to check with your management before purchasing your EV to ensure you have a reliable place to power up.</p>',
        'content_ms' => '<h3>Kemewahan Mengecas di Rumah</h3><p>Memiliki kenderaan elektrik (EV) di Malaysia bukan sekadar mengelak stesen minyak. Ia adalah tentang peralihan gaya hidup ke arah keselesaan dan kelestarian. Salah satu kelebihan paling ketara adalah keupayaan untuk mengecas kereta anda terus di rumah.</p><h3>Mengapa Rumah Bertanah Mempunyai Kelebihan</h3><p>Bagi mereka yang tinggal di rumah bertanah, memasang pengecas wallbox adalah proses yang mudah yang memberikan ketenangan fikiran yang mutlak. Tidak perlu lagi mencari pengecas awam atau beratur. Selain itu, jika anda mempunyai panel solar yang dipasang, anda boleh mengecas kenderaan anda menggunakan tenaga bersih, seterusnya mengurangkan jejak karbon dan bil elektrik bulanan anda.</p><h3>Bagaimana Dengan Penghuni Kondo?</h3><p>Jika anda tinggal di bangunan tinggi, jangan risau. Banyak kondominium moden di Malaysia kini mula menyediakan ruang pengecasan EV khas. Adalah penting untuk menyemak dengan pihak pengurusan anda sebelum membeli EV anda untuk memastikan anda mempunyai tempat yang boleh dipercayai untuk mengecas.</p>',
        'image_url' => 'blog-assets/blog4-05052026.jpg',
    ],
    [
        'title' => 'Beyond the Battery: Essential Considerations Before Buying Your First EV',
        'title_ms' => 'Bukan Sekadar Bateri: Pertimbangan Penting Sebelum Membeli EV Pertama Anda',
        'excerpt' => 'Thinking of switching to an EV? It\'s not just about saving on fuel. Learn about travel planning, driving habits, and why a \'low key\' approach is best.',
        'excerpt_ms' => 'Berfikir untuk bertukar ke EV? Ia bukan sekadar menjimatkan bahan api. Ketahui tentang perancangan perjalanan, tabiat memandu, dan mengapa pendekatan \'low key\' adalah yang terbaik.',
        'content' => '<h3>More Than Just Petrol Savings</h3><p>Many Malaysians are drawn to EVs by the promise of zero fuel costs. However, as EV expert @thedaddyamtech points out, there are several practical factors to consider before making the jump. An EV can actually be more expensive if not used correctly.</p><h3>The Art of Travel Planning</h3><p>Unlike petrol cars, long-distance travel in an EV requires careful planning. If you\'re heading from Kuala Lumpur to Perlis, you need to map out your charging stops in advance. While charging stations are becoming more common, they aren\'t as ubiquitous as petrol stations yet—especially in rural areas.</p><h3>Drive \'Low Key\' for Maximum Range</h3><p>EVs are known for their instant torque and speed, but driving at 140-150 km/h consistently will drain your battery rapidly. To get the most out of your range, it\'s best to maintain a steady speed below 120 km/h. This \'low key\' driving style ensures you reach your destination without range anxiety.</p>',
        'content_ms' => '<h3>Lebih Daripada Sekadar Penjimatan Petrol</h3><p>Ramai rakyat Malaysia tertarik kepada EV kerana janji kos bahan api sifar. Walau bagaimanapun, seperti yang dinyatakan oleh pakar EV @thedaddyamtech, terdapat beberapa faktor praktikal yang perlu dipertimbangkan sebelum membuat keputusan. EV sebenarnya boleh menjadi lebih mahal jika tidak digunakan dengan betul.</p><h3>Seni Perancangan Perjalanan</h3><p>Tidak seperti kereta petrol, perjalanan jarak jauh dengan EV memerlukan perancangan yang teliti. Jika anda menuju dari Kuala Lumpur ke Perlis, anda perlu merancang hentian pengecasan anda terlebih dahulu. Walaupun stesen pengecasan semakin banyak, ia belum lagi berada di mana-mana seperti stesen minyak—terutamanya di kawasan luar bandar.</p><h3>Pandu \'Low Key\' untuk Jarak Maksimum</h3><p>EV dikenali dengan tork segera dan kelajuannya, tetapi memandu pada 140-150 km/j secara konsisten akan menghabiskan bateri anda dengan cepat. Untuk mendapatkan jarak maksimum, sebaiknya kekalkan kelajuan stabil di bawah 120 km/j. Gaya pemanduan \'low key\' ini memastikan anda sampai ke destinasi tanpa kebimbangan jarak.</p>',
        'image_url' => 'blog-assets/blog5-05052026.jpg',
    ]
];

foreach ($posts as $post) {
    BlogPost::create([
        'title' => $post['title'],
        'title_ms' => $post['title_ms'],
        'slug' => Str::slug($post['title']) . '-' . rand(100, 999),
        'excerpt' => $post['excerpt'],
        'excerpt_ms' => $post['excerpt_ms'],
        'content' => $post['content'],
        'content_ms' => $post['content_ms'],
        'image_url' => $post['image_url'],
        'category' => 'EV Charging',
        'author_name' => 'Amtech AI',
        'published_at' => Carbon::now(),
    ]);
    echo "Created: " . $post['title'] . "\n";
}
