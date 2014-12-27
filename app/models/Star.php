<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/5/2014
 * Time: 1:39 PM
 */

class Star extends Eloquent {

    protected $table = 'star';
    protected $guarded = array('starid');

    public function post() {
        return $this->belongsToMany('Post', 'id');
    }
    public static function checkStar($stars) {
        foreach($stars as $star) {
            if($star->StudentID == Auth::user()->StudentID) {
                return true;
            }
            return false;
        }
    }
}