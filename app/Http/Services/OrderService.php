<?php

/**
 * Order Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Order
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\OrdersRepository;

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

class OrderService
{
    /**
     * Create variable Page
     *
     * @var $pageRepository
     */
    protected $ordersRepository;

    /**
     * PageService constructor
     *
     * @param PageRepository $pageRepository callback object
     */
    public function __construct(
        OrdersRepository $ordersRepository
    ) {
        $this->ordersRepository = $ordersRepository;
    }

    /**
     * Get orders list
     * 
     * @return array
     */
    public function getList($pagination, $search, $start_date, $end_date, $customer, $status)
    {
        return $this->ordersRepository->list($pagination, $search, $start_date, $end_date, $customer, $status);
    }

    /**
     * Get order
     * 
     * @return array
     */
    public function get($order)
    {
        return $this->ordersRepository->getOrder($order);
    }


    /**
     * Get list review
     * 
     * @return array
     */
    public function getListReview($limit)
    {
        return $this->ordersRepository->getListReview($limit);
    }

    /**
     * Get list top product best seller
     * 
     * @return array
     */
    public function getListProductBestSeller($limit)
    {
        return $this->ordersRepository->getListProductBestSeller($limit);
    }


    /**
     * update order
     * 
     * @return array
     */
    public function updateOrder($request,$order)
    {
        DB::beginTransaction();
        try {
            $this->ordersRepository->update($request,$order);
            $result = [
                'message' => __('messages.save_success'),
                'status'  => Response::HTTP_OK
            ];
            DB::commit();
        } catch (Throwable $e) {
            // dd($e);
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

}
