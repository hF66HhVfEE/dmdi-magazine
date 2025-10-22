<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Categories
        $categories = [
            [
                'name_id' => 'Politik',
                'name_en' => 'Politics', 
                'slug' => 'politik',
                'description_id' => 'Berita dan analisis politik terkini',
                'description_en' => 'Latest political news and analysis'
            ],
            [
                'name_id' => 'Budaya',
                'name_en' => 'Culture', 
                'slug' => 'budaya',
                'description_id' => 'Artikel tentang seni, budaya, dan tradisi',
                'description_en' => 'Articles about art, culture and traditions'
            ],
            [
                'name_id' => 'Gaya Hidup',
                'name_en' => 'Lifestyle',
                'slug' => 'gaya-hidup', 
                'description_id' => 'Tips dan trend gaya hidup modern',
                'description_en' => 'Modern lifestyle tips and trends'
            ],
            [
                'name_id' => 'Teknologi',
                'name_en' => 'Technology',
                'slug' => 'teknologi',
                'description_id' => 'Perkembangan teknologi dan inovasi',
                'description_en' => 'Technology developments and innovations'
            ],
            [
                'name_id' => 'Bisnis',
                'name_en' => 'Business',
                'slug' => 'bisnis',
                'description_id' => 'Berita bisnis dan ekonomi',
                'description_en' => 'Business and economy news'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Articles
        $articles = [
            [
                'slug' => 'pemilu-2024-dan-masa-depan-demokrasi',
                'title_id' => 'Pemilu 2024 dan Masa Depan Demokrasi Indonesia',
                'title_en' => '2024 Election and the Future of Indonesian Democracy',
                'excerpt_id' => 'Pemilu 2024 menjadi momentum penting bagi konsolidasi demokrasi Indonesia. Partisipasi masyarakat dan transparansi menjadi kunci keberhasilan.',
                'excerpt_en' => 'The 2024 election is an important moment for Indonesian democracy consolidation. Public participation and transparency are keys to success.',
                'content_id' => "<p>Pemilihan umum 2024 di Indonesia menjadi sorotan dunia sebagai salah satu pesta demokrasi terbesar. Dengan lebih dari 200 juta pemilih, Indonesia membuktikan komitmennya terhadap proses demokratis.</p>\n\n<p>Transparansi dan akuntabilitas dalam proses pemilihan menjadi prioritas utama. Teknologi digital dimanfaatkan untuk meningkatkan pengawasan dan mencegah kecurangan. Partisipasi aktif masyarakat dalam mengawasi proses pemilihan menunjukkan kematangan demokrasi Indonesia.</p>\n\n<p>Para kandidat dari berbagai partai politik berlomba menawarkan visi dan program untuk kemajuan bangsa. Isu-isu seperti ekonomi, pendidikan, kesehatan, dan lingkungan menjadi fokus perdebatan publik.</p>",
                'content_en' => "<p>The 2024 general election in Indonesia has become a global spotlight as one of the largest democracy celebrations. With more than 200 million voters, Indonesia proves its commitment to the democratic process.</p>\n\n<p>Transparency and accountability in the election process are top priorities. Digital technology is used to increase oversight and prevent fraud. Active public participation in monitoring the election process shows the maturity of Indonesian democracy.</p>\n\n<p>Candidates from various political parties compete to offer visions and programs for the nation's progress. Issues such as economy, education, health, and environment are the focus of public debate.</p>",
                'featured_image' => null,
                'category_id' => 1,
                'author' => 'Rahman Hidayat',
                'view_count' => 2345,
                'is_published' => true,
                'is_featured' => true,
                'qr_code_path' => null
            ],
            [
                'slug' => 'seni-batik-warisan-budaya-dunia',
                'title_id' => 'Seni Batik: Warisan Budaya Dunia dari Indonesia',
                'title_en' => 'Batik Art: World Cultural Heritage from Indonesia', 
                'excerpt_id' => 'Batik Indonesia diakui UNESCO sebagai warisan budaya tak benda. Keindahan motif dan filosofi di balik setiap coraknya mencerminkan kearifan lokal.',
                'excerpt_en' => 'Indonesian batik is recognized by UNESCO as intangible cultural heritage. The beauty of motifs and philosophy behind each pattern reflects local wisdom.',
                'content_id' => "<p>Batik adalah salah satu warisan budaya Indonesia yang telah diakui oleh UNESCO pada tahun 2009. Seni membatik yang telah berusia ratusan tahun ini tidak hanya sekadar teknik pewarnaan kain, tetapi juga mengandung filosofi dan makna mendalam.</p>\n\n<p>Setiap motif batik memiliki cerita dan makna tersendiri. Motif parang misalnya, melambangkan kekuatan dan keteguhan. Sedangkan motif kawung mencerminkan kesucian dan keadilan. Keragaman motif batik dari berbagai daerah di Indonesia menunjukkan kekayaan budaya nusantara.</p>\n\n<p>Di era modern ini, batik tidak hanya digunakan dalam acara formal, tetapi juga telah merambah dunia fashion internasional. Para desainer muda Indonesia berhasil mengangkat batik ke panggung mode dunia dengan tetap mempertahankan nilai tradisionalnya.</p>",
                'content_en' => "<p>Batik is one of Indonesia's cultural heritages recognized by UNESCO in 2009. This centuries-old batik art is not just a fabric dyeing technique, but also contains deep philosophy and meaning.</p>\n\n<p>Each batik motif has its own story and meaning. The parang motif, for example, symbolizes strength and resilience. While the kawung motif reflects purity and justice. The diversity of batik motifs from various regions in Indonesia shows the richness of archipelago culture.</p>\n\n<p>In this modern era, batik is not only used in formal events, but has also penetrated the international fashion world. Young Indonesian designers have successfully brought batik to the world fashion stage while maintaining its traditional values.</p>",
                'featured_image' => null,
                'category_id' => 2,
                'author' => 'Dewi Lestari',
                'view_count' => 1876,
                'is_published' => true,
                'is_featured' => true,
                'qr_code_path' => null
            ],
            [
                'slug' => 'tips-hidup-sehat-di-era-digital',
                'title_id' => 'Tips Hidup Sehat di Era Digital',
                'title_en' => 'Healthy Living Tips in the Digital Age',
                'excerpt_id' => 'Gaya hidup digital membawa kemudahan sekaligus tantangan bagi kesehatan. Simak tips menjaga keseimbangan hidup sehat di tengah era teknologi.',
                'excerpt_en' => 'Digital lifestyle brings convenience as well as health challenges. Check out tips for maintaining a healthy life balance in the technology era.',
                'content_id' => "<p>Era digital membawa perubahan besar dalam gaya hidup kita. Kemudahan akses informasi dan komunikasi di satu sisi memberikan manfaat, namun di sisi lain juga membawa tantangan kesehatan.</p>\n\n<p>Salah satu masalah utama adalah screen time yang berlebihan. Terlalu lama menatap layar dapat menyebabkan kelelahan mata, gangguan tidur, dan masalah postur tubuh. Penting untuk mengatur waktu penggunaan gadget dan melakukan istirahat teratur.</p>\n\n<p>Olahraga rutin dan pola makan sehat tetap menjadi kunci utama. Jangan biarkan kemudahan teknologi membuat kita menjadi malas bergerak. Luangkan waktu minimal 30 menit setiap hari untuk berolahraga. Konsumsi makanan bergizi seimbang dan hindari junk food.</p>\n\n<p>Kesehatan mental juga tidak kalah penting. Batasi penggunaan media sosial dan luangkan waktu untuk berinteraksi langsung dengan keluarga dan teman. Praktikkan mindfulness dan meditasi untuk mengurangi stres.</p>",
                'content_en' => "<p>The digital era has brought major changes to our lifestyle. Easy access to information and communication on one hand provides benefits, but on the other hand also brings health challenges.</p>\n\n<p>One of the main problems is excessive screen time. Staring at screens for too long can cause eye fatigue, sleep disturbances, and posture problems. It's important to manage gadget usage time and take regular breaks.</p>\n\n<p>Regular exercise and a healthy diet remain the main keys. Don't let technology convenience make us lazy to move. Set aside at least 30 minutes every day to exercise. Consume balanced nutritious food and avoid junk food.</p>\n\n<p>Mental health is equally important. Limit social media use and make time for direct interaction with family and friends. Practice mindfulness and meditation to reduce stress.</p>",
                'featured_image' => null,
                'category_id' => 3,
                'author' => 'Dr. Rina Wijaya',
                'view_count' => 3421,
                'is_published' => true,
                'is_featured' => true,
                'qr_code_path' => null
            ],
            [
                'slug' => 'revolusi-ai-mengubah-dunia-kerja',
                'title_id' => 'Revolusi AI Mengubah Dunia Kerja',
                'title_en' => 'AI Revolution Transforming the World of Work',
                'excerpt_id' => 'Kecerdasan buatan (AI) mengubah lanskap pekerjaan. Profesi baru bermunculan sementara beberapa pekerjaan tradisional terancam tergantikan.',
                'excerpt_en' => 'Artificial intelligence (AI) is changing the employment landscape. New professions are emerging while some traditional jobs are threatened with replacement.',
                'content_id' => "<p>Kecerdasan buatan atau Artificial Intelligence (AI) telah menjadi teknologi yang paling disruptif di abad ini. Pengaruhnya terhadap dunia kerja sangat signifikan dan terus berkembang.</p>\n\n<p>Banyak pekerjaan rutin dan repetitif kini dapat dilakukan oleh AI dengan lebih efisien. Ini mendorong pekerja untuk meningkatkan keterampilan mereka ke arah yang lebih kreatif dan strategis. Profesi baru seperti AI specialist, data scientist, dan machine learning engineer menjadi sangat diminati.</p>\n\n<p>Perusahaan-perusahaan besar mulai mengintegrasikan AI dalam operasional mereka untuk meningkatkan produktivitas. Namun, tantangan etika dan privasi data menjadi perhatian serius yang harus diatur dengan baik.</p>\n\n<p>Pendidikan dan pelatihan keterampilan baru menjadi kunci adaptasi. Pemerintah dan institusi pendidikan harus berkolaborasi menyiapkan tenaga kerja yang siap menghadapi era AI ini.</p>",
                'content_en' => "<p>Artificial Intelligence (AI) has become the most disruptive technology of this century. Its influence on the world of work is very significant and continues to grow.</p>\n\n<p>Many routine and repetitive jobs can now be done by AI more efficiently. This encourages workers to upgrade their skills towards more creative and strategic directions. New professions such as AI specialist, data scientist, and machine learning engineer are in high demand.</p>\n\n<p>Large companies are starting to integrate AI into their operations to increase productivity. However, ethical challenges and data privacy are serious concerns that must be well regulated.</p>\n\n<p>Education and training in new skills are key to adaptation. Government and educational institutions must collaborate to prepare a workforce ready to face this AI era.</p>",
                'featured_image' => null,
                'category_id' => 4,
                'author' => 'Budi Santoso',
                'view_count' => 2890,
                'is_published' => true,
                'is_featured' => false,
                'qr_code_path' => null
            ],
            [
                'slug' => 'startup-indonesia-menarik-investasi-asing',
                'title_id' => 'Startup Indonesia Menarik Investasi Asing',
                'title_en' => 'Indonesian Startups Attract Foreign Investment',
                'excerpt_id' => 'Ekosistem startup Indonesia terus berkembang pesat. Beberapa unicorn dan decacorn berhasil menarik minat investor internasional.',
                'excerpt_en' => 'Indonesian startup ecosystem continues to grow rapidly. Several unicorns and decacorns have successfully attracted international investor interest.',
                'content_id' => "<p>Indonesia telah menjadi salah satu negara dengan ekosistem startup paling dinamis di Asia Tenggara. Dengan populasi lebih dari 270 juta jiwa dan penetrasi internet yang terus meningkat, pasar Indonesia menawarkan potensi pertumbuhan yang sangat besar.</p>\n\n<p>Beberapa perusahaan teknologi Indonesia telah mencapai status unicorn dengan valuasi miliaran dollar. Mereka bergerak di berbagai sektor mulai dari e-commerce, fintech, hingga layanan transportasi online. Keberhasilan ini tidak terlepas dari dukungan ekosistem yang semakin matang.</p>\n\n<p>Investor asing mulai melirik Indonesia sebagai destinasi investasi yang menjanjikan. Regulasi yang semakin kondusif dan dukungan pemerintah terhadap ekonomi digital menjadi daya tarik tersendiri. Program-program inkubasi dan akselerator bermunculan untuk membantu startup berkembang.</p>\n\n<p>Tantangan tetap ada, terutama terkait infrastruktur digital dan talent gap. Namun dengan kolaborasi semua pihak, masa depan startup Indonesia terlihat cerah.</p>",
                'content_en' => "<p>Indonesia has become one of the countries with the most dynamic startup ecosystems in Southeast Asia. With a population of more than 270 million and increasing internet penetration, the Indonesian market offers tremendous growth potential.</p>\n\n<p>Several Indonesian technology companies have achieved unicorn status with billion-dollar valuations. They operate in various sectors ranging from e-commerce, fintech, to online transportation services. This success is inseparable from the support of an increasingly mature ecosystem.</p>\n\n<p>Foreign investors are starting to look at Indonesia as a promising investment destination. Increasingly conducive regulations and government support for the digital economy are special attractions. Incubation and accelerator programs are emerging to help startups grow.</p>\n\n<p>Challenges remain, especially related to digital infrastructure and talent gap. However, with collaboration from all parties, the future of Indonesian startups looks bright.</p>",
                'featured_image' => null,
                'category_id' => 5,
                'author' => 'Andi Wijaya',
                'view_count' => 1654,
                'is_published' => true,
                'is_featured' => false,
                'qr_code_path' => null
            ],
            [
                'slug' => 'festival-kuliner-nusantara',
                'title_id' => 'Festival Kuliner Nusantara: Merayakan Kekayaan Rasa',
                'title_en' => 'Nusantara Culinary Festival: Celebrating the Richness of Flavors',
                'excerpt_id' => 'Festival kuliner nusantara menampilkan berbagai masakan tradisional dari Sabang sampai Merauke. Kelezatan dan keunikan setiap daerah menjadi daya tarik utama.',
                'excerpt_en' => 'The Nusantara culinary festival showcases various traditional dishes from Sabang to Merauke. The deliciousness and uniqueness of each region are the main attractions.',
                'content_id' => "<p>Indonesia memiliki kekayaan kuliner yang luar biasa. Setiap daerah memiliki cita rasa dan keunikan tersendiri yang mencerminkan budaya dan tradisi masyarakatnya.</p>\n\n<p>Festival kuliner nusantara menjadi wadah untuk memperkenalkan berbagai masakan tradisional kepada masyarakat luas. Dari rendang Padang, gudeg Jogja, soto Betawi, hingga papeda Papua, semua dapat ditemukan dalam satu tempat.</p>\n\n<p>Para chef dan pelaku usaha kuliner berbagi resep dan cerita di balik setiap hidangan. Tidak hanya tentang rasa, tetapi juga filosofi dan sejarah yang terkandung dalam setiap masakan.</p>\n\n<p>Acara ini juga menjadi momentum untuk mempromosikan pariwisata kuliner Indonesia ke mancanegara. Dengan keunikan dan kelezatannya, kuliner Indonesia berpotensi menjadi daya tarik wisatawan internasional.</p>",
                'content_en' => "<p>Indonesia has extraordinary culinary wealth. Each region has its own taste and uniqueness that reflects the culture and traditions of its people.</p>\n\n<p>The Nusantara culinary festival becomes a forum to introduce various traditional dishes to the wider community. From Padang rendang, Jogja gudeg, Betawi soto, to Papuan papeda, all can be found in one place.</p>\n\n<p>Chefs and culinary business actors share recipes and stories behind each dish. Not only about taste, but also the philosophy and history contained in each cuisine.</p>\n\n<p>This event is also a momentum to promote Indonesian culinary tourism abroad. With its uniqueness and deliciousness, Indonesian cuisine has the potential to become an attraction for international tourists.</p>",
                'featured_image' => null,
                'category_id' => 3,
                'author' => 'Chef William Wongso',
                'view_count' => 1432,
                'is_published' => true,
                'is_featured' => false,
                'qr_code_path' => null
            ]
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}