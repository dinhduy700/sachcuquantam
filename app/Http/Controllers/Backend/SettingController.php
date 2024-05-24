<?php

/**
 * Setting Controller Application
 * PHP version ^7.3|^8.0
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\SettingService;

use App\Http\Services\PartnerService;

use Illuminate\Http\Response;

/**
 * Setting controller handle query for module Setting
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class SettingController extends Controller
{
    /**
     * Create variable settingService
     * 
     * @var $settingService
     */
    protected $settingService;
    protected $partnerService;

    /**
     * __construct
     *
     * @param SettingService $settingService - callback object
     */
    public function __construct(
        SettingService $settingService,
        PartnerService $partnerService
    ) {
        $this->settingService = $settingService;
        $this->partnerService = $partnerService;
    }

    /**
     * Get information setting in site
     * 
     * @return view data setting
     */
    public function index()
    {
        $setting = $this->settingService->getSettingService();
        $partners = $this->partnerService->list();
        return view('backend.setting.index', compact('setting','partners'));
    }

    /**
     * Handle save information setting in site
     *
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $response = $this->settingService->saveSetting($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.setting.index')->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }
}
