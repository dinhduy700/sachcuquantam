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

use App\Http\Repositories\PartnerRepository;

use Illuminate\Support\Facades\DB;

use Throwable;

use Illuminate\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Page Service call query in repositories
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class PartnerService
{
    /**
     * Create variable Page
     *
     * @var $partnerRepository
     */
    protected $partnerRepository;

    /**
     * PageService constructor
     *
     * @param PartnerRepository $partnerRepository callback object
     */
    public function __construct(
        PartnerRepository $partnerRepository
    ) {
        $this->partnerRepository = $partnerRepository;
    }

    /**
     * Get partner list
     * 
     * @return array
     */
    public function list($isActive = null)
    {
        return $this->partnerRepository->getList($isActive);
    }
}
