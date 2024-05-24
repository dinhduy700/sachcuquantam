<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Http\Response;

use App\Http\Services\BannerService;
use App\Http\Services\CustomerService;

class AuthController extends Controller {

    protected $bannerService;
    protected $customerService;

    public function __construct(
        BannerService $bannerService,
        CustomerService $customerService
    ) {
        $this->bannerService = $bannerService;
        $this->customerService = $customerService;
        $this->middleware('guest:customer', ['except' => ['logout', 'login']]);
    }

    public function index() {
        $banners = $this->bannerService->getBannerListIndex(0);

        return view('frontend.login', ['banners' => $banners]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
        $username = $request->email;
        $password = $request->password;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $username, 'password' => $password, 'type' => 1];
        } else {
            $credentials = ['username' => $username, 'password' => $password, 'type' => 1];
        }

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->route('home');
        }

        return back()->with('error', __('messages.user_incorrect'))->withInput($request->input());
    }

    public function forgetPassword(Request $request) {
        $request->validate(['email' => 'required|email']);
        $credentials = ['email' => $request->email, 'type' => 1];

        $status = Password::sendResetLink($credentials);

        if ($status !== Password::RESET_LINK_SENT) {
            return back()->with('error', __('messages.email_reset_incorrect'))->withInput($request->input());
        }

        return redirect()->route('login.get')->with('success', __('messages.send_mail_success'));
    }

    public function getResetPassword($token = null) {
        $banners = $this->bannerService->getBannerListIndex(0);

        return view('frontend.reset', [
            'banners' => $banners,
            'token' => $token,
            'email' => request('email')
        ]);
    }

    public function postResetPassword(Request $request) {
        $this->validate(request(), [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()->with('error', __('messages.email_reset_incorrect'))->withInput($request->input());
        }

        return redirect()->route('login.get')->with('success', __('messages.change_password_success'));
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect()->route('login.get');
    }

    public function getRegisterAccount() {
        $banners = $this->bannerService->getBannerListIndex(0);

        return view('frontend.register', ['banners' => $banners]);
    }

    public function postRegisterAccount(Request $request) {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required'
        ]);

        $response = $this->customerService->storeCustomer($request);

        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('login.get')->with('success', __('messages.register_success')) :
            redirect()->back()->withInput($request->all())->with('error',  __('messages.cannot_create_account'));
    }
}
