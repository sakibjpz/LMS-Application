<section class="benefits-section">
    @if(isset($benefits[0]) && $benefits[0]->section_title)
        <h2 class="benefits-section-title">{{ $benefits[0]->section_title }}</h2>
    @endif

    <div class="benefits-grid">
        @foreach($benefits as $benefit)
            <div class="benefit-card">
                <div class="benefit-icon">
                    @php
                        $iconImage = $benefit->icon_image;
                        $iconSvg = $benefit->icon;
                    @endphp

                    @if($iconImage && file_exists(public_path($iconImage)))
                        {{-- Display uploaded image --}}
                        <img src="{{ asset($iconImage) }}" alt="{{ $benefit->title }}" style="width: 60px; height: 60px; object-fit: contain;">
                    @elseif($iconImage && str_starts_with($iconImage, 'storage/'))
                        {{-- Display uploaded image from storage --}}
                        <img src="{{ asset($iconImage) }}" alt="{{ $benefit->title }}" style="width: 60px; height: 60px; object-fit: contain;">
                    @elseif($iconSvg && str_starts_with(trim($iconSvg), '<svg'))
                        {{-- Display SVG code --}}
                        {!! $iconSvg !!}
                    @else
                        {{-- Fallback icon --}}
                        <span class="icon-placeholder" style="font-size: 40px;">📋</span>
                    @endif
                </div>

                <h4 class="benefit-title">{{ $benefit->title }}</h4>
                <p class="benefit-description">{{ $benefit->description }}</p>
            </div>
        @endforeach
    </div>
</section>