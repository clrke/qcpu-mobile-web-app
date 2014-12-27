<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/19/2014
 * Time: 10:01 PM
 */

class PostImage extends Eloquent {

    protected $table = 'postimage';
    protected $guarded = array('id');

    public function post() {
        $this->belongsTo('Post', 'post_id', 'id');
    }
    public function owner(){
        $this->belongsTo('User', 'StudentID', 'StudentID');
    }
} 