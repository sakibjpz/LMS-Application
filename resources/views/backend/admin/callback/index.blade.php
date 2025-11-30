@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <h2>Callback Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Date</th>
                <th>Time</th>
                <th>Requested At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($callbacks as $callback)
                <tr>
                    <td>{{ $callback->id }}</td>
                    <td>{{ $callback->name }}</td>
                    <td>{{ $callback->phone }}</td>
                    <td>{{ $callback->course ? $callback->course->course_title : 'N/A' }}</td>
                    <td>{{ $callback->date }}</td>
                    <td>{{ $callback->time }}</td>
                    <td>{{ $callback->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No callback requests yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
