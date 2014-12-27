<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/16/2014
 * Time: 4:51 PM
 */

class Favorite extends Eloquent{

    protected $table = 'favorites';
    protected $guarded = array('ID');

    public function users() {
        return $this->belongsTo('User', 'FavoriteID', 'StudentID');
    }

    public function Posts() {
        return $this->belongsTo('Post', 'StudentID', 'StudentID');
    }

    public static function user($id) {
        $fav = Favorite::where('StudentID', Auth::user()->StudentID)->where('FavoriteID', $id)->where('favorite', 1)->first();
        return (count($fav)) ? true :  false;
    }
} 