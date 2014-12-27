<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/8/2014
 * Time: 11:12 AM
 */

class MessageController extends BaseController{

    public function index() {
        $messages = Message::with('sender')->where('DelFlag', 0)->where('RecipientID', Auth::user()->StudentID)->groupBy('RecipientID')->orderBy('created_at', 'DESC')->get();
        $myGroups = GroupChat::where('StudentID', Auth::user()->StudentID)->get();
        $groups = GroupChatMember::with('groupChat')->where('StudentID', Auth::user()->StudentID)->get();
        return View::make('validated.messages', compact('messages', 'myGroups', 'groups'));

    }

    public function view($id) {
        $messages = Message::with('sender')->where('DelFlag', 0)->where(function($q) use($id) {
            $q->where('RecipientID', Auth::user()->StudentID)->where('SenderID', $id)->orWhere('RecipientID', $id)->where('SenderID', Auth::user()->StudentID);
        })->orderBy('created_at', 'DESC')->get();
        return View::make('validated.message.personal.view', compact('messages', 'id'));
    }

    public function personalReply($id) {
        $in = Input::all();
        Message::create([
           'RecipientID' => $id,
            'SenderID' =>Auth::user()->StudentID,
            'Message' => $in['message']
        ]);
        return '';
    }
    public function personalDelete($id) {
        $message = Message::find($id);
        $message->DelFlag = 1;
        $message->save();
    }
    public function myGroupView($id) {
        $messages = GroupChatMessage::with('owner')->where('GCID', $id)->orderBy('created_at', 'DESC')->get();
        return View::make('validated.message.mygroup.view', compact('messages', 'id'));
    }

    public function groupView($id) {
        $messages = GroupChatMessage::with('owner')->where('GCID', $id)->orderBy('created_at', 'DESC')->get();
        return View::make('validated.message.group.view', compact('messages'));
    }
    public function myGroupCreate() {
        $in = Input::all();
        $result = GroupChat::create([
            'Name' => (strlen($in['name']) < 1) ? 'No name [' . date('m-d-Y') .'-' . time(). ']' : $in['name'],
            'StudentID' => Auth::user()->StudentID
        ])->id;

        GroupChatMessage::create([
            'GCID' => $result,
            'StudentID' =>Auth::user()->StudentID,
            'Message' => Auth::user()->Firstname . ' ' . Auth::user()->Lastname . ' created this group chat.'
        ]);
    }
    public function myGroupSearchPeople($id) {
        $in = Input::all();
        $name = $in['name'];
        if(strlen($name) < 1)
            return '';

        $users = User::where('StudentID','!=', Auth::user()->StudentID)->where(function($q) use($name){
            $q->where('StudentID', 'LIKE', '%'.$name.'%')->orWhere('Lastname', 'LIKE', '%'.$name.'%')->orWhere('Firstname', 'LIKE', '%'.$name.'%')->get();
        })->get();
        return View::make('validated.message.mygroup.search', compact('users', 'id'));
    }
    public function myGroupAddPeople($id, $StudentID) {
        $userToBeAdded = User::getUser($StudentID);
        if(!GroupChatMember::alreadyMember($id, $StudentID))
        GroupChatMember::create([
           'GCID'=>$id,
            'StudentID'=>$StudentID,
            'addedByID'=>Auth::user()->StudentID
        ]);
        GroupChatMessage::create([
            'GCID' => $id,
            'StudentID' =>Auth::user()->StudentID,
            'Message' => Auth::user()->Firstname . ' ' . Auth::user()->Lastname . ' added <a href="/profile/' . $userToBeAdded->StudentID . '">' . $userToBeAdded->Firstname . ' ' . $userToBeAdded->Lastname . '</a> to this group chat.'
        ]);
    }
} 