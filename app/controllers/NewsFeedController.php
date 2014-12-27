<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/8/2014
 * Time: 11:52 PM
 */

class NewsFeedController extends BaseController{

    public function newsFeed() {
        $posts = Post::with('owner', 'stars', 'comments', 'photos')->where('delFlag', 0)->orderBy('created_at', 'DESC')->paginate(10);
        $lastPost = Post::orderBy('created_at', 'DESC')->first();
        return View::make('validated.newsfeed', compact('posts', 'lastPost'));
    }

    public function getPage($id) {
        $posts = Post::with('owner', 'stars')->paginate(10);
        return View::make('validated.newsfeed.viewPage', compact('posts'));
    }

    public function newPosts($id) {
        $posts = Post::with('owner', 'stars', 'photos')->where('id', '>', $id)->where('delFlag', 0)->get();
        $lastPost = Post::orderBy('created_at', 'DESC')->first();
        return View::make('validated.newsfeed.newPosts', compact('posts', 'lastPost'));
    }
}