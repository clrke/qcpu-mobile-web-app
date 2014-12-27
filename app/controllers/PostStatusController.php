<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/10/2014
 * Time: 10:00 AM
 */

class PostStatusController extends BaseController {

    public function getPostStatus() {
        return View::make('validated.newsfeed.postStatus');
    }

    public function postStatus() {
        $files = Input::file('files');
        $in = Input::all();

        $post = Post::create([
            'StudentID' => Auth::user()->StudentID,
            'Message' => $in['message']
        ])->id;

        foreach($files as $file) {
            $rules = array(
                'file' => 'required|mimes:png,jpeg'
            );

            $validator = \Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $id = Str::random(14);

                $destinationPath = 'uploads/status/'. Auth::user()->StudentID.'/';
                $filename = $id. $file->getClientOriginalName();
                $mime_type = $file->getMimeType();
                $extension = $file->getClientOriginalExtension();
                $upload_success = $file->move('public/'.$destinationPath, $filename);
                if($upload_success) {
                    PostImage::create([
                        'StudentID' => Auth::user()->StudentID,
                        'post_id' => $post,
                        'image' => $destinationPath . $filename
                    ]);
                }
            }
        }
    }

    public function postStar($id) {
        $StudentID = Auth::user()->StudentID;
        $owner = Post::find($id);
        $checkStar = Star::where('id', $id)->where('StudentID', $StudentID)->first();
        if(count($checkStar) > 0) {
            $checkStar->delete();
        } else {
            Star::create([
                'id'=> $id,
                'StudentID'=>$StudentID,
                'starstar'=>'1'
            ]);
            PostNotification::create([
                'StudentID'=>$StudentID,
                'OwnerID' =>$owner->StudentID,
                'post_id' =>$id,
                'event' =>'Star'
            ]);
        }
    }

    public function getPostComments($id) {
        $post = Post::with('owner', 'photos')->find($id);
        $comments = PostComment::with('owner')->where('id', $id)->orderBy('created_at', 'DESC')->get();
        return View::make('validated.newsfeed.viewPostComments', compact('post', 'comments'));
    }

    public function postComments($id) {
        $owner = Post::find($id);
        $in = Input::all();
        PostComment::create([
            'id' => $id,
            'StudentID' => Auth::user()->StudentID,
            'commentboxes' => $in['message']
        ]);
        PostNotification::create([
            'StudentID'=>Auth::user()->StudentID,
            'OwnerID' =>$owner->StudentID,
            'post_id' =>$id,
            'event' =>'Comment'
        ]);
    }

    public function edit($id) {
        $post = Post::find($id);
        if(Auth::user()->StudentID == $post->StudentID) {
            return View::make('validated.newsfeed.editPost', compact('post'));
        }
    }

    public function save($id) {
        $in = Input::all();
        $post = Post::find($id);
        if(Auth::user()->StudentID == $post->StudentID) {
            $post->message = $in['message'];
            $post->edited = 1;
            $post->updated_at = date_timestamp_get(date_create());
            $post->save();
        }
    }

    public function remove($id) {
        $post = Post::find($id);
        (Auth::user()->StudentID == $post->StudentID) ? $post->delFlag = '1' : '';
        $post->save();
    }

} 