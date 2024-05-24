<?php

/**
 * Contact Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Contact
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Subscribe;

class SubscribeRepository 
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function listSubscribe($pagination, $search, $status, $sortBy)
    {   
        $subscribes = new Subscribe();
        if (!empty($search)) {
            $subscribes = $subscribes->where('email', 'like', '%'.$search.'%');
        }
        if ($status != null) {
            $subscribes = $subscribes->where('is_active', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            $column = 'id';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $column = 'email';
            }
            $subscribes = $subscribes->orderBy($column, $conditionSort);
        } else {
            $subscribes = $subscribes->orderBy('id', 'DESC');
        }
        if (!empty($pagination)) {
            $subscribes = $subscribes->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $subscribes = $subscribes->get();
        }
        return $subscribes;
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function deleteSubscribe($subscribe)
    {
        Subscribe::find($subscribe)->delete();
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function updateSubscribe($request, $subscribe)
    {
        $data = [
            'is_active' => $request->is_active ?? 0,
        ];
        Subscribe::where('id', $subscribe)->update($data);
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function updateSubscribeEmail($request, $subscribe)
    {
        $data = [
            'is_active' => 0,
        ];
        Subscribe::where('email', $subscribe)->update($data);
    }
}