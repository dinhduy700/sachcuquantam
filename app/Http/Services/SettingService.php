<?php

/**
 * Setting Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\SettingRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;

use Illuminate\View\View;
/**
 * Setting Service call query in repositories
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class SettingService
{
    /**
     * Create variable settingRepository
     * 
     * @var $settingRepository
     */
    protected $settingRepository;

    /**
     * SettingService constructor
     *
     * @param SettingRepository $settingRepository callback object
     */
    public function __construct(
        SettingRepository $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Get data information setting in admin
     * 
     * @return \Illuminate\Http\Response $setting
     */
    public function getSettingService()
    {
        return $this->settingRepository->getSetting();
    }

    /**
     * Save setting information service
     *
     * @param Request $request - send information setting
     * 
     * @return \Illuminate\Http\Response
     */
    public function saveSetting($request)
    {
        DB::beginTransaction();
        try {
            $this->settingRepository->upsertSetting($request);
            $result = [
                'message' => __('messages.save_success'),
                'status'  => Response::HTTP_OK
            ];
            DB::commit();
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            if ($e instanceof ModelNotFoundException) {
                $result = [
                    'message' => __('messages.data_not_found'),
                    'status'  => Response::HTTP_NOT_FOUND
                ];
            } else {
                $result = [
                    'message' => __('messages.internal_server_error'),
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR
                ];
            }
            DB::rollback();
        }
        return $result;
    }

    public function compose(View $view)
    {
        $view->with('settings', $this->getSettingService());
    }
}
