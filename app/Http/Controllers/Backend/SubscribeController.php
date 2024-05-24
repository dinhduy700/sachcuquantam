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

use App\Http\Services\SubscribeService;

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
class SubscribeController extends Controller
{
    /**
     * Create variable subscribeService
     * 
     * @var $subscribeService
     */
    protected $subscribeService;

    /**
     * __construct
     *
     * @param SubscribeService $subscribeService - callback object
     */
    public function __construct(
        SubscribeService $subscribeService
    ) {
        $this->subscribeService = $subscribeService;
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
        $subscribes = $this->subscribeService->getSubscribeList($pagination, $search, $status, $sortBy);
        return view('backend.subscribe.index', compact('subscribes'));
    }

    /**
     * Handle save information setting in site
     *
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subscribe)
    {
        $response = $this->subscribeService->updateSubscribe($request, $subscribe);
        return $response;
    }

    /**
     * Handle save information setting in site
     *
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function unsubscribe(Request $request)
    {
        $subscribe = $request->get('email');
        $response = $this->subscribeService->updateSubscribeEmail($request, $subscribe);
        return redirect()->route('home')->with('success', __('messages.unsubscribe'));
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $subscribe)
    {
        $response = $this->subscribeService->deleteSubscribe($subscribe);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
