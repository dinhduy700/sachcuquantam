<?php

/**
 * Banner Repositories Application
 * PHP version ^7.3|^8.0
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Repositories;

use App\Models\Customer;

use Illuminate\Support\Facades\Hash;

/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class CustomerRepository
{
    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $status)
    {   
        $customers = Customer::where('type', 1)->orderBy('id', 'ASC');
        if (!empty($search)) {
            $customers = $customers->where(
                function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like',  '%'.$search.'%')->orWhere('username', 'like',  '%'.$search.'%')->orWhere('phone', 'like',  '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $customers = $customers->where('is_active', $status);
        }

        if (!empty($pagination)) {
            $customers = $customers->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $customers = $customers->get();
        }
        return $customers;
    }

    /**
     * Save information product category
     *
     * @param Request $request - send information product category
     *
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        $data = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'username' => $request->username ?? null,
            'phone' => $request->phone ?? null,
            'type' => 1,
            'password' => Hash::make($request->password ?? 123456),
            'is_active' => $request->is_active ?? 0,
        ];

        Customer::create($data);
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $customer)
    {
        $data = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'username' => $request->username ?? null,
            'phone' => $request->phone ?? null,
            'type' => 1,
            'is_active' => $request->is_active ?? 0,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password ?? 123456);
        }

        Customer::where('id', $customer)->update($data);
    }

    public function getInformationCustomer($customer)
    {
        return Customer::findOrFail($customer);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($customer)
    {
        Customer::find($customer)->delete();
    }
}
