<!DOCTYPE html>
<html>
    <head>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>QCPU Social-Learning</title>
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('font-awesome-4.2.0/css/font-awesome.min.css') }}
    {{ HTML::style('css/style.css') }}
    </head>
    <body style="background-image:url('images/bg.jpg'); background-attachment: fixed; background-size: cover;">
    <div class="container margin-top-sm">
        <div class="row">
            <div id="divLoginSection" class="col-xs-10 col-sm-8 col-md-4 col-lg-6 col-xs-offset-1 col-sm-offset-2 col-md-offset-4 col-lg-offset-3">
                <div style="margin: 0 auto; height: 100px; width: 100px; background-image: url('images/qcpu.png'); background-size: cover; opacity: .85;">

                </div>
                <div class="" style="height: 100%; width: auto;">
                    <div class="">
                        <h4 class="text-center"  style="color: #f5f5f5; letter-spacing: 2px; text-shadow: 1px 1px 10px gray;">QCPU APP<br/>Social-Learning</h4>
                        <hr id="fit">
                        <h5 class="text-center"  style="color: rgba(255, 255, 255, 0.75)">Secured Login</h5>

                    </div>
                    <div class="panel-body">
                         @if ($errors->has('StudentID') || $errors->has('password'))
                            <div class="alert alert-danger">
                                 <i class="fa fa-warning fa-fw"></i>Whoops! something's wrong!<hr style="margin:5px 2px"/>
                                 {{ $errors->first('StudentID', '<span class="">*:message</span><br/>') }}
                                 {{ $errors->first('password', '<span class="">*:message</span>') }}

                            </div>
                        @endif

                        {{ Form::open(['url' => '/login', 'class' => 'form-horizontal form-login', 'autocomplete'=>'off', 'role' => 'form']) }}
                            <div class="form-group {{{ $errors->has('StudentID') ? 'error' : '' }}}">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                                {{ Form::text('StudentID', Input::old('StudentID'), ['class' => 'form-control', 'placeHolder' => 'Student ID [eg. 11-1111]']) }}

                                </div>

                            </div>
                            <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                                    {{ Form::password('password', ['class' => 'form-control', 'placeHolder' => 'Password']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group-btn clearfix">
                                    {{ Form::submit('Login', ['class'=>'btn btn-primary pull-right', 'id'=>'btnLogin']) }}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ HTML::script('js/jquery.min.js')  }}
    {{ HTML::script('js/angular.min.js')  }}
    {{ HTML::script('js/app.js')  }}

    </body>
</html>