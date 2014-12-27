{{ Form::open(['url' => 'register', 'class' => 'form-horizontal form-login', 'role' => 'form']) }}
     {{ Form::text('studentID', '', ['class' => 'form-control', 'placeHolder' => 'Student ID [eg. 11-1111]']) }}
     {{ Form::password('password', '', ['class' => 'form-control', 'placeHolder' => 'Password']) }}
    {{ Form::submit('Register', ['class'=>'btn btn-default pull-right']) }}
{{Form::close()}}