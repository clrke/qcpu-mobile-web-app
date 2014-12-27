@if(count($post))
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="modal-header">
                <span id="btnClosePopUp" class="close pull-right"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></span>
                <h5 class="modal-title" id="myModalLabel"><i class="fa fa-edit fa-fw"></i> Edit Post</h5>
            </div>
            <div class="modal-body">
                <div class="lismargin-top-sm">
                   <div class="post-header clearfix">
                       <img src="{{User::getProfileImage($post->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$post->owner->photo}}">
                       <span id="name">{{$post->owner->Firstname . ' ' . $post->owner->Lastname}}</span>
                       <br/><span class="timeago" data-livestamp="{{strtotime($post->created_at)}}"></span>
                   </div>


                   <div class="post-body">
                        {{Form::open(['url' => '/post/save/'. $post->id, 'id'=>'formPostStatus', 'role' => 'form', 'files'=>'true'])}}
                           {{ Form::textarea('message', $post->Message , ['class'=>'form-control'])}}
                            {{Form::submit('Save', ['class'=>'btn btn-primary'])}}
                       {{Form::close()}}

                       @if(count($post->photos))
                           <div id="statusPhotos" class="clearfix">
                               @foreach($post->photos as $image)
                                   <img src="{{$image->image}}" class="img-responsive pull-left">
                               @endforeach
                           </div>
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
@endif