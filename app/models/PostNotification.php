<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/20/2014
 * Time: 11:13 AM
 */

class PostNotification extends Eloquent {

    protected $table = 'postnotification';
    protected $guarded = array('id');

    public function posts() {
        return $this->belongsTo('Post', 'post_id', 'id');
    }

    public function doer() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }


}