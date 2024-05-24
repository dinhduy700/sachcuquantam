<?php

/**
 * Banner Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Banner;

use App\Models\BannerTranslation;

/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class BannerRepository
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination)
    {   
        $banner = Banner::orderBy('type', 'ASC')->orderBy('banner_position', 'ASC');
        if (!empty($pagination)) {
            $banner = $banner->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $banner = $banner->get();
        }
        return $banner;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            // 'banner_page' => $request->banner_page ?? 0,
            'banner_position' => $request->banner_position ?? 0,
            'is_active' => $request->is_active ?? 0,
            'has_button' => $request->has_button ?? 0,
            'type' => $request->type ?? 0
        ];

        $banner = Banner::create($data);
    
        if ($banner) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation[] = [
                    'locale' => $lang,
                    'banner_id' => $banner->id,
                    'banner_title' => $request->$lang['banner_title'] ?? null,
                    'banner_image' => $request->$lang['banner_image'] ?? null,
                    'banner_link'  => $request->$lang['banner_link'] ?? null,
                    'banner_content' => $request->$lang['banner_content'] ?? null
                ];
            }
            BannerTranslation::insert($dataTranslation);
        }
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $banner)
    {
        $data = [
            // 'banner_page' => $request->banner_page ?? 0,
            'banner_position' => $request->banner_position ?? 0,
            'is_active' => $request->is_active ?? 0,
            'has_button' => $request->has_button ?? 0,
            'type' => $request->type ?? 0
        ];
        Banner::where('id', $banner)->update($data);
        if ($banner) {
            $languages = config('constants.multilang');
            foreach ($languages as $lang) {
                $dataTranslation = [
                    'banner_title' => $request->$lang['banner_title'] ?? null,
                    'banner_image' => $request->$lang['banner_image'] ?? null,
                    'banner_link'  => $request->$lang['banner_link'] ?? null,
                    'banner_content' => $request->$lang['banner_content'] ?? null
                ];
                BannerTranslation::where(['locale' => $lang, 'banner_id' => $banner])->update($dataTranslation);
            }
        }
    }

    public function getInformationBanner($banner)
    {
        return Banner::findOrFail($banner);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($banner)
    {
        Banner::find($banner)->delete();
    }

    public function getBannerListIndex($type, $first)
    {
        $banner = Banner::orderBy('type', 'ASC')->orderBy('banner_position', 'ASC');
        if($type == 0)
        {
            $banner = $banner->where('type', 0);
        }
        if($type == 1)
        {
            $banner = $banner->where('type', 1);
        }
        if($type == 2)
        {
            $banner = $banner->where('type', 2);
        }
        if($type == 3)
        {
            $banner = $banner->where('type', 3);
        }
        if($type == 4)
        {
            $banner = $banner->where('type', 4);
        }

        $banner = $banner->where('is_active', 1);
        if($first == 0)
        {
            if (!empty($pagination)) {
                $banner = $banner->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
            } else {
                $banner = $banner->get();
            }
        }
        else
        {
            $banner = $banner->first();
        }
        return $banner;
    }
}