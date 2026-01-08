<section class="cat-area pt-80px pb-80px bg-gray position-relative">
    <span class="ring-shape ring-shape-1"></span>
    <span class="ring-shape ring-shape-2"></span>
    <span class="ring-shape ring-shape-3"></span>
    <span class="ring-shape ring-shape-4"></span>
    <span class="ring-shape ring-shape-5"></span>
    <span class="ring-shape ring-shape-6"></span>
    <span class="ring-shape ring-shape-7"></span>
    <div class="container">
        <div class="cta-content-wrap text-center">
            <div class="section-heading">
                @if($ctaSection && $ctaSection->ribbon_text)
                    <h5 class="ribbon ribbon-lg mb-3">{{ $ctaSection->ribbon_text }}</h5>
                @endif
                
                @if($ctaSection && $ctaSection->main_text)
                    <h2 class="section__title fs-25 lh-35">{!! nl2br(e($ctaSection->main_text)) !!}</h2>
                @endif
            </div><!-- end section-heading -->
       <div class="cat-btn-box mt-28px">
    <a href="{{ route('courses.all') }}" class="btn theme-btn mr-2">
        All Courses <i class="la la-arrow-right icon ml-1"></i>
    </a>
    <a href="#callback-section" class="btn theme-btn ml-2" onclick="scrollToCallback()">
        Call Book <i class="la la-arrow-right icon ml-1"></i>
    </a>
</div>
        </div><!-- end cta-content-wrap -->
    </div><!-- end container -->
</section><!-- end cta-area -->