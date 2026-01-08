<section class="callback-section" id="callback-section">
    <div class="callback-container">

        <!-- Left Form -->
        <div class="callback-form-wrapper">
            <h3 class="callback-form-title">কল বুক করুন</h3>

            <!-- Show success message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('callback.store') }}" method="POST">
                @csrf

                <!-- Name Input -->
                <div class="form-group">
                    <input type="text" name="name" class="form-input" placeholder="আপনার নাম *" required>
                </div>

                <!-- Phone Input -->
                <div class="form-group">
                    <input type="tel" name="phone" class="form-input" placeholder="ফোন নাম্বার *" required>
                </div>

                <!-- Course Select -->
                <div class="form-group">
                    <select name="course_id" class="form-select" required>
                        <option value="">কোর্স নির্বাচন করুন *</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date Select -->
                <div class="form-group">
                    <select name="date" class="form-select" required>
                        <option value="">তারিখ নির্বাচন করুন *</option>
                        <option value="Today">আজ</option>
                        <option value="Tomorrow">আগামীকাল</option>
                        <option value="Next Week">পরের সপ্তাহ</option>
                    </select>
                </div>

                <!-- Time Select -->
                <div class="form-group">
                    <select name="time" class="form-select" required>
                        <option value="">সময় নির্বাচন করুন *</option>
                        <option value="Morning 9-12">সকাল ৯-১২টা</option>
                        <option value="Afternoon 12-3">দুপুর ১২-৩টা</option>
                        <option value="Evening 3-6">বিকাল ৩-৬টা</option>
                    </select>

                    
                </div>
                <!-- Message/Query Input -->
<div class="form-group">
    <textarea name="message" class="form-input" rows="3" placeholder="আপনার প্রশ্ন বা মেসেজ লিখুন (ঐচ্ছিক)"></textarea>
</div>

                <button type="submit" class="form-submit-btn">কল বুক করুন</button>
            </form>
        </div>

     <!-- Right Content -->
@if($callbackSection)
<div class="callback-content">
    <h2 class="callback-content-title">
        {!! nl2br(e($callbackSection->content_title)) !!}
    </h2>
    <p class="callback-content-description">
        {{ $callbackSection->content_description }}
    </p>
</div>
@endif

    </div>
</section>