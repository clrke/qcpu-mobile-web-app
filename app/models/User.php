<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
    protected $guarded = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    public function type() {
        return $this->belongsTo('UserType', 'user_type_id', 'id');
    }

    public function posts() {
        return $this->hasMany('Post', 'StudentID');
    }
    public function messages() {
        return $this->hasMany('Message', 'StudentID', 'RecipientID');
    }
    public function gender() {
        return $this->belongsTo('Gender', 'GenderID', 'GenderID');
    }
    public function course() {
        return $this->belongsTo('Course', 'CourseID', 'CourseID');
    }
    public function groupChat() {
        return $this->belongsTo('GroupChat');
    }
    public function groupChatMembers() {
        return $this->hasMany('GroupChatMembers');
    }
    public function groupChatMessage() {
        return $this->hasMany('GroupChatMessage');
    }
    public function filesFolder() {
        return $this->hasMany('FilesFolder');
    }
    public static function getStatus($id) {
        $user = User::find($id);
        return $user->online;
    }
    public static function getProfileImage($src) {
        return "http://localhost/qcpusociallearning/img/profile/".$src;
    }
    public static function changeStatus($id, $status) {
        $user = User::where('StudentID', $id)->first();
        $user->online = $status;
        $user->updated_at = date_timestamp_get(date_create());
        $user->save();

    }
    public static function getUser($id) {
        $user = User::where('StudentID', $id)->first();
        return $user;
    }

}
