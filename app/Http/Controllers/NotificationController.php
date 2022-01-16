<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('main.notifications',[
            'notifications' => $user->notifications()->paginate()
        ]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        // dd($notification);

        $notification->markAsRead();

        if(isset($notification->data['url']) && $notification->data['url']){
            return redirect($notification->data['url']);
        }

        return redirect()->back();
    }
}
