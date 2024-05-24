<?php

/**
 * Product's Category Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Product_Category
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\ProductCategoryRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\View\View;

use Illuminate\Support\Facades\Log;
/**
 * Product's Category Service call query in repositories
 *
 * @category Product_Category
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class ProductCategoryService
{
    /**
     * Create variable productCategoryRepository
     *
     * @var $productCategoryRepository
     */
    protected $productCategoryRepository;

    /**
     * ProductCategoryService constructor
     *
     * @param ProductCategoryRepository $productCategoryRepository callback object
     */
    public function __construct(
        ProductCategoryRepository $productCategoryRepository
    ) {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    /**
     * Get product's category list
     *
     * @return array categories
     */
    public function getProductCategoryList()
    {
        return $this->productCategoryRepository->getProductCategoryTree();
    }


    /**
     * Get product's category all list
     *
     * @return array categories
     */
    public function getList($parent_id)
    {
        return $this->productCategoryRepository->getList($parent_id);
    }

    /**
     * Get menu categories hierarchy
     *
     * @return array menu hierarchy
     */
    public function getHierarchyMenu()
    {
        return $this->productCategoryRepository->getHierarchy();
    }

    /**
     * Get menu categories active hierarchy
     *
     * @return \Illuminate\Http\Response menu hierarchy
     */
    public function getActiveHierarchyMenu()
    {
        return $this->productCategoryRepository->getActiveHierarchy();
    }

    /**
     * Store product category service
     *
     * @param \Illuminate\Http\Request $request - send information product category
     *
     * @return \Illuminate\Http\Response save product category information
     */
    public function storeProductCategory($request)
    {
        DB::beginTransaction();
        try {
            $this->productCategoryRepository->storeProductCategoryInformation($request);
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
     * Update product category service
     *
     * @param \Illuminate\Http\Request    $request         - send information product category
     * @param \App\Models\ProductCategory $productCategory - category id edit
     * 
     * @return \Illuminate\Http\Response save product category information
     */
    public function updateProductCategory($request, $productCategory)
    {
        DB::beginTransaction();
        try {
            $this->productCategoryRepository->updateProductCategoryInformation($request, $productCategory);
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
    public function deleteProductCategory($category)
    {
        DB::beginTransaction();
        try {
            $this->productCategoryRepository->deleteProductCategoryInformation($category);
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
     * Get information product category service
     *
     * @param \App\Models\ProductCategory $productCategory - category detail
     * 
     * @return \Illuminate\Http\Response $category
     */
    public function getInformationCategory($productCategory)
    {
        return $this->productCategoryRepository->getInformationCategory($productCategory);
    }

    /**
     * Get information product category service
     *
     * @param \Illuminate\Http\Request $request - send information product category
     * 
     * @return \Illuminate\Http\Response
     */
    public function sortable($request)
    {
        return $this->productCategoryRepository->sortable($request);
    }

    /**
     * Get product's category list to composer for header frontend
     *
     * @return array categories
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->getProductCategoryList());
    }

    public function getProductCategoryBySlug($slug)
    {
        return $this->productCategoryRepository->getProductCategoryBySlug($slug);
    }

    public function getListCategoryTop()
    {
        return $this->productCategoryRepository->getListCategoryTop();
    }
}
