@extends('layouts.app')

@section('content')

	<div class="form">
		@if(session('message'))
	        <div class="alert alert-success d-flex align-items-center flash-message" role="alert">
			  <div>
			    {{ session('message') }}
			  </div>
			</div>
	    @endif
		<div class="logo">
		    <span class="letter">T</span>
		    <span class="letter">M</span>
		</div>

		<form method="post" action="{{ route('loginUser') }}" class="login-form">
			@csrf
			
			<h1 class="login-head">Log into Task Manager</h1><br>

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

	        @include('snippets.formButtons', [
	        	'class' => 'btn btn-primary',
	        	'type' => 'submit',
	        	'id' => 'loginBtn',
	        	'caption' => 'Login'
	        ])

	        <span class="mt-1">Don't have an account? Sign Up <a href="task-manager/register">here!</a></span>
	    </form>
	</div>
@endsection
