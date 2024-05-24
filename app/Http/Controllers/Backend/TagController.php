<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\TagService;

use App\Http\Requests\Backend\TagCreateRequest;

use App\Http\Requests\Backend\TagUpdateRequest;

use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Create variable newsService
     * 
     * @var $newsService
     */
    protected $tagService;

    /**
     * __construct
     *
     * @param TagsService $newsService - callback object
     */
    public function __construct(
        TagService $tagService
    ) {
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
        $tags = $this->tagService->getTagsList($pagination, $search, $status, $sortBy);
        return view('backend.tags.index', compact('tags'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tags.create');
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        $response = $this->tagService->storeTag($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.tags.index')->with('success', $response['message']) :
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
    public function edit(Request $request, $tag)
    {
        $tag = $this->tagService->getInformationTag($tag);
        return view('backend.tags.edit', compact('tag'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $tag)
    {
        $response = $this->tagService->updateTag($request, $tag);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.tags.edit', $tag)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($tag)
    {
        $response = $this->tagService->deleteTag($tag);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
