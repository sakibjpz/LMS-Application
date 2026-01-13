@extends('frontend.master')


@section('title', 'Civil Tech Skills | Civil Engineering & Technical Courses')
@section('meta_description', 'Learn civil engineering, technical, and professional skills online with Civil Tech Skills. Industry-focused courses designed for career growth in Bangladesh.')

@section('content')

@include('frontend.section.hero')

@include('frontend.section.feature')

{{-- @include('frontend.section.category') --}}

@include('frontend.section.course-area-first')

@include('frontend.section.benefits')

@include('frontend.section.realLife')

@include('frontend.section.callback')

@include('frontend.section.funfact')



@include('frontend.section.testimonial-section')

{{-- @include('frontend.section.testmonial') --}}

@include('frontend.section.cta')

@endsection
