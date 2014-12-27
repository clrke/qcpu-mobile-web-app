@if(count($users))
    @foreach($users as $user)

        <div class="list-group-item clearfix">
            <img src="{{ User::getProfileImage($user->photo)}}" class="post-photo" alt="{{$user->id}}">
            <span>{{$user->Firstname . ' ' . $user->Lastname}}</span>
            @if(GroupChatMember::alreadyMember($id, $user->StudentID))
                <div class="pull-right badge" style="color: white; background-color: #00a0df; font-weight: normal;">Member</div>
            @else
                <a href="/messages/mygroup/{{$id}}/add/{{$user->StudentID}}" style="color: white;" class="btn btn-sm {{($user->online == '1') ? ' btn-success' : ' btn-primary'}} pull-right"><i class="fa fa-plus"></i> </a>
            @endif
        </div>
    @endforeach
@else
    <div class="alert-info">No result</div>
@endif