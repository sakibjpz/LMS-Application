<?php
$categories = getCategories();
?>

<header class="header-menu-area bg-white">
    <div class="header-top pr-150px pl-150px border-bottom border-bottom-gray py-1">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="generic-list-item d-flex flex-wrap align-items-center fs-14">
                            <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                    class="la la-phone mr-1"></i><a href="tel:00123456789"> (00) 123 456 789</a>
                            </li>
                            <li class="d-flex align-items-center"><i class="la la-envelope-o mr-1"></i><a
                                    href="mailto:contact@aduca.com"> contact@civiltech.com</a></li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-widget d-flex flex-wrap align-items-center justify-content-end">
                        <div class="theme-picker d-flex align-items-center">
                            <button class="theme-picker-btn dark-mode-btn" title="Dark mode">
                                <svg id="moon" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                                </svg>
                            </button>
                            <button class="theme-picker-btn light-mode-btn" title="Light mode">
                                <svg id="sun" viewBox="0 0 24 24" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="5"></circle>
                                    <line x1="12" y1="1" x2="12" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="23"></line>
                                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                    <line x1="1" y1="12" x2="3" y2="12"></line>
                                    <line x1="21" y1="12" x2="23" y2="12"></line>
                                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                </svg>
                            </button>
                        </div>

                        @if (!auth()->user())
                            <ul
                                class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-sign-in mr-1"></i><a href="{{ route('login') }}"> Login</a></li>
                                <li class="d-flex align-items-center"><i class="la la-user mr-1"></i><a
                                        href="{{ route('register') }}"> Register</a></li>
                            </ul>
                        @else
                            <ul
                                class="generic-list-item d-flex flex-wrap align-items-center fs-14 border-left border-left-gray pl-3 ml-3">
                                <li class="d-flex align-items-center pr-3 mr-3 border-right border-right-gray"><i
                                        class="la la-sign-in mr-1"></i>

                                    @if (auth()->user()->role == 'user')
                                        <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                    @endif

                                    @if (auth()->user()->role == 'admin')
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    @endif

                                    @if (auth()->user()->role == 'instructor')
                                        <a href="{{ route('instructor.dashboard') }}">Dashboard</a>
                                    @endif
                                </li>

                            </ul>
                        @endif


                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-top -->



    <div class="header-menu-content pr-150px pl-150px bg-white">
        <div class="container-fluid">
            <div class="main-menu-content">
                <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            
                            <a href="{{ route('frontend.home') }}" class="logo"><img src="{{asset('frontend/images/civil_tech-logo 2.png')}}" alt="logo"></a>
                            <div class="user-btn-action">
                                <div class="search-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Search">
                                    <i class="la la-search"></i>
                                </div>
                                <div class="off-canvas-menu-toggle cat-menu-toggle icon-element icon-element-sm shadow-sm mr-2"
                                    data-toggle="tooltip" data-placement="top" title="Category menu">
                                    <i class="la la-th-large"></i>
                                </div>
                                <div class="off-canvas-menu-toggle main-menu-toggle icon-element icon-element-sm shadow-sm"
                                    data-toggle="tooltip" data-placement="top" title="Main menu">
                                    <i class="la la-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                         <div class="menu-category">
    <ul>
        <li>
            <a href="#">Courses <i class="la la-angle-down fs-12"></i></a>
            <ul class="cat-dropdown-menu">
                @foreach($courses as $course)
                <li>
                    <a href="{{ route('course-details', $course->id) }}">{{ $course->course_title }}</a>
                </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div><!-- end menu-category -->
                          <form method="GET" action="{{ route('course.search') }}" class="position-relative">
    <div class="form-group mb-0">
        <input class="form-control form--control pl-3" 
               type="text" 
               name="query" 
               id="course-search"
               placeholder="Search for anything"
               autocomplete="off">
        <button type="submit" class="border-0 bg-transparent p-0 search-icon">
            <span class="la la-search"></span>
        </button>
    </div>
    <!-- Autocomplete dropdown -->
    <div id="autocomplete-results" class="autocomplete-dropdown"></div>
