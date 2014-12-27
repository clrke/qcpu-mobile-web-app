<div class="row">
    <div class="col-sm-12">

        <div class="tabbable">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#pane1" data-toggle="tab" style="font-size: .75em"><i class="fa fa-user"></i> Personal</a></li>
            <li><a href="#pane2" data-toggle="tab" style="font-size: .75em"><i class="fa fa-users"></i> My Groups</a></li>
            <li><a href="#pane3" data-toggle="tab" style="font-size: .75em"><i class="fa fa-user"></i> Groups</a></li>
          </ul>
          <div class="tab-content">
            <div id="pane1" class="tab-pane active">
                  <div id="message" class="list-group">
                      @if(count($messages))
                          @foreach($messages as $message)
                          <div class="list-group-item margin-top-sm">
                              <div class="post-header clearfix">
                                  <span class="pull-left">
                                      <img src="{{User::getProfileImage($message->sender->photo)}}" class="img-responsive pull-left post-photo" alt="{{$message->sender->photo}}">
                                      <span id="name"><a href="/messages/view/{{$message->sender->StudentID}}">{{$message->sender->Firstname . ' ' . $message->sender->Lastname}}</a> </span>
                                  </span>
                              </div>
                          </div>
                          @endforeach
                      @else
                           <div class="margin-top-sm list-group-item">
                              <div class="alert alert-info">
                                  No message
                              </div>
                          </div>
                      @endif
                  </div>
            </div>
            <div id="pane2" class="tab-pane">
                <div class="list-group-item margin-top-sm">
                    {{Form::open(['url' => '/messages/mygroup/create/', 'id'=>'formCreateGroupChat', 'role' => 'form'])}}
                        <div class="input-group">
                            {{Form::text('name', null, ['id'=>'txtCreateGroupChatName', 'class'=>'form-control', 'placeholder'=>'Group chat name...'])}}
                            <span class="input-group-btn">
                                {{ Form::submit('Create', ['class'=>'btn btn-default'])}}
                            </span>
                        </div>
                    {{Form::close()}}
                </div>

                <div id="message" class="list-group">
                  @if(count($myGroups))
                      @foreach($myGroups as $myGroup)
                      <div class="list-group-item margin-top-sm">
                          <div class="post-header clearfix">
                              <h4 id="name"><a href="messages/mygroup/view/{{$myGroup->ID}}">{{$myGroup->Name}}</a> </h4>
                          </div>
                      </div>
                      @endforeach
                  @else
                       <div class="margin-top-sm list-group-item">
                          <div class="alert alert-info">
                              No MyGroup Chat
                          </div>
                      </div>
                  @endif
              </div>
            </div>
            <div id="pane3" class="tab-pane">
                 <div id="message" class="list-group">
                      @if(count($groups))
                          @foreach($groups as $group)
                          <div class="list-group-item margin-top-sm">
                              <div class="post-header clearfix">
                                  <h4 id="name"><a href="messages/group/view/{{$group->group_chat->ID}}">{{$group->group_chat->Name}}</a> </h4>
                              </div>
                          </div>
                          @endforeach
                      @else
                           <div class="margin-top-sm list-group-item">
                              <div class="alert alert-info">
                                  No Group Chat
                              </div>
                          </div>
                      @endif
                  </div>
            </div>
          </div><!-- /.tab-content -->
          <div id="message_container" class="margin-top-sm clearfix hidden">
            <a href="#" id="tab-content-close" class="btn btn-default"><i class="fa fa-angle-double-left"></i> Back</a>
            <div  id="messages_holder">

            </div>
          </div>

        </div><!-- /.tabbable -->
    </div>
</div><!-- /.row -->


