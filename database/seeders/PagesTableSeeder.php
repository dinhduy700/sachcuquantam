<?php
/**
 * Create Page Seeder Application
 * PHP version ^7.3|^8.0
 *
 * @category THP_Ecommerce
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\PageTranslation;

/**
 * Class PagesTableSeeder
 * PHP version ^7.3|^8.0
 *
 * @category Page_Seeder
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'id' => 1,
                'page_name' => 'Trang chủ',
                'is_active' => 1
            ],
            [
                'id' => 2,
                'page_name' => 'Giới thiệu',
                'is_active' => 1
            ],
            [
                'id' => 3,
                'page_name' => 'Sản phẩm',
                'is_active' => 1
            ],
            [
                'id' => 4,
                'page_name' => 'Video',
                'is_active' => 1
            ],
            [
                'id' => 5,
                'page_name' => 'Tin tức',
                'is_active' => 1
            ],
            [
                'id' => 6,
                'page_name' => 'Liên hệ',
                'is_active' => 1
            ],
            [
                'id' => 7,
                'page_name' => 'Chính sách bảo mật',
                'is_active' => 1
            ],
            [
                'id' => 8,
                'page_name' => 'Điều khoản dịch vụ',
                'is_active' => 1
            ],
            [
                'id' => 9,
                'page_name' => 'Bảo hành và đổi trả',
                'is_active' => 1
            ],
            [
                'id' => 10,
                'page_name' => 'Vận chuyển và lắp đặt',
                'is_active' => 1
            ],
            [
                'id' => 11,
                'page_name' => 'Phương thức thanh toán',
                'is_active' => 1
            ],
            [
                'id' => 12,
                'page_name' => 'Câu hỏi thường gặp',
                'is_active' => 1
            ]
        ];

        Page::upsert($pages, ['id']);

        foreach (config('constants.multilang') as $key => $locale) {
            $pageTranslation = [
                [
                    'id' => 1 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 1,
                    'page_title' => 'Trang chủ',
                    'page_slug' => null
                ],
                [
                    'id' => 2 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 2,
                    'page_title' => 'Giới thiệu',
                    'page_slug' => 'gioi-thieu'
                ],
                [
                    'id' => 3 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 3,
                    'page_title' => 'Sản phẩm',
                    'page_slug' => 'san-pham'
                ],
                [
                    'id' => 4 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 4,
                    'page_title' => 'Video',
                    'page_slug' => 'video'
                ],
                [
                    'id' => 5 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 5,
                    'page_title' => 'Tin tức',
                    'page_slug' => 'tin-tuc'
                ],
                [
                    'id' => 6 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 6,
                    'page_title' => 'Liên hệ',
                    'page_slug' => 'lien-he'
                ],
                [
                    'id' => 7 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 7,
                    'page_title' => 'Chính sách bảo mật',
                    'page_slug' => 'chinh-sach-bao-mat'
                ],
                [
                    'id' => 8 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 8,
                    'page_title' => 'Điều khoản dịch vụ',
                    'page_slug' => 'dieu-khoan-dich-vu'
                ],
                [
                    'id' => 9 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 9,
                    'page_title' => 'Bảo hành và đổi trả',
                    'page_slug' => 'bao-hanh-doi-tra'
                ],
                [
                    'id' => 10 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 10,
                    'page_title' => 'Vận chuyển và lắp đặt',
                    'page_slug' => 'van-chuyen-lap-dat'
                ],
                [
                    'id' => 11 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 11,
                    'page_title' => 'Phương thức thanh toán',
                    'page_slug' => 'phuong-thuc-thanh-toan'
                ],
                [
                    'id' => 12 + ($key * 12),
                    'locale' => $locale,
                    'page_id' => 12,
                    'page_title' => 'Câu hỏi thường gặp',
                    'page_slug' => 'cau-hoi-thuong-gap'
                ]
            ];
            PageTranslation::upsert($pageTranslation, ['id']);
        }
    }
}
