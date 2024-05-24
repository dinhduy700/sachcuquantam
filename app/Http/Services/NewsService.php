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

use App\Http\Repositories\NewsRepository;

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

class NewsService
{
    /**
     * Create variable Banner
     *
     * @var $bannerRepository
     */
    protected $newsRepository;

    /**
     * BannerService constructor
     *
     * @param newsRepository $newsRepository callback object
     */
    public function __construct(
        NewsRepository $newsRepository
    ) {
        $this->newsRepository = $newsRepository;
    }

    /**
     * Get banner list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getNewsList($pagination = null, $search = null, $status = null, $sortBy = null)
    {
        return $this->newsRepository->list($pagination, $search, $status, $sortBy);
    }
    /**
     * Store banner service
     *
     * @param \Illuminate\Http\Request $request - send information banner
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNews($request)
    {
        DB::beginTransaction();
        try {
            $news = $this->newsRepository->store($request);
            $result = [
                'id' => $news->id,
                'active' => $news->is_active,
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
    public function updateNews($request, $news)
    {
        DB::beginTransaction();
        try {
            $this->newsRepository->update($request, $news);
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
    public function deleteNews($news)
    {
        DB::beginTransaction();
        try {
            $this->newsRepository->delete($news);
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
    public function getInformationNews($news)
    {
        return $this->newsRepository->getInformationNews($news);
    }

    /**
     * Get news Recent list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getNewsListN($pagination = null, $search = null, $status = null, $sortBy = null)
    {
        return $this->newsRepository->listN($pagination, $search, $status, $sortBy);
    }

    /**
     * Get information news by slug
     *
     * @param $slug
     * 
     * @return @return object
     */
    public function getDetailNewsBySlug($slug)
    {
        return $this->newsRepository->getDetailNewsBySlug($slug);
    }

    public function getNewsByTags($slug)
    {
        return $this->newsRepository->getNewsByTags($slug);
    }

    public function getNewsForIndex()
    {
        return $this->newsRepository->getNewsForIndex();
    }
}
