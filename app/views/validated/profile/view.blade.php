
<div class="container margin-top-sm">
    <div class="modal-header">
        <span id="btnClosePopUp" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></span>
        <h5 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-fw"></i> Profile</h5>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <img id="profile-picture" src="{{User::getProfileImage($user->photo)}}" alt="{{$user->photo}}" class="img-responsive pull-left">
            <div id="profile-name">{{ (strlen($user->Firstname . ' ' . $user->Lastname) < 25) ? $user->Firstname . ' ' . $user->Lastname : substr($user->Firstname . ' ' . $user->Lastname, 0, 25) . '...'}}</div>
        </div>
    </div>

    <div class="row margin-top-sm">
        <div class="col-sm-12">
            @if(count($posts))
                @foreach($posts as $post)
                    <div class="list-group-item margin-top-sm">
                        <div class="post-header clearfix">
                            <a href="#" class="pull-right" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right" style="top:25%;" role="menu">
                              <li><a href="#"><i class="fa fa-plus fa-fw"></i> {{$post->owner->Firstname}} to favorite</a></li>
                              <li><a href="#"><i class="fa fa-remove fa-fw"></i> Remove this post</a></li>
                              <li class="divider"></li>
                              <li><a id="link" data-url="/report/post/{{$post->id}}"><i class="fa fa-file-text fa-fw"></i> Report this post</a></li>
                            </ul>
                            <a href="/post/comments/{{$post->id}}" id="btnPostComment" class="pull-right" data-toggle="modal" data-target="#postCommentsModal"> <small>{{$post->comments->count()}}</small> <i class="fa fa-comments"></i>  </a>
                            <a href="/post/star/{{$post->id}}" id="btnPostStar" class="pull-right"> <span class="pull-left" id="starCount">{{$post->stars->count()}}</span> &nbsp;<i class="fa {{(Star::checkStar($post->stars)) ? 'fa-star' : 'fa-star-o'}}"></i> <small id="starLabel">{{(Star::checkStar($post->stars)) ? 'Starred' : 'Star'}}</small></a>
                            <img src="{{User::getProfileImage($post->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$post->owner->photo}}">
                            <span id="name"><a id="#other" data-transition="slide" href="/profile/{{$post->owner->StudentID}}">{{$post->owner->Firstname . ' ' . $post->owner->Lastname}}</a></span>
                        </div>
                        <hr id="fit">
                        <div class="post-body">
                            {{$post->Message}}
                        </div>
                    </div>

                @endforeach

            @else
                <div id="NoMoreStories" style="padding-bottom: 10px;" class="text-center"><i class="fa fa-meh-o fa-3x"></i><br/> No more stories</div>
            @endif

        </div>
    </div>

</div>