</form>
                          <nav class="main-menu">
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <li>
            <a href="{{ route('courses.all') }}">All Courses</a>
        </li>
        <li>
            <a href="#">Our Team <i class="la la-angle-down fs-12"></i></a>
            <ul class="sub-menu">
                <li><a href="{{ route('trainers.page') }}">Trainers</a></li>
                <li><a href="{{ route('it-department.page') }}">IT Department</a></li>
                <li><a href="{{ route('administration.page') }}">Administration</a></li>
            </ul>
        </li>

        <li>
    <a href="#">Verify Certificate</a>
</li>
        <li>
            <a href="{{ route('cart') }}">Cart</a>
        </li>
        <li>
            <a href="{{ route('blog') }}">Blog</a>
        </li>
    </ul>
</nav>

                         


                            <div class="shop-cart mr-4" id='cart'>

                                <!--ajax loaded for cart frontend.pages.home.partial.cart  -->

                            </div><!-- end shop-cart -->



                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->


 <div class="off-canvas-menu custom-scrollbar-styled main-off-canvas-menu">
    <div class="off-canvas-menu-close main-menu-close icon-element icon-element-sm shadow-sm"
        data-toggle="tooltip" data-placement="left" title="Close menu">
        <i class="la la-times"></i>
    </div>
    
    <!-- MOBILE SEARCH FORM -->
    <div class="mobile-search-form p-3 border-bottom">
        <form method="GET" action="{{ route('course.search') }}" class="position-relative">
            <div class="form-group mb-0">
                <input class="form-control form--control pl-3" 
                       type="text" 
                       name="query" 
                       placeholder="Search for anything"
                       autocomplete="off">
                <button type="submit" class="border-0 bg-transparent p-0 search-icon">
                    <span class="la la-search"></span>
                </button>
            </div>
        </form>
    </div>
    <!-- END MOBILE SEARCH FORM -->
    
    <ul class="generic-list-item off-canvas-menu-list pt-30px">
        <li><a href="{{ route('frontend.home') }}">Home</a></li>
        <li><a href="{{ route('courses.all') }}">All Courses</a></li>
        <li><a href="{{ route('cart') }}">Cart</a></li>
        <li>
            <a href="#" class="mobile-dropdown-toggle">Our Team <i class="la la-angle-right float-right"></i></a>
            <ul class="mobile-sub-menu">
                <li><a href="{{ route('trainers.page') }}">Trainers</a></li>
                <li><a href="{{ route('it-department.page') }}">IT Department</a></li>
                <li><a href="{{ route('administration.page') }}">Administration</a></li>
            </ul>
        </li>
        <li><a href="#">Verify Certificate</a></li>
        <li><a href="{{ route('blog') }}">Blog</a></li>
        @if(!auth()->user())
        <li><a href="{{ route('login') }}">Login</a></li>
        @endif
    </ul>
</div><!-- end off-canvas-menu -->




</header><!-- end header-menu-area -->
<script>
// Mobile menu dropdown toggle
document.querySelectorAll('.mobile-dropdown-toggle').forEach(function(toggle) {
    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        const submenu = this.nextElementSibling;
        submenu.classList.toggle('active');
        this.querySelector('i').classList.toggle('la-angle-right');
        this.querySelector('i').classList.toggle('la-angle-down');
    });
});

// Mobile menu toggle (hamburger icon opens menu)
document.querySelector('.main-menu-toggle').addEventListener('click', function() {
    document.querySelector('.main-off-canvas-menu').classList.add('active');
});

// Mobile search icon opens menu with search focused
document.querySelector('.search-menu-toggle').addEventListener('click', function() {
    document.querySelector('.main-off-canvas-menu').classList.add('active');
    // Focus on search input after a small delay
    setTimeout(function() {
        document.querySelector('.mobile-search-form input').focus();
    }, 300);
});

