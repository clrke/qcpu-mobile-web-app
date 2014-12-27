<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/26/2014
 * Time: 11:04 AM
 */

class GroupPage extends Eloquent{

    protected $table = 'grouppage';
    protected $guarded = array('grouppageID');

    public function groupPageMembers() {
        return $this->hasMany('GroupPageMember');
    }
} 