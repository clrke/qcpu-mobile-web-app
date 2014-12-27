<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/5/2014
 * Time: 11:41 AM
 */

class Post extends Eloquent {
    protected $table = 'post';
    protected $guarded = array('id');

    public function owner() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }
    public function stars() {
        return $this->hasMany('Star', 'id');
    }
    public function comments() {
        return $this->hasMany('PostComment', 'id');
    }

    public function photos(){
        return $this->hasMany('PostImage');
    }
    public function notification(){
        return $this->belongsTo('PostNotification');
    }

    public function favorites(){
        return $this->hasMany('Favorite', 'StudentID', 'StudentID');
    }

} 