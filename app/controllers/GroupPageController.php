<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/26/2014
 * Time: 1:59 PM
 */

class GroupPageController extends BaseController{

    public function view($id) {
        $groupPages = GroupPageMember::with('groupPages')->where('grouppageID', $id)->first();
        $groupPosts = GroupPagePost::with('owner')->where('grouppageID', $id)->orderBy('created_at', 'DESC')->get();
        $members = GroupPageMember::with('owner')->where('grouppageID', $id)->get();
        return View::make('validated.grouppage.view', compact('groupPages', 'groupPosts', 'members'));
    }

    public function postMessage($id) {
        $in = Input::all();
        GroupPagePost::create([
           'grouppageID' => $id,
            'StudentID' => Auth::user()->StudentID,
            'Message' => $in['txtPostGroupStatusMessage']
        ]);
    }
} 