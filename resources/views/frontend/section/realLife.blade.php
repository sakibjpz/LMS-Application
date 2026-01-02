@if($realLifeSection)
<section class="real-life-section">
    <div class="real-life-container">
        <!-- Left Content -->
        <div class="real-life-content">
            <h2 class="real-life-title">{{ $realLifeSection->title }}</h2>
            <p class="real-life-description">
                {{ $realLifeSection->description }}
            </p>
            
            @if($realLifeSection->hasButton())
            <div class="real-life-button mt-4">
                <a href="{{ $realLifeSection->button_link }}" class="btn btn-primary">
                    {{ $realLifeSection->button_text }}
                </a>
            </div>
            @endif
        </div>

        <!-- Right Image -->
        <div class="real-life-image">
            @if($realLifeSection->image)
                <img src="{{ asset('storage/' . $realLifeSection->image) }}" alt="{{ $realLifeSection->title }}">
            @else
                <img src="/frontend/images/practical-project.ead19e3b.svg" alt="Real Life Projects">
            @endif
        </div>
    </div>
</section>
@endif