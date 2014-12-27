@extends('layouts.index')

@section('content')
	<div ng-controller="SearchController">
		<div ng-repeat="todo in todos">
			@{{ todo.name }}
		</div>
	</div>
@stop
