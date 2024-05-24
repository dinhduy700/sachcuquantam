<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Services\UserService;

use App\Http\Requests\Backend\UserCreateRequest;

use App\Http\Requests\Backend\UserUpdateRequest;

use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Create variable newsService
     * 
     * @var $newsService
     */
    protected $userService;

    /**
     * __construct
     *
     * @param TagsService $newsService - callback object
     */
    public function __construct(
      UserService $userService
    ) {
        $this->userService = $userService;
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
        $users = $this->userService->getUserList($pagination, $search, $status);
        return view('backend.user.index', compact('users'));
    }

    /**
     * Get view create news in admin management
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.user.create');
    }

    /**
     * Store news in admin management
     * 
     * @param Request $request - call request send to function
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $response = $this->userService->storeUser($request);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.users.index')->with('success', $response['message']) :
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
    public function edit(Request $request, $user)
    {
        $user = $this->userService->getInformationUser($user);
        return view('backend.user.edit', compact('user'));
    }

    /**
     * Update information news
     * 
     * @param Request          $request - call request send to function
     * @param \App\Models\News $news    - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $user)
    {
        $response = $this->userService->updateUser($request, $user);
        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('admin.users.edit', $user)->with('success', $response['message']) :
            redirect()->back()->withInput($request->all())->with('error', $response['message']);
    }

    /**
     * Delete information news
     * 
     * @param \App\Models\News $news - news detail
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($user)
    {
        $response = $this->userService->deleteUser($user);
        return redirect()->back()->with($response['status'] === Response::HTTP_OK ? 'success' : 'error', $response['message']);
    }
}
