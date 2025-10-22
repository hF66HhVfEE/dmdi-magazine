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
                'name_id' => 'Budaya Melayu',
                'name_en' => 'Malay Culture', 
                'slug' => 'budaya-melayu',
                'description_id' => 'Artikel tentang budaya dan tradisi Melayu',
                'description_en' => 'Articles about Malay culture and traditions'
            ],
            [
                'name_id' => 'Sejarah Islam',
                'name_en' => 'Islamic History',
                'slug' => 'sejarah-islam', 
                'description_id' => 'Sejarah peradaban Islam di Indonesia',
                'description_en' => 'History of Islamic civilization in Indonesia'
            ],
            [
                'name_id' => 'Pendidikan',
                'name_en' => 'Education',
                'slug' => 'pendidikan',
                'description_id' => 'Artikel pendidikan dan pengembangan diri',
                'description_en' => 'Education and self-development articles'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Articles
        $articles = [
            [
                'slug' => 'keindahan-budaya-melayu-indonesia',
                'title_id' => 'Keindahan Budaya Melayu di Indonesia',
                'title_en' => 'The Beauty of Malay Culture in Indonesia',
                'excerpt_id' => 'Budaya Melayu memiliki kekayaan yang luar biasa dalam seni, bahasa, dan tradisi...',
                'excerpt_en' => 'Malay culture has incredible richness in art, language, and traditions...',
                'content_id' => "Budaya Melayu di Indonesia merupakan warisan yang sangat berharga. Dari ujung Sumatera hingga Kalimantan, budaya Melayu menyebar dengan keunikan masing-masing daerah.\n\nBahasa Melayu menjadi lingua franca yang menyatukan berbagai suku bangsa. Selain itu, seni musik seperti gambus, zapin, dan hadrah menjadi ciri khas yang masih dilestarikan hingga kini.\n\nTradisi seperti pantun, syair, dan gurindam menunjukkan kedalaman sastra Melayu yang patut dibanggakan.",
                'content_en' => "Malay culture in Indonesia is a very valuable heritage. From the tip of Sumatra to Kalimantan, Malay culture spreads with the uniqueness of each region.\n\nThe Malay language became the lingua franca that united various ethnic groups. In addition, musical arts such as gambus, zapin, and hadrah are typical features that are still preserved today.\n\nTraditions such as pantun, syair, and gurindam show the depth of Malay literature that should be proud of.",
                'featured_image' => null,
                'category_id' => 1,
                'author' => 'Ahmad Rizki',
                'view_count' => 150,
                'is_published' => true,
                'is_featured' => true,
                'qr_code_path' => null
            ],
            [
                'slug' => 'perkembangan-islam-di-nusantara',
                'title_id' => 'Perkembangan Islam di Nusantara',
                'title_en' => 'The Development of Islam in the Archipelago', 
                'excerpt_id' => 'Islam datang ke Nusantara melalui jalur perdagangan dan disebarkan dengan damai...',
                'excerpt_en' => 'Islam came to the Archipelago through trade routes and was spread peacefully...',
                'content_id' => "Islam masuk ke Nusantara melalui para pedagang dari Arab, Persia, dan India. Proses islamisasi berlangsung secara damai dan bertahap.\n\nWali Songo berperan penting dalam menyebarkan Islam di Jawa dengan pendekatan kultural yang bijaksana. Mereka tidak menghapus tradisi lokal, melainkan mengislamkannya.\n\nHingga kini, Islam menjadi agama mayoritas di Indonesia dengan karakter yang khas dan moderat.",
                'content_en' => "Islam entered the Archipelago through traders from Arabia, Persia, and India. The Islamization process took place peacefully and gradually.\n\nThe Wali Songo played an important role in spreading Islam in Java with a wise cultural approach. They did not erase local traditions, but rather Islamicized them.\n\nUntil now, Islam has become the majority religion in Indonesia with unique and moderate characteristics.",
                'featured_image' => null,
                'category_id' => 2,
                'author' => 'Siti Fatimah',
                'view_count' => 89,
                'is_published' => true,
                'is_featured' => false,
                'qr_code_path' => null
            ],
            [
                'slug' => 'pentingnya-pendidikan-islam-modern',
                'title_id' => 'Pentingnya Pendidikan Islam Modern',
                'title_en' => 'The Importance of Modern Islamic Education',
                'excerpt_id' => 'Pendidikan Islam modern harus mengintegrasikan nilai-nilai agama dengan ilmu pengetahuan...',
                'excerpt_en' => 'Modern Islamic education must integrate religious values with science...',
                'content_id' => "Pendidikan Islam di era modern menghadapi tantangan yang kompleks. Di satu sisi, harus mempertahankan nilai-nilai agama, di sisi lain harus mengikuti perkembangan zaman.\n\nIntegrasi antara ilmu agama dan ilmu umum menjadi kunci keberhasilan pendidikan Islam modern. Pesantren dan madrasah kini mulai mengadopsi kurikulum yang seimbang.\n\nDengan pendekatan yang tepat, pendidikan Islam dapat melahirkan generasi yang religius namun tetap kompetitif di dunia global.",
                'content_en' => "Islamic education in the modern era faces complex challenges. On one hand, it must maintain religious values, on the other hand it must follow the times.\n\nIntegration between religious science and general science is the key to the success of modern Islamic education. Islamic boarding schools and madrasas are now starting to adopt balanced curricula.\n\nWith the right approach, Islamic education can produce a generation that is religious but still competitive in the global world.",
                'featured_image' => null,
                'category_id' => 3,
                'author' => 'Dr. Muhammad Ali',
                'view_count' => 67,
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