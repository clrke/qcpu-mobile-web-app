<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/26/2014
 * Time: 11:04 AM
 */

class GroupPageMember extends Eloquent {

    protected $table = 'grouppagemember';
    protected $guarded = array('grouppagememberID');

    public function owner() {
        return $this->belongsTo('User', 'StudentID', 'StudentID');
    }

    public function groupPages() {
        return $this->belongsTo('GroupPage', 'grouppageID', 'grouppageID');
    }

} 