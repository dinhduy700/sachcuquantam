<?php

/**
 * Setting Controller Application
 * PHP version ^7.3|^8.0
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\ContactService;

use Illuminate\Http\Response;

/**
 * Setting controller handle query for module Setting
 *
 * @category Setting
 * @package  Oxpersoft_Ecommerce_CMS
 * @author   Oxpersoft <info@oxpersoft.com>
 * @license  https://www.oxpersoft.com/ Oxpersoft
 * @link     https://www.oxpersoft.com/
 */
class ContactController extends Controller
{
    /**
     * Create variable settingService
     * 
     * @var $settingService
     */
    protected $contactService;

    /**
     * __construct
     *
     * @param SettingService $settingService - callback object
     */
    public function __construct(
        ContactService $contactService
    ) {
        $this->contactService = $contactService;
    }

    /**
     * Get information setting in site
     * 
     * @return view data setting
     */
    public function index(Request $request)
    {
        $pagination = $request->get('items') ?? config('constants.pagination');
        $search = $request->get('search');
        $status = $request->get('status');
        $sortBy = $request->get('sortBy');
        $contacts = $this->contactService->getContactList($pagination, $search, $status, $sortBy);
        return view('backend.contact.index', compact('contacts'));
    }

    /**
     * Get view edit news in admin management
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $contact)
    {
        $contact = $this->contactService->getInformationContact($contact);
        return view('backend.contact.edit', compact('contact'));
    }

    /**
     * Handle save information setting in site
     *
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contact)
    {
        $response = $this->contactService->updateContact($request, $contact);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.contacts.edit', $contact)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($contact)
    {
        $response = $this->contactService->deleteContact($contact);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
