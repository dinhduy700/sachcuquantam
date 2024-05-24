<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\NewsService;

use App\Http\Services\TagService;

use App\Http\Requests\Backend\NewsCreateRequest;

use App\Http\Requests\Backend\NewsUpdateRequest;

use Illuminate\Http\Response;

use App\Jobs\SendSubscribeEmail;

class NewsController extends Controller
{
    /**
     * Create variable newsService
     * 
     * @var $newsService
     */
    protected $newsService, $tagService;

    /**
     * __construct
     *
     * @param NewsService $newsService - callback object
     */
    public function __construct(
        NewsService $newsService,
        TagService $tagService
    ) {
        $this->newsService = $newsService;
        $this->tagService = $tagService;
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
        $sortBy = $request->get('sortBy');
        $listNews = $this->newsService->getNewsList($pagination, $search, $status, $sortBy);
        return view('backend.news.index', compact('listNews'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagService->getTagsList();
        return view('backend.news.create', compact('tags'));
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCreateRequest $request)
    {
        $response = $this->newsService->storeNews($request);
        if (!empty($response['id']) && !empty($response['active'])) {
            dispatch(new SendSubscribeEmail($response['id'], 0));
        }
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.news.index')->with('success', $response['message']) :
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
    public function edit(Request $request, $news)
    {
        $news = $this->newsService->getInformationNews($news);
        $tags = $this->tagService->getTagsList();
        return view('backend.news.edit', compact('news', 'tags'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(NewsUpdateRequest $request, $news)
    {
        $response = $this->newsService->updateNews($request, $news);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.news.edit', $news)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($news)
    {
        $response = $this->newsService->deleteNews($news);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
