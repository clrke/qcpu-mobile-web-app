    <div class="modal fade" id="postReplyModal">
      <div class="modal-dialog">
        <div class="modal-content">
            {{Form::open(['url' => '/messages/personal/reply/' .$id, 'id'=>'formPostPersonalReply', 'role' => 'form'])}}
              <div class="modal-header">
                <span type="button" class="close pull-right" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></span>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o fa-fw"></i> Post Reply</h4>
              </div>
              <div class="modal-body">
                {{Form::textarea('message', null, ['id'=>'txtPostReplyMessage', 'class'=>'form-control', 'placeholder'=>'Message here...'])}}
              </div>
              <div class="modal-footer">
                {{HTML::decode(Form::submit('Reply', ['class'=>'btn btn-primary']))}}
              </div>
            {{Form::close()}}
        </div>
      </div>
    </div>
    <div id="message" class="list-group">
    @if(count($messages))
        @foreach($messages as $message)
        <div class="list-group-item margin-top-sm">
            <div class="post-header clearfix">
                <span class="pull-left">
                    <img src="{{User::getProfileImage($message->sender->photo)}}" class="img-responsive pull-left post-photo" alt="{{$message->sender->photo}}">
                    <span id="name"><a href="/messages/view/{{$message->sender->StudentID}}">{{$message->sender->Firstname . ' ' . $message->sender->Lastname}}</a> </span>
                </span>
                <div class="pull-right">
                    @if($message->sender->StudentID != Auth::user()->StudentID)
                        <a href="#" data-toggle="modal" data-target="#postReplyModal"><i class="fa fa-reply fa-fw"></i> <small>Reply</small></a>
                    @else
                        <a href="/messages/personal/delete/{{$message->id}}" id="btnPersonalDelete"><i class="fa fa-remove fa-fw"></i> </a>
                    @endif
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
    {{ HTML::script('js/message_script.js') }}
