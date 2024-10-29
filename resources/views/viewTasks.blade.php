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
		<div class="bg-white rounded p-3" style="margin: 20px auto; width: 80%;">
            <h1 class="mb-3"><u>All Tasks</u></h1>
            <table id="tasksTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Assigned To</th>
                        <th>Assigned By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                            	@if($task->status === 0)
                            		<span class="badge badge-secondary">Pending</span>
                            	@elseif($task->status === 1)
                            		<span class="badge badge-warning">In Progress</span>
                            	@else
                            		<span class="badge badge-success">Completed</span>
                            	@endif
                            </td>
                            <td>{{ $task->due_date }}</td>
                            <td>{{ $task->assignedTo->name . ' ' . $task->assignedTo->surname ?? 'N/A' }}</td>
                            <td>{{ $task->assignedBy->name . ' ' . $task->assignedBy->surname ?? 'N/A' }}</td>
                            <td>
                                @if(Auth::user()->role === 1 || $task -> assignedBy === Auth::user()->id)
                                    <a href="{{ route('editTask', $task->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('deleteTask', $task->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                                <a href="{{ route('viewTask', $task->id) }}" class="btn btn-success">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded p-3" style="margin: 20px auto; width: 80%;">
            <h1 class="mt-5 mb-3"><u>Activity Log</u></h1>
		    <table id="activityLogTable" class="display">
		        <thead>
		            <tr>
		                <th>ID</th>
		                <th>Action</th>
		                <th>Task ID</th>
		                <th>User</th>
		                <th>Date</th>
		            </tr>
		        </thead>
		        <tbody>
		            @foreach ($taskLogs as $log)
		                <tr>
		                    <td>{{ $log->id }}</td>
		                    <td>
		                    	<span class="badge badge-success">{{ $log->action }}</span>
		                    </td>
		                    <td>{{ $log->task_id }}</td>
		                    <td>{{ $log->user->name ?? 'N/A' }}</td>
		                    <td>{{ $log->created_at }}</td>
		                </tr>
		            @endforeach
		        </tbody>
		    </table>
            <div style="position: relative;">
                <a href="{{ route('homepage') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tasksTable').DataTable();
        });

        $(document).ready(function() {
            $('#activityLogTable').DataTable();
        });
    </script>
	</div>
@endsection
