@if($lastID->id)
<div id="lastNotification" data-id="{{$lastID->id}}"></div>
@endif
<div id="notificationContainer">
    @if(count($notifications))
        @foreach($notifications as $notification)
            @if($notification->StudentID <> $notification->posts->StudentID)
                <div class="list-group-item padding-sm clearfix">
                    <small class="pull-left text-noti-msg"><b>{{$notification->doer->Firstname . ' ' . $notification->doer->Lastname}}</b>
                         {{ (strtolower($notification->event) == 'star') ? '<i class="fa fa-star-o fa-fw"></i>' : '
<i class="fa fa-comment-o fa-fw"></i>' }} your post <i>"{{ substr($notification->posts->Message, 0, 15)}}"</i>

                    </small>
                    <img src="{{User::getProfileImage($notification->doer->photo)}}" class="post-photo pull-right">
                    <br/><span class="pull-left timeago" data-livestamp="{{strtotime($notification->created_at)}}"></span>
                </div>
            @endif
        @endforeach
    @endif
</div>


