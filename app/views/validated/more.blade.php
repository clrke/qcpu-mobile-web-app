<div class="row">
    @{{ 1+1 }}
    <div ng-controller="SearchController">
        <span ng-repeat="todo in todos">
            x
        </span>
        @{{ 1+1 }}
    </div>
    <div class="col-sm-12">
        <div id="link" class="list-group">
            <div class="list-group-item" style="background-image: url('images/qcpu.png'); background-size: auto; background-position: center; background-repeat: no-repeat;">
                <div class="list-group-item-heading clearfix">
                    <img src="{{User::getProfileImage(Auth::user()->photo)}}" height="auto" width="100px" class="pull-right img-responsive">
                    <span id="name" class="pull-left">{{Auth::user()->Firstname . ' ' . Auth::user()->Lastname}}</span>
                </div>
            </div>
            <div class="list-group-item margin-top-sm" style="background-color: #3388cc; color: white; font-size: 1.5em; text-align: center;">
                <span class="list-group-item-heading" >Manage Account</span>
            </div>
            <div class="list-group-item margin-top-sm">
            <span id="name" data-target="/profile/{{Auth::user()->StudentID}}"><i class="fa fa-user fa-fw"></i> User Profile</span>
            </div>
            <div class="list-group-item margin-top-sm">
            <a href="#"><span id="name" data-target="/files"><i class="fa fa-files-o fa-fw"></i> Files</span></a>
            </div>
            <div class="list-group-item clearfix margin-top-sm" id="more_groupPage">
                <a href="#"> <i class="fa fa-group fa-fw"></i> Groups</a>
                <span class="arrow pull-right"><i class="fa fa-chevron-down fa-fw"></i> </span>
                <span class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> </span>

                <div class="row margin-top-sm">
                    <div id="more_group_pages" class="col-sm-12">
                    @if(count($groupPages))
                        <hr id="fit" class="margin-top-sm" />
                            @foreach($groupPages as $group)
                            <div class="margin-top-sm"><i class="fa fa-chain fa-fw"></i> <span id="name" data-target="/grouppage/{{$group->group_pages->grouppageID}}">{{$group->group_pages->Name}}</span> </div>
                            @endforeach

                    @else
                        <div class="margin-top-sm text-center">No group</div>
                    @endif
                    </div>
                </div>
            </div>
            <div class="list-group-item margin-top-sm">
            <a href="#"><i class="fa fa-cogs fa-fw"></i> Settings</a>
            </div>
            <div class="list-group-item margin-top-sm">
            <a href="/logout" onclick="return confirm('Logout?');"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </div>
        </div>
    </div>
</div>