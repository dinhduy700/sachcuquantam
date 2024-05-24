<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\VideoService;

use App\Http\Requests\Backend\VideoCreateRequest;

use App\Http\Requests\Backend\VideoUpdateRequest;

use Illuminate\Http\Response;

class VideoController extends Controller
{
    /**
     * Create variable newsService
     * 
     * @var $newsService
     */
    protected $videoService;

    /**
     * __construct
     *
     * @param VideoService $newsService - callback object
     */
    public function __construct(
        VideoService $videoService
    ) {
        $this->videoService = $videoService;
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
        $videos = $this->videoService->getVideoList($pagination, $search, $status, $sortBy);
        return view('backend.video.index', compact('videos'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.video.create');
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(VideoCreateRequest $request)
    {
        $response = $this->videoService->storeVideo($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.videos.index')->with('success', $response['message']) :
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
    public function edit(Request $request, $video)
    {
        $video = $this->videoService->getInformationVideo($video);
        return view('backend.video.edit', compact('video'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(VideoUpdateRequest $request, $video)
    {
        $response = $this->videoService->updateVideo($request, $video);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.videos.edit', $video)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($video)
    {
        $response = $this->videoService->deleteVideo($video);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