// Close mobile menu
document.querySelector('.main-menu-close').addEventListener('click', function() {
    document.querySelector('.main-off-canvas-menu').classList.remove('active');
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('course-search');
    const autocompleteResults = document.getElementById('autocomplete-results');
    let debounceTimer;

    // Function to fetch autocomplete results
    function fetchAutocomplete(query) {
        if (query.length < 2) {
            autocompleteResults.style.display = 'none';
            return;
        }

        fetch(`/search/autocomplete?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    autocompleteResults.innerHTML = '';
                    data.forEach(course => {
                        const item = document.createElement('div');
                        item.className = 'autocomplete-item';
                        item.innerHTML = `
                            <div class="course-title">${course.course_title}</div>
                        `;
                        item.addEventListener('click', function() {
                            window.location.href = `/course-details/${course.id}`;
                        });
                        autocompleteResults.appendChild(item);
                    });
                    autocompleteResults.style.display = 'block';
                } else {
                    autocompleteResults.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                autocompleteResults.style.display = 'none';
            });
    }

    // Event listener for input with debounce
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchAutocomplete(this.value);
        }, 300); // 300ms delay
    });

    // Hide autocomplete when clicking outside
    document.addEventListener('click', function(event) {
        if (!searchInput.contains(event.target) && !autocompleteResults.contains(event.target)) {
            autocompleteResults.style.display = 'none';
        }
    });

    // Hide autocomplete when pressing Escape
    searchInput.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            autocompleteResults.style.display = 'none';
        }
    });
});
// Prevent empty search submission
document.querySelector('form[action="{{ route("course.search") }}"]').addEventListener('submit', function(e) {
    const searchInput = this.querySelector('input[name="query"]');
    if (!searchInput.value.trim()) {
        e.preventDefault();
        searchInput.focus();
    }
});
</script>
<style>
#autocomplete-results {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: #fff;
    border: 1px solid #e1e1e1;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 9999;
    max-height: 400px;
    overflow-y: auto;
    margin-top: -1px;
    display: none;
}

.autocomplete-item {
    padding: 12px 20px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 14px;
    color: #333;
    border-bottom: 1px solid #f5f5f5;
}

.autocomplete-item:hover {
    background-color: #f0f7ff;
    color: #0066cc;
}

.autocomplete-item:last-child {
    border-bottom: none;
}

/* No results message */
.autocomplete-no-results {
    padding: 15px 20px;
    color: #666;
    font-size: 14px;
    text-align: center;
    font-style: italic;
}

.main-menu .sub-menu {
    position: absolute;
    background: white;
    border: 1px solid #ddd;
    padding: 10px 0;
    min-width: 200px;
    display: none;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.main-menu li:hover .sub-menu {
    display: block;
}

.main-menu .sub-menu li {
    display: block;
    padding: 0;
}

.main-menu .sub-menu a {
    display: block;
    padding: 8px 20px;
    color: #333;
    white-space: nowrap;
}

.main-menu .sub-menu a:hover {
    background: #f5f5f5;
}
.mobile-sub-menu {
    display: none;
    padding-left: 20px;
}

.mobile-sub-menu.active {
    display: block;
}

/* Mobile menu styles */
.main-off-canvas-menu {
    position: fixed;
    top: 0;
    right: -400px;
    width: 350px;
    height: 100%;
    background: white;
    z-index: 99999;
    transition: right 0.3s ease;
    overflow-y: auto;
}

.main-off-canvas-menu.active {
    right: 0;
}

@media (max-width: 991px) {
    .main-menu .sub-menu {
        position: static;
        display: none;
        border: none;
        box-shadow: none;
        padding-left: 20px;
    }
    
    .main-menu li.active .sub-menu {
        display: block;
    }
}
</style>