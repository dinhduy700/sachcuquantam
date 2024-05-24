<?php

/**
 * Page Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\PageRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;
/**
 * Page Service call query in repositories
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class PageService
{
    /**
     * Create variable Page
     *
     * @var $pageRepository
     */
    protected $pageRepository;

    /**
     * PageService constructor
     *
     * @param PageRepository $pageRepository callback object
     */
    public function __construct(
        PageRepository $pageRepository
    ) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Get page list
     * 
     * @return array
     */
    public function getPageActiveList()
    {
        return $this->pageRepository->activeList();
    }

    /**
     * Get page list
     * 
     * @return array
     */
    public function getPageList()
    {
        return $this->pageRepository->list();
    }

    /**
     * Update page service
     *
     * @param \Illuminate\Http\Request $request - send information page
     * @param \App\Models\Page         $page    - page edit
     * 
     * @return \Illuminate\Http\Response save product category information
     */
    public function updatePage($request, $page)
    {
        DB::beginTransaction();
        try {
            $this->pageRepository->update($request, $page);
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
     * Get information page service
     *
     * @param \App\Models\Page $page - page detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getInformationPage($page)
    {
        return $this->pageRepository->getInformationPage($page);
    }

    public function getPageBySlug($slug = null)
    {
        return $this->pageRepository->getPageBySlug($slug);
    }
}
