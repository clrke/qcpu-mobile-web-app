
<div id="message" class="list-group margin-top-sm">
@if(count($messages))
    @foreach($messages as $message)
    <div class="list-group-item margin-top-sm">
        <div class="post-header clearfix">
            <span class="pull-left">
                <img src="{{User::getProfileImage($message->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$message->owner->photo}}">
                <span id="name"><a href="/messages/view/{{$message->owner->StudentID}}">{{$message->owner->Firstname . ' ' . $message->owner->Lastname}}</a> </span>
            </span>
            <div class="pull-right">
                <a href="/messages/delete/{{$message->ID}}"><i class="fa fa-remove fa-fw"></i> </a>
            </div>
        </div>
        <div class="post-body">
            {{$message->Message}}
        </div>
    </div>
    @endforeach
@else
     <div class="list-group-item">
        <div class="alert alert-info">
            No messages
        </div>
    </div>
@endif
</div>

