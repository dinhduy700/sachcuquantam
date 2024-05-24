<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mail;

use App\Http\Services\ContactService;
use App\Http\Services\BannerService;
use App\Http\Services\SettingService;

use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\NotificationManagement;
use Pusher\Pusher;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class ContactController  extends Controller
{
    protected $contactService;
    protected $settingService;

    public function __construct(
        ContactService $contactService,
        BannerService $bannerService,
        SettingService $settingService
    ) {
        $this->contactService = $contactService;
        $this->bannerService = $bannerService;
        $this->settingService = $settingService;
    }

    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $setting = $this->settingService->getSettingService();
        $banners = $this->bannerService->getBannerListIndex(0);

        return view('frontend.contact', ['banners' => $banners, 'setting' => $setting]);
    }

    public function sendContact(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'name' => 'required',
            'phone' => 'required',
            'content' => 'required'
        ]);

        $response = $this->contactService->addContact($request);

        $users = User::where(['type' => 0, 'is_active' => 1])->get();
        $notify = [
            'id' => $response['contact']['id'] ?? null,
            'title' => trans('app.contact.new'),
            'user' => $request->email,
            'type' => 0
        ];
        Notification::send($users, new NotificationManagement($notify));

        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'notify-channel', $notify);

        $isFinishSendMail = $this->isFinishSendMail($request);

        if (!$isFinishSendMail) {
            return redirect()->back()->withInput($request->all())->with('error', __('messages.cannot_send_email'));
        }

        return $response['status'] === Response::HTTP_OK ?
            redirect()->route('contact.index')->with('success', 'Mail has been sent!') :
            redirect()->back()->withInput($request->all())->with('error', __('messages.cannot_send_message'));
    }

    private function isFinishSendMail($contactInfo)
    {
        try {
            $setting = Setting::first();
            $email = filter_var($setting->email, FILTER_VALIDATE_EMAIL) ? $setting->email : env('MAIL_FROM_ADDRESS');

            $emailContent = 'Name: ' . $contactInfo->name . "\r\n" .
                'Email: ' . $contactInfo->email . "\r\n" .
                'Phone: ' . $contactInfo->phone . "\r\n" .
                'Message: ' . $contactInfo->content;
            $content = htmlspecialchars($emailContent);

            Mail::raw($content, function ($message) use ($email) {
                $message->to($email)->subject('Contact Mail');
            });

            return true;
        } catch (\Swift_TransportException $e) {
            Log::error('progress.sentMailError');
        }

        return false;
    }
}
