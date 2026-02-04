@props(['icon', 'row_no', 'step', 'title', 'description'])
<div class="col-md-4 mb-md-0 mb-5 mt-5">
    <div class="icon-bg icon_bg_card">
        <span class="{{ $icon }} icon_bg_card_content" aria-hidden="true"></span>
    </div>
    <h6 class="top-grid-text text-uppercase"><label>0{{ $row_no }}.</label>{{ $step }}</h6>
    <h3 class="grid-one-text mt-2 mb-4">{!! $title !!}</h3>
    <p>{!! $description !!}</p>
</div>
