<section class="benefits-section">
    <h2 class="benefits-section-title">বহুস্টুডি থেকে আপনি কী কী সুবিধা পাবেন</h2>

    <div class="benefits-grid">
        @foreach($benefits as $benefit)
            <div class="benefit-card">
                <div class="benefit-icon">
    @php
        $icon = $benefit->icon;
    @endphp

    @if(str_starts_with(trim($icon), '<svg')) 
        {{-- Raw SVG code --}}
        {!! $icon !!}
    @elseif(file_exists(public_path($icon)))
        {{-- Image path --}}
        <img src="{{ asset($icon) }}" alt="Benefit Icon">
    @else
        {{-- Fallback icon if needed --}}
        <span class="icon-placeholder">Icon</span>
    @endif
</div>

                <h4 class="benefit-title">{{ $benefit->title }}</h4>
                <p class="benefit-description">{{ $benefit->description }}</p>
            </div>
        @endforeach
    </div>
</section>
