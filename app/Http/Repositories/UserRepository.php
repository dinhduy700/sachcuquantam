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

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

/**
 * Banner Repositories handle query for module Product
 *
 * @category Banner
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

class UserRepository
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
        $users = User::where('type', 0)->orderBy('id', 'ASC');
        if (!empty($search)) {
            $users = $users->where(
                function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like',  '%'.$search.'%')->orWhere('username', 'like',  '%'.$search.'%');
                }
            );
        }
        if ($status != null) {
            $users = $users->where('is_active', $status);
        }

        if (!empty($pagination)) {
            $users = $users->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $users = $users->get();
        }
        return $users;
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
            'type' => 0,
            'password' => Hash::make($request->password ?? 123456),
            'is_active' => $request->is_active ?? 0,
        ];

        User::create($data);
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $user)
    {
        $data = [
            'name' => $request->name ?? null,
            'email' => $request->email ?? null,
            'username' => $request->username ?? null,
            'phone' => $request->phone ?? null,
            'type' => 0,
        ];

        if (Auth::user()->id != $user) {
            $data['is_active'] = $request->is_active ?? 0;
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password ?? 123456);
        }

        User::where('id', $user)->update($data);
    }

    public function getInformationUser($user)
    {
        return User::findOrFail($user);
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($user)
    {
        User::find($user)->delete();
    }
}
