<?php

/**
 * Banner Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

/**
 * Banner Service call query in repositories
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class UserService
{
    /**
     * Create variable Banner
     *
     * @var $bannerRepository
     */
    protected $userRepository;

    /**
     * BannerService constructor
     *
     * @param tagsRepository $newsRepository callback object
     */
    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Get banner list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getUserList($pagination = null, $search = null, $status = null)
    {
        return $this->userRepository->list($pagination, $search, $status);
    }

    /**
     * Store banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     *
     * @return \Illuminate\Http\Response
     */
    public function storeUser($request)
    {
        DB::beginTransaction();
        try {
            $this->userRepository->store($request);
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

    /**
     * Update banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     * @param \App\Models\Banner       $banner  - banner edit
     * 
     * @return \Illuminate\Http\Response save product category information
     */
    public function updateUser($request, $user)
    {
        DB::beginTransaction();
        try {
            $this->userRepository->update($request, $user);
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

    /**
     * Delete product category service
     *
     * @param \App\Models\ProductCategory $category - category detail delete
     * 
     * @return \Illuminate\Http\Response delete product category information
     */
    public function deleteUser($user)
    {
        if (Auth::user()->id != $user) {
            DB::beginTransaction();
            try {
                $this->userRepository->delete($user);
                $result = [
                    'message' => __('messages.delete_success'),
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
        } else {
            $result = [
                'message' => __('messages.data_invalid'),
                'status'  => Response::HTTP_FORBIDDEN 
            ];
        }
        return $result;
    }

    /**
     * Get information banner service
     *
     * @param \App\Models\Banner $banner - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getInformationUser($user)
    {
        return $this->userRepository->getInformationUser($user);
    }
}
