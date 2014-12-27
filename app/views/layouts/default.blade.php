@extends('layouts.index')
@section('content')

<div data-role="page" id="HomePage">
        <div data-role="panel" data-display="overlay" data-position-fixed="true" data-position="left" id="left-panel">
            <div id="notification">
                <div class="side-panel-header">
                    Notifications
                </div>
                <div id="notificationsList">
                </div>
            </div>
        </div><!-- /panel -->
        <div data-role="panel" data-display="overlay" data-position-fixed="true" data-position="right" id="right-panel">
            <div class="side-panel-header">
            Online users
            </div>
            <div id="onlineList">
            </div>
        </div><!-- /panel -->
        <div data-role="header" data-position="fixed" class="clearfix">
            <span id="" class="btn-left-panel pull-left" onclick='$( "#left-panel" ).panel( "open" )'><i class="fa fa-globe fa-fw"></i></span>
            <span id="" class="btn-right-panel pull-right" onclick='$( "#right-panel" ).panel( "open" )'><i class="fa fa-bullseye fa-fw"></i></span>
            <span id="" class="btn-right-panel pull-right"><i class="fa fa-picture-o fa-fw" ></i></span>
            <span id="btnPostStatus" class="btn-right-panel pull-right" data-target="/post/status"><i class="fa fa-pencil-square-o fa-fw"></i></span>
            <span id="btnLocalSearch" class="btn-right-panel pull-right" data-target="/search"><i class="fa fa-search fa-fw"></i></span>

            <span style="display: inline-table; width: auto; height: auto; text-align: left; margin: 5px 0 5px -80px; " id="titleHeader">Newsfeed</span>
            <div class="ui-grid-b ui-responsive">
              <div data-role="navbar" id="navbarHeader">
                <ul>
                  <li class="navbar-active" href="/newsfeed" id="#newsfeed"><a href="/newsfeed" data-prefetch><i class="fa fa-newspaper-o"></i></a></li>
                  <li id="#messages" href="/messages"><a href="/messages" data-prefetch><i class="fa fa-envelope "></i></a></li>
                  <li id="#favorites" href="/favorites"><a href="/favorites" data-prefetch><i class="fa fa-users "></i></a></li>
                  <li id="#more" href="/more"><a href="/more" data-prefetch><i class="fa fa-bars"></i></a></li>
                </ul>
              </div>
            </div>
        </div>
        <div id="postCommentsModal">

        </div>
        <div id="content" class="container main">

            <div id="newsfeed" value="" data-role="main">

            </div>
            <div id="messages" data-role="main">

            </div>
            <div id="favorites" data-role="main">
            </div>
            <div id="more" data-role="main">
            </div>
        </div>
    </div>
    </div>

@stop
