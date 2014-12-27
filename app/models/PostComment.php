<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/12/2014
 * Time: 12:17 PM
 */

class PostComment extends Eloquent{

    protected $table = 'commentbox';
    protected $guarded = array('commentboxid');

    public function post() {
        return $this->belongsTo('Post', 'id');
    }

    public function owner() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }
} 