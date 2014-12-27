<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/3/2014
 * Time: 10:56 AM
 */

class AppController extends BaseController {

    public function index() {
        return View::make('layouts.default');
    }

    public function showRegister() {
        return View::make('register');
    }
    public function doRegister() {
        $in = Input::all();
        User::create([
           'StudentID' => $in['studentID'],
            'Password' => Hash::make($in['password']),
            'Lastname' =>'Last-name',
            'Firstname' =>'First-name',
            'GenderID' =>'1',
            'CourseID' =>'1',
            'online' =>'0',
            'Description' =>'okay',
            'photo' =>'aaron.jpg',
            'chatfavorite' =>'1'

        ]);
    }
    public function showLogin() {
        return View::make('login');
    }
    public function doLogin() {
        $in = Input::all();
        $user = array(
            'StudentID' => $in['StudentID'],
            'password' => $in['password']
        );
        $rules = array(
            'StudentID'  => 'Required|min:7|max:7',
            'password'  => 'Required|min:5|max:25',
        );

        $validator = Validator::make($user, $rules);
        if ($validator->passes()) {
            if (Auth::attempt($user)) {
                User::changeStatus(Auth::user()->StudentID, '1');
                return Redirect::to('/');
            }
            else
                return Redirect::back()->withErrors(array('password' => 'Invalid username or password'))->withInput(Input::except('password'));
        }
        return Redirect::back()->withErrors($validator)->withInput(Input::except('password'));
    }
    public function logout() {
        User::changeStatus(Auth::user()->StudentID, 0);
        Auth::logout();
        return Redirect::to('/');
    }

    public function favorites() {
        $favorites = Favorite::with('users')->where('StudentID', Auth::user()->StudentID)->where('favorite', 1)->get();
        return View::make('validated.favorites', compact('favorites'));
    }

    public function more() {
        $groupPages = GroupPageMember::with('groupPages')->where('StudentID', Auth::user()->StudentID)->get();
        //return $groupPages;
        return View::make('validated.more', compact('groupPages'));
    }

}