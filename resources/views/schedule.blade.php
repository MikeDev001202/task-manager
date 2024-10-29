@extends('layouts.app')

@section('content')	
@include('layouts.navbar')
		
		<form method="post" action="{{ route('storeTask') }}" class="schedule-form">
			@csrf
			
			<h1 class="login-head">Schedule a new task</h1><br>

			<div class="row col-md-12">
				<div class="col-md-6">
					@include('snippets.formTextInput', [
						'type' => 'text',
			            'name' => 'title',
			            'label' => 'Title',
			            'placeholder' => 'Title',
			            'required' => true,
			        ])
				</div>
				<div class="col-md-6">
					@include('snippets.formTextInput', [
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
						'type' => 'date',
			            'name' => 'due_date',
			            'label' => 'Due Date',
			            'placeholder' => 'Due Date',
			            'required' => true,
			        ])
				</div>
				<div class="col-md-6">
					@include('snippets.formSelect', [
					    'name' => 'assigned_to',
					    'options' => $userSelect,
					    'selected' => '1',
					    'label' => 'Select User'
					])

				</div>
			</div>

			<div class="w-50 ml-3" style="z-index: 99999;">
				<a href="{{ route('homepage') }}" class="btn btn-secondary">Cancel</a>

				@include('snippets.formButtons', [
		        	'class' => 'btn btn-primary',
		        	'type' => 'submit',
		        	'id' => 'scheduleBtn',
		        	'caption' => 'Submit'
		        ])
			</div>
	    </form>
@endsection
