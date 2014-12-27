<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/26/2014
 * Time: 11:05 AM
 */

class GroupPagePost extends Eloquent{

    protected $table = 'grouppagepost';
    protected $guarded = array('grouppagepostID');

    public function owner() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }
} 