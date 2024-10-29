@extends('layouts.app')

@section('content')
	<div class="app-bg">
		@include('layouts.navbar')
		<div class="bg-white rounded p-3" style="margin: 20px auto; width: 80%;">
            <h3 class="mb-2">Task Info:</h3>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <label><b>Title: </b> {{ $task -> title }}</label>
                </div>
                <div class="col-md-6">
                    <label><b>Description: </b> {{ $task -> description }}</label>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label><b>Task Due: </b> {{ $task -> due_date }}</label>
                </div>
                <div class="col-md-6">
                    <label><b>Assigned To: </b> {{ $task->assignedTo->name }} {{ $task->assignedTo->surname }}</label>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <label><b>Assigned By: </b> {{ $task->assignedBy->name }} {{ $task->assignedBy->surname }}</label>
                </div>
                <div class="col-md-6">
                    <label><b>Date scheduled: </b> {{ $task->created_at }}</label>
                </div>
            </div><br>
            <hr>
            <div style="position: relative;">
                <a href="{{ route('viewTasks') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
