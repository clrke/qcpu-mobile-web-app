<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/8/2014
 * Time: 6:32 PM
 */

class GroupChatMessage extends Eloquent {
    protected $table = 'groupchatmessage';
    protected $guarded = array('ID');

    public function owner() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }

} 