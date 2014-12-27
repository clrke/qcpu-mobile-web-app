

@if(count($post))
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="modal-header">
                <span id="btnClosePopUp" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></span>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-comments-o fa-fw"></i> {{$comments->count()}} {{($comments->count() > 1) ? "Comments" : "Comment"}}</h5>
            </div>
            <div class="modal-body">
                <div class="lismargin-top-sm">
                   <div class="post-header clearfix">
                       <img src="{{User::getProfileImage($post->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$post->owner->photo}}">
                       <span id="name">{{$post->owner->Firstname . ' ' . $post->owner->Lastname}}</span>
                       <span class="timeago pull-right" data-livestamp="{{strtotime($post->created_at)}}"></span>
                   </div>


                   <div class="post-body">
                       {{$post->Message}}
                       @if(count($post->photos))
                           <div id="statusPhotos" class="clearfix">
                               @foreach($post->photos as $image)
                                   <img src="{{$image->image}}" class="img-responsive pull-left">
                               @endforeach
                           </div>
                       @endif
                   </div>
               </div>
               <hr id="fit">
               {{Form::open(['url' => '/post/comments/'.$post->id, 'id'=>'formPostComment', 'role' => 'form'])}}
                    <div class="modal-body clearfix">
                        {{Form::text('message', null, ['id'=>'txtPostCommentMessage', 'class'=>'form-control', 'placeholder'=>'Write comment...'])}}
                    </div>

               {{Form::close()}}
               <div id="commentTemp" class="hidden">
                    <div id="cloneable">
                        <div class="post-header clearfix">
                           <img src="{{User::getProfileImage(Auth::user()->photo)}}" class="img-responsive pull-left post-photo" alt="{{Auth::user()->photo}}">
                           <span id="name">{{Auth::user()->Firstname . ' ' . Auth::user()->Lastname}}</span>
                           <p id="commentMessage">

                           </p>
                        </div>
                    </div>
               </div>
               <div id="commentSection" class="margin-top-sm">
               @if(count($comments))
                    @foreach($comments as $comment)
                        <div class="post-header clearfix">
                           <img src="{{User::getProfileImage($comment->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$comment->owner->photo}}">
                           <span id="name">{{$comment->owner->Firstname . ' ' . $comment->owner->Lastname}}</span>
                           <span class="timeago pull-right" data-livestamp="{{strtotime($comment->created_at)}}"></span>
                           <p id="commentMessage">
                            {{$comment->commentboxes}}
                           </p>
                        </div>

                    @endforeach
               @else
               <div class="alert-info">No comment.</div>
               @endif
               </div>
            </div>
        </div>
    </div>
</div>



@endif