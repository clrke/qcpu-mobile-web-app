<div class="">
    @if(count($groupPages))
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="modal-header">
            <span id="btnClosePopUp" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></span>
            <h5 class="modal-title" id="myModalLabel"><i class="fa fa-institution fa-fw"></i> {{$groupPages->group_pages->Name}}</h5>
        </div>
    </div>
    @endif
    <div class="container">
        <div class="clearfix margin-top-sm">
            {{Form::open(['url' => '/grouppage/post/'.$groupPages->grouppageID, 'id'=>'formGroupPostStatus', 'class'=>'', 'role' => 'form', 'files'=>'true'])}}
                {{Form::textarea('txtPostGroupStatusMessage', null, ['class'=>'form-control'])}}
                {{Form::submit('Post', ['class'=>'btn btn-primary pull-right margin-top-sm'])}}
            {{Form::close()}}
        </div>
        <div class="col-sm-12">

                <div class="tabbable">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#pane1" data-toggle="tab" style="font-size: .75em"><i class="fa fa-user"></i> Posts</a></li>
                    <li><a href="#pane2" data-toggle="tab" style="font-size: .75em"><i class="fa fa-files-o"></i> Files</a></li>
                    <li><a href="#pane3" data-toggle="tab" style="font-size: .75em"><i class="fa fa-users"></i> Members</a></li>
                  </ul>
                  <div class="tab-content">
                    <div id="pane1" class="tab-pane active">
                        @if(count($groupPosts))
                            <div class="list-group">
                                @foreach($groupPosts as $post)
                                    <div class="list-group-item margin-top-sm">
                                        <div class="post-header clearfix">
                                            <img src="{{User::getProfileImage($post->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$post->owner->photo}}">
                                            <span id="name" href="#" data-target="/profile/{{$post->owner->StudentID}}">{{$post->owner->Firstname . ' ' . $post->owner->Lastname}}</span>
                                            <br/><span class="timeago" data-livestamp="{{strtotime($post->created_at)}}"></span>
                                        </div>
                                        <hr id="fit">
                                        <div class="post-body">
                                            {{$post->Message}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div id="pane2" class="tab-pane active">
                        Files
                    </div>
                    <div id="pane3" class="tab-pane active">
                        <div class="list-group margin-top-sm">
                            @if(count($members))
                                @foreach($members as $member)
                                    <div class="list-group-item clearfix">
                                        <img src="{{User::getProfileImage($member->owner->photo)}}" class="pull-left post-photo img-responsive">
                                        <span class="name">{{$member->owner->Firstname . ' ' . $member->owner->Lastname}}</span>
                                        <br/><span class="timeago">Member since </span> <span class="timeago" data-livestamp="{{strtotime($member->created_at)}}"></span>

                                    </div>
                                @endforeach
                            @else

                            @endif
                        </div>
                    </div>
                  </div>
                </div>
            </div>
    </div>
</div>