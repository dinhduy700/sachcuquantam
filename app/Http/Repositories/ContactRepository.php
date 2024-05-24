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

use App\Models\Contact;

class ContactRepository {
    public function add($request) {
        $data = [
            'name' => $request->name ?? '',
            'phone' => $request->phone ?? '',
            'email' => $request->email ?? '',
            'content' => $request->content ?? ''
        ];

        $contact = Contact::create($data);

        return $contact;
    }

    /**
     * Query get list banner
     * 
     * @param int $pagination - items quantity
     *
     * @return \Illuminate\Http\Response
     */
    public function list($pagination, $search, $status, $sortBy)
    {   
        $contacts = new Contact();
        if (!empty($search)) {
            $contacts = $contacts->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%')->orWhere('phone', 'like', '%'.$search.'%');
        }
        if ($status != null) {
            $contacts = $contacts->where('status', $status);
        }
        if ($sortBy !== null) {
            $conditionSort = 'DESC';
            $column = 'created_at';
            if ($sortBy % 2 != 1) {
                $conditionSort = 'ASC';
            }
            if ($sortBy == 0 || $sortBy == 1) {
                $column = 'name';
            }
            $contacts = $contacts->orderBy($column, $conditionSort);
        } else {
            $contacts = $contacts->orderBy('id', 'DESC');
        }
        if (!empty($pagination)) {
            $contacts = $contacts->paginate(is_numeric($pagination) ? $pagination : config('constants.pagination'));
        } else {
            $contacts = $contacts->get();
        }
        return $contacts;
    }

    /**
     * Delete information product category
     * 
     * @param $banner - banner delete
     * 
     * @return \Illuminate\Http\Response 
     */
    public function delete($contact)
    {
        Contact::find($contact)->delete();
    }

    /**
     * Update information banner
     * 
     * @param Request            $request - send information banner
     * @param \App\Models\Banner $banner  - banner
     * 
     * @return \Illuminate\Http\Response 
     */
    public function update($request, $contact)
    {
        $data = [
            'status' => $request->status ?? 0,
        ];
        Contact::where('id', $contact)->update($data);
    }

    public function getInformationContact($contact)
    {
        return Contact::findOrFail($contact);
    }
}