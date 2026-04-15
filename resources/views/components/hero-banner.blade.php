@include('components.carousel', [
    'items' => [
        ['id' => 1, 'title' => '', 'image' => '/carousel/banner-1.jpg'],
        ['id' => 2, 'title' => '', 'image' => '/carousel/banner-2.jpg'],
        ['id' => 3, 'title' => '', 'image' => '/carousel/banner-3.jpg'],
    ],
    'autoPlayInterval' => 5000,
])