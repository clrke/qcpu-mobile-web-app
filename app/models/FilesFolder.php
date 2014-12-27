<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/24/2014
 * Time: 5:29 PM
 */

class FilesFolder extends Eloquent{

    protected $table = 'files_folder';
    protected $guarded = array('id');

    public function owner() {
        return $this->belongsTo('User', 'OwnerID', 'StudentID');
    }

} 