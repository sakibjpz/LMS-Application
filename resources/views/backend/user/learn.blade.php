@extends('backend.user.master')

@section('content')

@php
// ==============================
// YOUTUBE URL CONVERTER (GLOBAL)
// ==============================
if (! function_exists('convertYouTubeUrl')) {
    function convertYouTubeUrl($url) {
        if (!$url) return null;

        if (strpos($url, 'embed') !== false) return $url;

        if (preg_match('/watch\?v=([^\&\?]+)/', $url, $m)) return 'https://www.youtube.com/embed/' . $m[1];
        if (preg_match('/youtu\.be\/([^\&\?]+)/', $url, $m)) return 'https://www.youtube.com/embed/' . $m[1];
        if (preg_match('/^[A-Za-z0-9_-]{6,}$/', $url)) return 'https://www.youtube.com/embed/' . $url;

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

                            {{-- Video --}}
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

                            {{-- Lecture Resources --}}
                            @if(!empty($lecture->resources))
                                @php
                                    // Handle multiple resources (JSON array or single string)
                                    $resources = json_decode($lecture->resources, true) ?: [$lecture->resources];
                                @endphp

                                @foreach($resources as $resource)
                                    @php
                                        $ext = strtolower(pathinfo($resource, PATHINFO_EXTENSION));
                                        $previewUrl = $ext === 'pdf' ? route('user.lecture.preview', $lecture->id) : null;
                                        $downloadUrl = route('user.lecture.download', $lecture->id);
                                    @endphp

                                    <div class="lecture-resources mb-3">

                                        @if($ext === 'pdf')
                                            {{-- PDF inline preview --}}
                                            <div class="resource-preview mb-2" style="border:1px solid #e6e6e6; border-radius:6px; overflow:hidden;">
                                                <iframe src="{{ $previewUrl }}" width="100%" height="420" style="border:0;" title="PDF Preview"></iframe>
                                            </div>
                                            <div class="mt-2">
                                                <a href="{{ $downloadUrl }}" class="btn btn-sm btn-primary">Download PDF</a>
                                            </div>
                                        @else
                                            {{-- Non-PDF: show icon + Download --}}
                                            <div class="resource-preview mb-2 p-3 d-flex align-items-center border rounded" style="background:#fafafa;">
                                                <div style="width:48px; text-align:center; font-size:22px;">
                                                    @if(in_array($ext, ['doc','docx']))
                                                        <span class="oi oi-document" aria-hidden="true"></span>
                                                    @elseif(in_array($ext, ['ppt','pptx']))
                                                        <span class="oi oi-media-slideshow" aria-hidden="true"></span>
                                                    @else
                                                        <span class="oi oi-cloud-download" aria-hidden="true"></span>
                                                    @endif
                                                </div>

                                                <div class="ml-3 flex-grow-1">
                                                    <div><strong>{{ basename($resource) }}</strong></div>
                                                    <div class="text-muted small">File type: {{ strtoupper($ext) }}</div>
                                                </div>

                                                <div class="ml-3">
                                                    @if($ext === 'pdf')
                                                        <a href="{{ $previewUrl }}" target="_blank" class="btn btn-sm btn-outline-secondary mr-2">Open</a>
                                                    @endif
                                                    <a href="{{ $downloadUrl }}" class="btn btn-sm btn-outline-primary">Download</a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                @endforeach
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
