@extends('backend.user.master')

@section('content')
<div class="container">
    {{-- Course Header --}}
    <div class="course-header mb-4">
        <h2>{{ $course->course_title }}</h2>
        <img src="{{ asset($course->course_image) }}" class="img-fluid mb-3" alt="{{ $course->course_title }}">
        <p>{!! $course->description !!}</p>
    </div>

    {{-- Course Goals --}}
    <div class="course-goals mb-4">
        <h4>Course Goals</h4>
        <ul>
            @foreach($course->course_goal as $goal)
                <li>{{ $goal->goal_name }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Sections and Lectures --}}
    <div class="course-sections">
        <h4>Sections</h4>
        @foreach($course->course_sections as $index => $section)
            <div class="section mb-4">
                <button class="btn btn-secondary w-100 text-left mb-2" 
                        type="button" data-toggle="collapse" 
                        data-target="#section-{{ $section->id }}" 
                        aria-expanded="false" aria-controls="section-{{ $section->id }}">
                    {{ $index + 1 }}. {{ $section->section_title }}
                </button>

                <div class="collapse" id="section-{{ $section->id }}">
                    @foreach($section->course_lectures as $lecture)
                        <div class="lecture mb-3 p-3 border rounded">
                            <h6>{{ $lecture->lecture_title }} 
                                @if($lecture->video_duration)
                                    <small>({{ $lecture->video_duration }} mins)</small>
                                @endif
                            </h6>

                            {{-- Video --}}
                            @if($lecture->url)
                                @php
                                    // Convert YouTube URL to embed format
                                    $videoUrl = preg_replace("/watch\?v=/", "embed/", $lecture->url);
                                @endphp
                                <div class="lecture-video mb-2">
                                    <iframe width="100%" height="400" 
                                        src="{{ $videoUrl }}" 
                                        frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            @endif

                            {{-- Lecture content --}}
                            @if($lecture->content)
                                <div class="lecture-content mb-2">
                                    {!! $lecture->content !!}
                                </div>
                            @endif

                            {{-- Lecture resources (PDF preview + download) --}}
                            @if(!empty($lecture->resources))
                                @php
                                    $ext = pathinfo($lecture->resources, PATHINFO_EXTENSION);
                                @endphp
                                <div class="lecture-resources mb-2">
                                    @if($ext === 'pdf')
                                        <embed src="{{ asset($lecture->resources) }}" type="application/pdf" width="100%" height="400px">
                                    @endif
                                    <a href="{{ asset($lecture->resources) }}" class="btn btn-sm btn-outline-primary mt-2" target="_blank">
                                        Download {{ strtoupper($ext) }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Bootstrap collapse
    document.addEventListener("DOMContentLoaded", function() {
        var collapseElements = document.querySelectorAll('.collapse');
        collapseElements.forEach(function(el) {
            new bootstrap.Collapse(el, { toggle: false });
        });
    });
</script>
@endpush
