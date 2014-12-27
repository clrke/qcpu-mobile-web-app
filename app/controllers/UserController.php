<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/9/2014
 * Time: 10:50 AM
 */

class UserController extends BaseController {

    public function online() {
        $online = User::where('StudentID', '!=', Auth::user()->StudentID)->where('online', '1')->get();
        return View::make('layouts.onlineUsers', compact('online'));
    }
    public function notification() {
        $notifications   = PostNotification::with('posts', 'doer')->where('OwnerID', Auth::user()->StudentID)->orderBy('created_at', 'DESC')->get();
        $lastID = PostNotification::where('OwnerID', Auth::user()->StudentID)->orderBy('created_at', 'DESC')->first();
        return View::make('layouts.notification', compact('notifications', 'lastID'));
    }

    public function profile($id) {
        $user = User::getUser($id);
        $posts = Post::with('owner')->where('StudentID', $id)->orderBy('created_at', 'Desc')->get();
        return View::make('validated.profile.view', compact('user', 'posts'));
    }
} 