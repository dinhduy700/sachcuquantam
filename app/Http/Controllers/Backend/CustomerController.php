<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\CustomerService;

use App\Http\Requests\Backend\CustomerCreateRequest;

use App\Http\Requests\Backend\CustomerUpdateRequest;

use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Create variable newsService
     * 
     * @var $newsService
     */
    protected $customerService;

    /**
     * __construct
     *
     * @param TagsService $newsService - callback object
     */
    public function __construct(
      CustomerService $customerService
    ) {
        $this->customerService = $customerService;
    }

    /**
     * Get view index news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = $request->get('items') ?? config('constants.pagination');
        $search = $request->get('search');
        $status = $request->get('status');
        $customers = $this->customerService->getCustomerList($pagination, $search, $status);
        return view('backend.customer.index', compact('customers'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.customer.create');
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerCreateRequest $request)
    {
        $response = $this->customerService->storeCustomer($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.customers.index')->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Get view edit news in admin management
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $customer)
    {
        $customer = $this->customerService->getInformationCustomer($customer);
        return view('backend.customer.edit', compact('customer'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, $customer)
    {
        $response = $this->customerService->updateCustomer($request, $customer);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.customers.edit', $customer)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($customer)
    {
        $response = $this->customerService->deleteCustomer($customer);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
