<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/8/2014
 * Time: 11:16 AM
 */

class Message extends Eloquent {

    protected $table = 'messaging';
    protected $guarded = array('id');

    public function owner() {
        return $this->belongsTo('User', 'RecipientID', 'StudentID');
    }
    public function sender() {
        return $this->belongsTo('User', 'SenderID', 'StudentID');
    }

} 