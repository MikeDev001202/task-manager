@extends('layouts.app')

@section('content')
	<div class="app-bg">
		@include('layouts.navbar')
		@if(session('message'))
	        <div class="alert alert-success d-flex align-items-center flash-message" role="alert">
			  <div>
			    {{ session('message') }}
			  </div>
			</div>
	    @endif
		<div class="container">
			<div class="row col-md-12 menu">
				<div class="row">
		            <div class="col-md-6">
		                <a href="{{ route('scheduleTask') }}" class="task-box schedule-task">
		                    <h2>Schedule Task</h2>
		                </a>
		            </div>
		            <div class="col-md-6">
		                <a href="{{ route('viewTasks') }}" class="task-box view-tasks">
		                    <h2>View Tasks</h2>
		                </a>
		            </div>
				</div>
			</div>
		</div>
	</div>
@endsection
