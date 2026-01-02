<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="{{ setSidebar(['admin.dashboard']) }}">
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-category'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>

        </li>

        <li class="{{ setSidebar(['admin.category*', 'admin.subcategory*']) }}">
            <a href="javascript:;" class="has-arrow">

                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Category</div>
            </a>
            <ul>
                <li  class="{{ setSidebar(['admin.category*']) }}">
                     <a href="{{route('admin.category.index')}}"><i class='bx bx-radio-circle'></i>All Category</a>
                </li>
                <li class="{{ setSidebar(['admin.subcategory*']) }}" >
                    <a href="{{route('admin.subcategory.index')}}"><i class='bx bx-radio-circle'></i>All SubCategory</a>
                </li>

            </ul>
        </li>

      <li  class="{{ setSidebar(['admin.instructor.index', 'admin.instructor.active']) }}">
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i></div>
        <div class="menu-title">Manage Instructor</div>
    </a>
    <ul>
        <li class="{{ setSidebar(['admin.instructor.index']) }}">
            <a href="{{route('admin.instructor.index')}}"><i class='bx bx-radio-circle'></i>All Instructor</a>
        </li>
        <li class="{{ setSidebar(['admin.instructor.active']) }}">
            <a href="{{route('admin.instructor.active')}}"><i class='bx bx-radio-circle'></i>Active Instructor</a>
        </li>
    </ul>
</li>

<li class="{{ setSidebar(['admin.team*']) }}">
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="la la-users"></i></div>
        <div class="menu-title">Our Team</div>
    </a>
    <ul>
       <li class="{{ setSidebar(['admin.it-department.*']) }}">
    <a href="{{ route('admin.it-department.index') }}"><i class='bx bx-radio-circle'></i>IT Department</a>
</li>
      <li class="{{ setSidebar(['admin.administration.*']) }}">
    <a href="{{ route('admin.administration.index') }}"><i class='bx bx-radio-circle'></i>Administration</a>
</li>
    </ul>
</li>


<li class="{{ setSidebar(['admin.blog*']) }}">
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="la la-newspaper-o"></i></div>
        <div class="menu-title">Blog Management</div>
    </a>
    <ul>
        <li class="{{ setSidebar(['admin.blog.index']) }}">
            <a href="{{ route('admin.blog.index') }}"><i class='bx bx-radio-circle'></i>All Posts</a>
        </li>
        <li class="{{ setSidebar(['admin.blog.create']) }}">
            <a href="{{ route('admin.blog.create') }}"><i class='bx bx-radio-circle'></i>Add New Post</a>
        </li>
    </ul>
</li>







        <li class="{{ setSidebar(['admin.course*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Course</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.course*']) }}">
                    <a href="{{route('admin.course.index')}}"><i class='bx bx-radio-circle'></i>All Courses</a>
                </li>


            </ul>
        </li>

         <li class="{{ setSidebar(['admin.order*']) }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Order</div>
            </a>
            <ul>
                <li class="{{ setSidebar(['admin.order*']) }}">
                    <a href="{{route('admin.order.index')}}"><i class='bx bx-radio-circle'></i>All Orders</a>
                </li>


            </ul>
        </li>


<li class="{{ setSidebar(['admin.slider*', 'admin.info*', 'admin.partner*', 'admin.subscriber*', 'admin.site-setting*', 'admin.page-setting*', 'admin.real-life-section*']) }}">
    <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="bx bx-category"></i></div>
        <div class="menu-title">Application Settings</div>
    </a>
    <ul>
        <li class="{{ setSidebar(['admin.slider*']) }}">
            <a href="{{route('admin.slider.index')}}"><i class='bx bx-radio-circle'></i>Manage Slider</a>
        </li>

        <li class="{{ setSidebar(['admin.info*']) }}">
            <a href="{{route('admin.info.index')}}"><i class='bx bx-radio-circle'></i>Manage Info</a>
        </li>

        <li class="{{ setSidebar(['admin.benefit*']) }}">
            <a href="{{ route('admin.benefit.index') }}">
                <i class='bx bx-radio-circle'></i>Manage Benefits
            </a>
        </li>
        
        <li class="{{ setSidebar(['admin.real-life-section*']) }}">
            <a href="{{ route('admin.real-life-section.index') }}">
                <i class='bx bx-radio-circle'></i>Real Life Section
            </a>
        </li>
        
        <li class="{{ setSidebar(['admin.callback*']) }}">
            <a href="{{ route('admin.callback.index') }}">
                <i class='bx bx-radio-circle'></i>Manage Callback Requests
            </a>
        </li>

        <li class="{{ setSidebar(['admin.testimonial*']) }}">
            <a href="{{ route('admin.testimonials.index') }}">
                <i class='bx bx-radio-circle'></i>Manage Testimonials
            </a>
        </li>

        <li class="{{ setSidebar(['admin.funfact*']) }}">
            <a href="{{ route('admin.funfacts.index') }}">
                <i class='bx bx-radio-circle'></i>Manage Funfacts
            </a>
        </li>

        <li class="{{ setSidebar(['admin.partner*']) }}">
            <a href="{{route('admin.partner.index')}}"><i class='bx bx-radio-circle'></i>Manage Partner</a>
        </li>

        <li class="{{ setSidebar(['admin.site-setting*']) }}">
            <a href="{{route('admin.site-setting.index')}}"><i class='bx bx-radio-circle'></i>Site Settings</a>
        </li>
    </ul>
</li>



         <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Config Setting</div>
            </a>
            <ul>

                <li> <a href="{{route('admin.mailSetting')}}"><i class='bx bx-radio-circle'></i>Mail Setting</a>
                </li>

                <li>
                    <a href="{{route('admin.stripeSetting')}}"><i class='bx bx-radio-circle'></i>Stripe Setting</a>
                </li>

                <li>
                    <a href="{{route('admin.googleSetting ')}}"><i class='bx bx-radio-circle'></i>Google Setting</a>
                </li>


            </ul>
        </li>





    </ul>
    <!--end navigation-->
</div>
