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

use App\Http\Repositories\VideoRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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

class VideoService
{
    /**
     * Create variable Banner
     *
     * @var $bannerRepository
     */
    protected $videoRepository;

    /**
     * BannerService constructor
     *
     * @param tagsRepository $newsRepository callback object
     */
    public function __construct(
        VideoRepository $videoRepository
    ) {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Get banner list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getVideoList($pagination = null, $search = null, $status = null, $sortBy = null)
    {
        return $this->videoRepository->list($pagination, $search, $status, $sortBy);
    }

    /**
     * Store banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     *
     * @return \Illuminate\Http\Response
     */
    public function storeVideo($request)
    {
        DB::beginTransaction();
        try {
            $this->videoRepository->store($request);
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
    public function updateVideo($request, $video)
    {
        DB::beginTransaction();
        try {
            $this->videoRepository->update($request, $video);
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
    public function deleteVideo($video)
    {
        DB::beginTransaction();
        try {
            $this->videoRepository->delete($video);
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
        return $result;
    }

    /**
     * Get information banner service
     *
     * @param \App\Models\Banner $banner - banner detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getInformationVideo($video)
    {
        return $this->videoRepository->getInformationVideo($video);
    }
}
