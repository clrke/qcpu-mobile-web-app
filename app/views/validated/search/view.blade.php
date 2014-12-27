@if(count($users))
    @foreach($users as $user)
        <div class="list-group-item clearfix">
            <img src="{{ User::getProfileImage($user->photo)}}" class="post-photo" alt="{{$user->id}}">
            <a href="/profile/{{$user->StudentID}}">{{$user->Firstname . ' ' . $user->Lastname}}</a>
        </div>
    @endforeach
@else
    <div class="alert-info">No result</div>
@endif