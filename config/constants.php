<?php
$multilang = ['vi','en'];

$lang_default = 'vi';


$banner = $newsFilter = $statusFilter = [];


foreach ($multilang as $lang) {
    $banner[$lang] = [
        'header', 'promotion', 'top_product', 'event', 'newsletter'
    ];
    $newsFilter[$lang] = [
        'title_a-z', 'title_z-a', 'oldest_first', 'newest_first'
    ];
    $statusFilter[$lang] = [
        'inactive', 'active'
    ];
    $contactStatusFilter[$lang] = [
        'pending', 'approved'
    ];
}

return [
    'multilang' => $multilang,
    'lang_default' => $lang_default,
    'full_locale' => [
        'vi' => 'vietnamese',
        'en' => 'english'
    ],
    'locale' => ['en'],
    'flag_locale' => [
        'vi' => 'vietnam.png',
        //'en' => 'united-states.png'
    ],
    'status' => [
        'active' => 1,
        'inactive' => 0,
        'pending' => 2
    ],
    'pagination' => 10,
    'itemsOption' => [10, 20, 50],
    'banner_type' => $banner,
    'news_filter' => $newsFilter,
    'status_filter' => $statusFilter,
    'contact_status_filter' => $contactStatusFilter,
    'no_image_url' => 'assets/images/no-image.jpg',
    'icon_notify' => [
        'fa-user-plus',
        'fa-file-invoice-dollar'
    ],
];
