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

use App\Http\Services\CommentService;

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
class CommentController extends Controller
{
    /**
     * Create variable commentService
     * 
     * @var $commentService
     */
    protected $commentService;

    /**
     * __construct
     *
     * @param CommentService $commentService - callback object
     */
    public function __construct(
        CommentService $commentService
    ) {
        $this->commentService = $commentService;
    }

    /**
     * Get information setting in site
     * 
     * @return view data setting
     */
    public function index(Request $request)
    {
        $pagination = $request->get('items') ?? config('constants.pagination');
        $filter = $request->get('filter');
        $search = $request->get('search');
        $status = $request->get('status');
        $sortBy = $request->get('sortBy');
        $comments = $this->commentService->getCommentList($pagination, $filter, $search, $status, $sortBy);
        return view('backend.comment.index', compact('comments'));
    }

    /**
     * Get view edit news in admin management
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $comment)
    {
        $filter = $request->get('filter');
        $comment = $this->commentService->getInformationComment($comment, $filter);
        return view('backend.comment.edit', compact('comment'));
    }

    /**
     * Handle save information setting in site
     *
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment)
    {
        $filter = $request->get('filter');
        $response = $this->commentService->updateComment($request, $comment, $filter);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.comments.edit', ['comment' => $comment, 'filter' => $filter ])->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $comment)
    {
        $filter = $request->get('filter');
        $response = $this->commentService->deleteComment($comment, $filter);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
