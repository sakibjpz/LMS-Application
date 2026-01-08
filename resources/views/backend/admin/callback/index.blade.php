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
                <th>Message</th>
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
                    <td>
                        @if($callback->message)
                            <button type="button" class="btn btn-sm btn-info" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#messageModal{{ $callback->id }}">
                                View Message
                            </button>
                            
                            <!-- Modal for Message -->
                            <div class="modal fade" id="messageModal{{ $callback->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Message from {{ $callback->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $callback->message }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">No message</span>
                        @endif
                    </td>
                    <td>{{ $callback->created_at->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No callback requests yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection