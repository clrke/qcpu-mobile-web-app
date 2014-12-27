<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/20/2014
 * Time: 10:13 PM
 */

class NotificationController extends BaseController {
    public function newNotifications($id) {
        $notifications   = PostNotification::with('posts', 'doer')->where('OwnerID', Auth::user()->StudentID)->where('id', '>', $id)->orderBy('created_at', 'DESC')->get();
        $lastID = PostNotification::where('OwnerID', Auth::user()->StudentID)->orderBy('created_at', 'DESC')->first();
        //return $notifications;
        return View::make('validated.notification.new', compact('notifications', 'lastID'));
    }
} 