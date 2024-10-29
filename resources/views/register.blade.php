@extends('layouts.app')

@section('content')
	<div class="form">
		<div class="logo">
		    <span class="letter">T</span>
		    <span class="letter">M</span>
		</div>

		<form method="post" action="{{ route('register.create') }}" class="login-form">
			@csrf
			
			<h1 class="login-head">Register to Task Manager</h1><br>

			@include('snippets.formTextInput', [
	            'name' => 'name',
	            'label' => 'Name',
	            'placeholder' => 'Name',
	            'required' => true,
	        ])

	        @include('snippets.formTextInput', [
	            'name' => 'surname',
	            'label' => 'Surname',
	            'placeholder' => 'Surname',
	            'required' => true,
	        ])

			@include('snippets.formTextInput', [
	            'name' => 'email',
	            'label' => 'Email Address',
	            'placeholder' => 'Email',
	            'required' => true,
	        ])

	        @include('snippets.formTextInput', [
	        	'type' => 'password',
	            'name' => 'password',
	            'label' => 'Password',
	            'placeholder' => 'Password',
	            'required' => true,
	        ])

	        @include('snippets.formTextInput', [
	        	'type' => 'password',
	            'name' => 'confirm_password',
	            'label' => 'Confirm Password',
	            'placeholder' => 'Confirm Password',
	            'required' => true,
	        ])

	        @include('snippets.formButtons', [
	        	'class' => 'btn btn-primary',
	        	'type' => 'submit',
	        	'id' => 'registerBtn',
	        	'caption' => 'Register'
	        ])

	        <span class="mt-1">Already have an account? Login <a href="/task-manager">here!</a></span>
	    </form>
	</div>
@endsection
