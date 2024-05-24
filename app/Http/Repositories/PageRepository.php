<?php

/**
 * Page Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Page;

use App\Models\PageTranslation;

use Illuminate\Support\Str;

/**
 * Page Repositories handle query for module Product
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class PageRepository
{
    /**
     * Query get list page
     *
     * @return \Illuminate\Http\Response
     */
    public function activeList()
    {
        return Page::active()->get();
    }

    /**
     * Query get list page
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return Page::get();
    }

    /**
     * Update information page
     * 
     * @param Request          $request - send information page
     * @param \App\Models\Page $page  - page
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $page)
    {
        $data = [
            'page_image' => $request->page_image ?? null,
            'is_active' => $request->is_active ?? 1,
        ];
        Page::where('id', $page)->update($data);
        if ($page) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'page_title' => $request->$lang['page_title'] ?? null,
                    'page_slug'  => $page != 1 ? ($request->$lang['page_slug'] ?? Str::slug($request->$lang['page_title']) . '-' . $page) : '',
                    'page_description' => $request->$lang['page_description'] ?? null,
                    'page_content' => $request->$lang['page_content'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null
                ];
                PageTranslation::where(['locale' => $lang, 'page_id' => $page])->update($dataTranslation);
            }
        }
    }

    public function getInformationPage($page)
    {
        return Page::findOrFail($page);
    }

    public function getPageBySlug($slug)
    {
        return Page::with('translation')->whereHas('translation', function($query) use ($slug) {
            $query->where('page_slug', $slug);
        })->first();
    }
}