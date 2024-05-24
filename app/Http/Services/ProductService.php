<?php

/**
 * Product Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Support\Facades\Log;

/**
 * Product Service call query in repositories
 *
 * @category Product
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class ProductService
{
    /**
     * Create variable product
     *
     * @var $productRepository
     */
    protected $productRepository;

    /**
     * ProductService constructor
     *
     * @param productRepository $productRepository callback object
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * Get product list
     *
     * @param int $pagination - pagination number
     * 
     * @return array
     */
    public function getProductList($pagination,$search, $category, $brand)
    {
        return $this->productRepository->list($pagination,$search, $category, $brand);
    }

    /**
     * Store product service
     *
     * @param \Illuminate\Http\Request $request - send information product
     *
     * @return \Illuminate\Http\Response
     */
    public function storeProduct($request)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->store($request);
            $result = [
                'id' => $product->id,
                'active' => $product->is_active,
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
     * Update product service
     *
     * @param \Illuminate\Http\Request $request - send information product
     * @param \App\Models\Broduct       $product  - product edit
     * 
     * @return \Illuminate\Http\Response save product information
     */
    public function updateProduct($request, $product)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->update($request, $product);
            $result = [
                'message' => __('messages.save_success'),
                'status'  => Response::HTTP_OK
            ];
            DB::commit();
        } catch (Throwable $e) {
            //dd($e);
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
     * Delete product  service
     *
     * @param \App\Models\Product $product - category detail delete
     * 
     * @return Response delete product information
     */
    public function deleteProduct($product)
    {
        DB::beginTransaction();
        try {
            $this->productRepository->delete($product);
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
        }
        DB::rollback();
        return $result;
    }

    /**
     * Get information product service
     *
     * @param \App\Models\Broduct $product - product detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getInformationProduct($product)
    {
        return $this->productRepository->getInformationProduct($product);
    }

    /**
     * Get list product by $type
     * $type == 1 : latest products , $type == 2 : promotional products, $type == 3 : featured products
     * $type == 4 : selling products
     *
     * @param \App\Models\Broduct $product - product detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function getProductListPage($paginate = 1, $type = 0, $rq = null, $category = null)
    {
        return $this->productRepository->getProductListPage($paginate, $type, $rq, $category);
    }

    public function getProductBySLug($slug)
    {
        return $this->productRepository->getProductBySLug($slug);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }
}
