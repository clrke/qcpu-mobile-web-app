<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/20/2014
 * Time: 8:46 PM
 */

class FavoriteController extends BaseController{

    public function add($id){
        $user = User::where('StudentID', $id)->first();
        if(Auth::user()->StudentID != $id) {
            $fav = Favorite::where('StudentID', Auth::user()->StudentID)->where('FavoriteID', $id)->where('favorite', 0)->first();
            if(count($fav)) {
                $fav->favorite = 1;
                $fav->updated_at = date_timestamp_get(date_create());
                $fav->save();
            } else {
                Favorite::create([
                    'StudentID' =>  Auth::user()->StudentID,
                    'FavoriteID' => $user->StudentID,
                    'favorite' => 1
                ]);
            }

        }
    }

    public function remove($id) {
        $fav = Favorite::where('StudentID', Auth::user()->StudentID)->where('FavoriteID', $id)->where('favorite', '1')->first();
        $fav->favorite = 0;
        $fav->updated_at = date_timestamp_get(date_create());
        $fav->save();
    }
} 