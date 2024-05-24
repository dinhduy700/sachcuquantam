<?php

/**
 * Page Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Partners;

use Illuminate\Support\Str;

/**
 * Page Repositories handle query for module Product
 *
 * @category Page
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class PartnerRepository
{
    /**
     * Query get list page
     *
     * @return \Illuminate\Http\Response
     */
    public function getList($isActive)
    {
    	if($isActive == null)
        	return Partners::get();
        if($isActive != null)
        {
        	return Partners::where('is_active', $isActive)->get();
        }
    }
}