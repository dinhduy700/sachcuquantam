<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\Backend\AdminLoginRequest;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web', ['except' => ['logout', 'login', 'switchLocale', 'loadNotifications', 'deleteNotifications', 'detailNotifications']]);
    }

    /**
     * Get View Login Admin
     * 
     * @return view
     */
    public function getLogin()
    {
        return view('backend.auth.login');
    }

    /**
     * Login admin 
     * 
     * @param AdminLoginRequest $request - send request information login
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(AdminLoginRequest $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $username, 'password' => $password];
        } else {
            $credentials = ['username' => $username, 'password' => $password];
        }
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard.index'));
        }
        return back()->with('error', __('messages.user_incorrect'))->withInput($request->input());
    }

    /**
     * Logout admin 
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.get');
    }

    /**
     * Handle set locale admin 
     * 
     * @param Request $request - send request information
     * 
     * @return \Illuminate\Http\Response
     */
    public function switchLocale(Request $request)
    {
        Session::put('locale', $request->locale);
        return redirect()->back();
    }

    public function loadNotifications(Request $request)
    {
        $notifications = Auth::user()->notifications()->take($request->paginate * 8)->get();
        return $notifications;
    }

    public function deleteNotifications()
    {
        Auth::user()->notifications()->delete();
    }

    public function detailNotifications(Request $request)
    {
        $url = '';
        $notifications = Auth::user()->notifications()->where('id', $request->notify)->orwhereJsonContains('data->id', (int)$request->notify)->first();
        if ($notifications) {
            $notifications->markAsRead();
            if (isset($notifications['data']['type']) && isset($notifications['data']['id'])) {
                $url = $notifications['data']['type'] == 0 ?
                    route('admin.contacts.edit', ['contact' => $notifications['data']['id']]) :
                    route('admin.orders.edit', ['edit' => $notifications['data']['id']]);
            }
        }
        return $url;
    }
}
