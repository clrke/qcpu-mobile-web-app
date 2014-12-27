<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/18/2014
 * Time: 8:49 PM
 */

class SearchController extends BaseController{

    public function index() {
        $user = User::all();
        return View::make('validated.search.index', compact('user'));
    }
    public function search() {
        $in = Input::all();
        $name = $in['name'];
        if(strlen($name) < 1)
            return '';

        $users = User::where('StudentID','!=', Auth::user()->StudentID)->where(function($q) use($name){
            $q->where('StudentID', 'LIKE', '%'.$name.'%')->orWhere('Lastname', 'LIKE', '%'.$name.'%')->orWhere('Firstname', 'LIKE', '%'.$name.'%')->get();
        })->get();
        return View::make('validated.search.view', compact('users'));
    }
}