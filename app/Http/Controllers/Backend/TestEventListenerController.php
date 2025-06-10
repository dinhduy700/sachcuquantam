<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Events\NewUserRegistered;

class TestEventListenerController extends Controller
{
   
    public function testEventListener(Request $request)
    {
        $user = DB::table('users')->insert([
            'name'      => 'duydev01',
            'password'  => '123123',
            'type'      => 0,
            'is_active' => 1,
        ]);

        event(new NewUserRegistered($user));

        return $user;
    }

   
}
