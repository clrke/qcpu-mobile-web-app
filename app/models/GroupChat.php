<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/8/2014
 * Time: 6:30 PM
 */

class GroupChat extends Eloquent {
    protected $table = 'groupchat';
    protected $guarded = array('ID');

    public function owner() {
        return $this->hasOne('User');
    }

    public function groupChatMembers() {
        return $this->hasMany('GroupChatMember');
    }
} 