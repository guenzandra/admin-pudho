<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsArticle;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title'    => 'Likhang Sining: Simbolo ng Pag-ibig at Dakilang Layunin',
                'excerpt'  => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig? Marahil ang pag-ibig sa kapwa ay siyang pinakadakilang...',
                'date'     => '2026-02-14',
                'author'   => 'PUDHO Staff',
                'category' => 'Community',
                'tags'     => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna', '#pudholaguna'],
                'image'    => '/news/article-1.jpg',
                'content'  => 'Ano nga ba para sa inyo ang kahulugan ng tunay na pag-ibig?...',
            ],
            [
                'title'    => 'Serbisyong May Malasakit: Programang Pabahay para sa mga ISF ng Bayan ng Pangil',
                'excerpt'  => 'Isinagawa nitong Pebrero 11, 2026, sa opisina ng Punong Bayan ng Pangil ang courtesy visit...',
                'date'     => '2026-02-11',
                'author'   => 'PUDHO Staff',
                'category' => 'Housing',
                'tags'     => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna', '#pudholaguna'],
                'image'    => null,
                'content'  => 'Isinagawa nitong Pebrero 11, 2026...',
            ],
            [
                'title'    => 'Tuluy-Tuloy na Ugnayan, Tiyak na Pabahay!',
                'excerpt'  => 'Ang palagiang koordinasyon at malinaw na komunikasyon sa pagitan ng mga ahensya sa pabahay...',
                'date'     => '2026-02-05',
                'author'   => 'PUDHO Staff',
                'category' => 'Housing',
                'tags'     => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna'],
                'image'    => '/news/article-3.jpg',
                'content'  => 'Ang palagiang koordinasyon...',
            ],
            [
                'title'    => 'SA CABUYAO NA ANG SUSUNOD NA HAKBANG MO!',
                'excerpt'  => 'Hindi na lamang dating bayan ang Lungsod ng Cabuyao, ito na ngayon ay isang FIRST-CLASS CITY...',
                'date'     => '2026-01-28',
                'author'   => 'PUDHO Staff',
                'category' => 'Development',
                'tags'     => ['#AkayniGobActionCenter', '#GobyernongMaySolusyon', '#GobSolAragones', '#SOLidLaguna'],
                'image'    => null,
                'content'  => 'Hindi na lamang dating bayan ang Lungsod ng Cabuyao...',
            ],
        ];

        foreach ($articles as $article) {
            NewsArticle::create($article);
        }
    }
}