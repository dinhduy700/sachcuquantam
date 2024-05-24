<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\PageService;

// use App\Http\Requests\Backend\PageUpdateRequest;

use Illuminate\Http\Response;

class PageController extends Controller
{
    /**
     * Create variable pageService
     * 
     * @var $pageService
     */
    protected $pageService;

    /**
     * __construct
     *
     * @param PageService $pageService - callback object
     */
    public function __construct(
        PageService $pageService
    ) {
        $this->pageService = $pageService;
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
        $pages = $this->pageService->getPageList();
        return view('backend.page.index', compact('pages'));
    }

    /**
     * Get view edit news in admin management
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $page)
    {
        $page = $this->pageService->getInformationPage($page);
        return view('backend.page.edit', compact('page'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\Page $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $page)
    {
        $response = $this->pageService->updatePage($request, $page);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.pages.edit', $page)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }
}
