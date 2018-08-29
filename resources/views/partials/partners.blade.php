<div class="partners-container">
    <h3>Partnerzy</h3>
    <div class="owl-carousel owl-theme mt-3">
        @foreach($partners as $partner)
            <div class="partner">
                @if($partner->url)
                    <a href="{{ $partner->url }}" target="_blank" rel="nofollow"><img src="{{ url('public/partner', $partner->file->path) }}"></a>
                @else
                    <img src="{{ url('public/partner', $partner->file->path) }}">
                @endif
            </div>
        @endforeach
    </div>
</div>