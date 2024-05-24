<?php

/**
 * Setting Repository Application
 * PHP version ^7.3|^8.0
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Setting;

use App\Models\SettingTranslation;

use App\Models\Partners;

/**
 * Setting Repository handle query for module Setting
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class SettingRepository
{
    /**
     * Query get data setting in site
     *
     * @return \Illuminate\Http\Response 
     */
    public function getSetting()
    {
        return Setting::orderBy('id', 'DESC')->first();
    }

    /**
     * Save information setting
     * 
     * @param Request $request - send information setting
     * 
     * @return \Illuminate\Http\Response 
     */
    public function upsertSetting($request)
    {
        $data = [
            'id' => 1,
            'logo' => $request->logo ?? null,
            'logo_footer' => $request->logo_footer ?? null,
            'email' => $request->email ?? null,
            'tel' => $request->tel ?? null,
            'hotline' => $request->hotline ?? null,
            'fax' => $request->fax ?? null,
            'map' => $request->map ?? null,
            'facebook' => $request->facebook ?? null,
            'google_plus' => $request->google_plus ?? null,
            'pinterest' => $request->pinterest ?? null,
            'instagram' => $request->instagram ?? null,
            'twitter' => $request->twitter ?? null,
            'youtube' => $request->youtube ?? null,
            'zalo' => $request->zalo ?? null,
            'tiktok' => $request->tiktok ?? null,
            'fanpage' => $request->fanpage ?? null,
            'fb_script' => $request->fb_script ?? null,
            'zalo_script' => $request->zalo_script ?? null,
            'google_analystics' => $request->google_analystics ?? null,
            'ecommerce_industry' => $request->ecommerce_industry ?? null,
        ];

        $setting = Setting::upsert($data, ['id']);
    
        if ($setting) {
            $languages = config('constants.multilang');
            foreach ($languages as $key => $lang) {
                $dataTranslation[] = [
                    'id' => 1 + $key,
                    'locale' => $lang,
                    'setting_id' => 1,
                    'site' => $request->$lang['site'] ?? null,
                    'description' => $request->$lang['description'] ?? null,
                    'office' => $request->$lang['office'] ?? null,
                    'working_time' => $request->$lang['working_time'] ?? null,
                    'address' => $request->$lang['address'] ?? null,
                    'bank_information' => $request->$lang['bank_information'] ?? null,
                    'policy' => $request->$lang['policy'] ?? null,
                    'payment_at' => $request->$lang['payment_at'] ?? null,
                    'shipping_free' => $request->$lang['shipping_free'] ?? null,
                    'staffs' => $request->$lang['staffs'] ?? null,
                    'seo_title' => $request->$lang['seo_title'] ?? null,
                    'seo_description' => $request->$lang['seo_description'] ?? null,
                    'seo_keywords' => $request->$lang['seo_keywords'] ?? null,
                ];
            }
            SettingTranslation::upsert($dataTranslation, ['id']);
        }

        for($i = 0;$i <= 5; $i++){
            $dataPartner = [
                'id' => $i+1,
                'name' => '',
                'logo' =>$request->partner_logo[$i] ?? null,
                'link' =>$request->partner_link[$i] ?? null,
                'position' =>0,
                'is_active' =>$request->partner_is_active[$i] ?? null,
            ];
            Partners::upsert($dataPartner, ['id']);
        }
    }

}