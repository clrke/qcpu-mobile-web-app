
<div id="onlineUsers">

@if(count($online))
    @foreach($online as $user)
        <div class="list-group-item clearfix">
            <img src="{{User::getProfileImage($user->photo)}}" alt="{{$user->StudentID}}" class="pull-left post-photo"/>
            <span id="name" data-target="/profile/{{$user->StudentID}}">{{ (strlen($user->Firstname . ' ' . $user->Lastname) < 25) ? $user->Firstname . ' ' . $user->Lastname : substr($user->Firstname . ' ' . $user->Lastname, 0, 25) . '...'}}</span>
            <span class="pull-right" style="margin-top: 5px"><i class="fa fa-circle"></i> </span>
            <br/><span class="timeago pull-left" data-livestamp="{{strtotime($user->updated_at)}}"></span>
        </div>
    @endforeach
@else
    <div class="">
        <br/>
        <p class="text-center margin-top-sm"> <i class="fa fa-meh-o fa-fw fa-2x"></i> <br/> No online users</p>
    </div>
    <hr id="fit">
@endif
</div>
