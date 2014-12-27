<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/24/2014
 * Time: 4:35 PM
 */

class UserType extends Eloquent {


    protected $table = 'user_type';
    protected $guarded = array('id');


    public function users() {
        return $this->hasMany('User');
    }
} 