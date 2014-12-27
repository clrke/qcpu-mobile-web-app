<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/5/2014
 * Time: 12:03 PM
 */

class Gender extends Eloquent {
    protected $table = 'gender';
    protected $guarded = array('GenderID');

    public function owner() {
        return $this->hasMany('User', 'GenderID', 'GenderID');
    }
} 