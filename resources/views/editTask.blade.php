@extends('layouts.app')

@section('content')	
@include('layouts.navbar')
		
		<form method="post" action="{{ route('updateTask', $task->id) }}" class="schedule-form">
			@csrf
			@method('PUT')
			<h1 class="login-head">Edit {{ $task->title }}</h1><br>

			<div class="row col-md-12">
				<div class="col-md-6">
					<input type="hidden" name="id" value="{{ $task->id }}">
					@include('snippets.formTextInput', [
						'value' => $task->title,
						'type' => 'text',
			            'name' => 'title',
			            'label' => 'Title',
			            'placeholder' => 'Title',
			            'required' => true,
			        ])
				</div>
				<div class="col-md-6">
					@include('snippets.formTextInput', [
						'value' => $task->description,
						'type' => 'text',
			            'name' => 'description',
			            'label' => 'Description',
			            'placeholder' => 'Description',
			            'required' => true,
			        ])
				</div>
			</div>
			
			<div class="row col-md-12">
				<div class="col-md-6">
					@include('snippets.formTextInput', [
						'value' => $task->due_date,
						'type' => 'date',
			            'name' => 'due_date',
			            'label' => 'Due Date',
			            'placeholder' => 'Due Date',
			            'required' => true,
			        ])
				</div>
				<div class="col-md-6">
					@include('snippets.formSelect', [
						'selected' => $task->assigned_to,
					    'name' => 'assigned_to',
					    'options' => $userSelect,
					    'selected' => '1',
					    'label' => 'Select User'
					])

				</div>
			</div>

			<div class="w-50 ml-3" style="z-index: 99999;">
				<a href="{{ route('viewTasks') }}" class="btn btn-secondary">Cancel</a>

				@include('snippets.formButtons', [
		        	'class' => 'btn btn-primary',
		        	'type' => 'submit',
		        	'id' => 'scheduleBtn',
		        	'caption' => 'Submit'
		        ])
			</div>
	    </form>
@endsection
