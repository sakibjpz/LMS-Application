@extends('backend.user.master')

@section('content')

@php
// ==============================
// YOUTUBE URL CONVERTER (GLOBAL)
// ==============================
if (! function_exists('convertYouTubeUrl')) {
    function convertYouTubeUrl($url) {
        if (!$url) return null;

        // Already embed format
        if (strpos($url, 'embed') !== false) {
            return $url;
        }

        // Full YouTube link: https://www.youtube.com/watch?v=xxxx
        if (preg_match('/watch\?v=([^\&\?]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Short link: https://youtu.be/xxxx
        if (preg_match('/youtu\.be\/([^\&\?]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        // Maybe a raw video ID
        if (preg_match('/^[A-Za-z0-9_-]{6,}$/', $url)) {
            return 'https://www.youtube.com/embed/' . $url;
        }

        return $url;
    }
}
@endphp


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

                            <h6>
                                {{ $lecture->lecture_title }}
                                @if($lecture->video_duration)
                                    <small>({{ $lecture->video_duration }} mins)</small>
                                @endif
                            </h6>

                            {{-- ===================== --}}
                            {{--        VIDEO          --}}
                            {{-- ===================== --}}
                            @if($lecture->url)
                                @php 
                                    $videoUrl = convertYouTubeUrl($lecture->url); 
                                @endphp

                                @if($videoUrl)
                                    <div class="lecture-video mb-2">
                                        <iframe width="100%" height="400"
                                            src="{{ $videoUrl }}"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                @endif
                            @endif

                            {{-- Lecture Content --}}
                            @if($lecture->content)
                                <div class="lecture-content mb-2">
                                    {!! $lecture->content !!}
                                </div>
                            @endif

                            {{-- Lecture Resources (PDF preview + Download) --}}
                            @if(!empty($lecture->resources))
                                @php
                                    $ext = pathinfo($lecture->resources, PATHINFO_EXTENSION);
                                @endphp

                                <div class="lecture-resources mb-2">
                                    @if(strtolower($ext) === 'pdf')
                                        <embed src="{{ asset($lecture->resources) }}"
                                               type="application/pdf" width="100%" height="400px">
                                    @endif

                                    <a href="{{ route('lecture.download', $lecture->id) }}"
   class="btn btn-sm btn-outline-primary mt-2">
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
    document.addEventListener("DOMContentLoaded", function() {
        var collapseElements = document.querySelectorAll('.collapse');
        collapseElements.forEach(function(el) {
            new bootstrap.Collapse(el, { toggle: false });
        });
    });
</script>
@endpush
