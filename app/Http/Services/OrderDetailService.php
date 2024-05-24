<?php

/**
 * Order detail Service Application
 * PHP version ^7.3|^8.0
 *
 * @category Order detail
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Services;

use App\Http\Repositories\OrderDetailRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Order Detail call query in repositories
 *
 * @category Order Detail
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class OrderDetailService
{
    /**
     * Create variable Page
     *
     * @var $pageRepository
     */
    protected $orderDetailRepository;

    /**
     * Order Detail constructor
     *
     * @param OrderDetailRepository $pageRepository callback object
     */
    public function __construct(
        OrderDetailRepository $orderDetailRepository
    ) {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * Get list order detail
     * 
     * @return array
     */
    public function getList()
    {
        return $this->orderDetailRepository->list();
    }

    /**
        * Get list order detail by order id
     * 
     * @return array
     */
    public function get($order)
    {
        return $this->orderDetailRepository->get($order);
    }
    
}
