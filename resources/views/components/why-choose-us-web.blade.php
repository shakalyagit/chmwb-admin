@props(['cta', 'wcu_icon', 'title', 'description', 'card_bg_color'])
<div class="col-lg-4 col-md-6 features15-col-text">
    <a href="{!! $cta !!}" class="d-flex feature-unit align-items-center border border-dark"
        style="background-color: {{ $card_bg_color }}">
        <div class="col-3">
            <div class="features15-info">
                <span class="{!! $wcu_icon !!}" aria-hidden="true"></span>
            </div>
        </div>
        <div class="col-9">
            <div class="features15-para">
                <h4>{!! $title !!}</h4>
                <p>{!! $description !!}</p>
            </div>
        </div>
    </a>
</div>
