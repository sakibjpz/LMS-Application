<!DOCTYPE html>
<html lang="en">

<head>

   <title>@yield('title', 'Civil Tech Skills | Online Learning Platform')</title>


   <meta name="description" content="@yield('meta_description', 'Civil Tech Skills is Bangladesh’s leading online learning platform offering civil engineering, technical, and professional skill development courses. Learn industry-relevant skills, advance your career, and get certified online.')">

<meta name="keywords" content="Civil Tech Skills, Civil Engineering Courses, Online Learning Platform, LMS Bangladesh, Technical Training, Skill Development Courses, Professional Training, Online Courses Bangladesh, Civil Engineering Online Courses, Technical Skill Development Online, Career-focused Training Bangladesh, Industry-relevant Civil Engineering Courses, Online Technical Certification, Professional Skill Development, Engineering Skill Courses, Learn Civil Engineering Online, Bangladesh Technical Learning Platform, Civil Tech Education, Civil Engineering Skills, Online Professional Courses, Technical Skills Online Bangladesh, Skill Improvement Courses, Career Advancement Courses">

<meta name="author" content="Civil Tech Skills">

<meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend/images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- inject:css -->

    @include('frontend.section.link')

    <!-- end inject -->

</head>
{{-- <style>
    body{
      background: url({{asset('frontend/images/SiteBackground.png')}})  
    }
</style> --}}

<body>
  

    <!-- start cssload-loader -->
    @include('frontend.section.preloader')

    <!--START HEADER AREA-->
    @include('frontend.section.header')

    @yield('content')


    <!--START COURSE First AREA-->



    <!--START COURSE AREA-->



    <!--START FUNFACT AREA -->



    <!--START CTA AREA-->

    <!--START TESTIMONIAL AREA-->


    <div class="section-block"></div>

    <!--START ABOUT AREA-->



    <div class="section-block"></div>

    <!--START REGISTER AREA-->


    <div class="section-block"></div>

    <!--START CLIENT-LOGO AREA -->




    <!--START BLOG AREA -->




    <!----START GET STARTED AREA---->



    <!---subscribe-area------->



    <!---footer-area--->
    @include('frontend.section.footer')


    <!-- start scroll top -->
    <div id="scroll-top">
        <i class="la la-arrow-up" title="Go top"></i>
    </div>


    <!---tooltip--->

    @include('frontend.section.tooltip')


    <!-- template js files -->
    @include('frontend.section.script')

</body>

</html>
