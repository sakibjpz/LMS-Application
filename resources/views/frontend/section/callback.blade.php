<section class="callback-section">
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

                <button type="submit" class="form-submit-btn">কল বুক করুন</button>
            </form>
        </div>

        <!-- Right Content -->
        <div class="callback-content">
            <h2 class="callback-content-title">
                ফ্রি কলে পরামর্শ নিন<br>
                ক্যারিয়ার কাউন্সিলরের কাছ থেকে
            </h2>
            <p class="callback-content-description">
                আপনি দেশ সর্ব্বোচ্চ ক্যারিয়ার সিঙ্গাউত নিতে পারেন, তার জন্য আমরা দিচ্ছি ফ্রি ক্যারিয়ার কাউন্সেলিং সাপোর্ট। 
                ক্যারিয়ার নিয়ে আপনার বিভিন্ন প্রশ্নের উত্তর পাবেন অভিজ্ঞ ক্যারিয়ার কাউন্সেলরদের কাছ থেকে।
            </p>
        </div>

    </div>
</section>
