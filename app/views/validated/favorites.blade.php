@if(count($favorites))
    <div class="list-group-item">
        <div class="list-group-item-heading">
            <h4 class="text-center">You have {{$favorites->count()}} favorites</h4>
        </div>
    </div>

    @foreach($favorites as $favorite)
        <div class="list-group-item clearfix">
            <span class="btn btn-danger pull-right"><i class="fa fa-remove fa-fw"></i> Favorite</span>
            <img src="{{User::getProfileImage($favorite->users->photo)}}" class="img-responsive post-photo pull-left">
            <span id="name" class="pull-left">{{$favorite->users->Firstname . ' ' . $favorite->users->Lastname}}</span>
            <br/><i class="timeago pull-left">Favorite since <span data-livestamp="{{strtotime($favorite->created_at)}}"></span></i>


        </div>

    @endforeach
@else
 <div class="list-group-item">
        <div class="list-group-item-heading">
            <h4 class="text-center">You have no favorites</h4>
        </div>
    </div>
@endif