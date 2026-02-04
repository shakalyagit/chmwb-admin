@props(['card_icon_class', 'card_route', 'card_name', 'card_title'])
<div class="col-md-6 grids-feature mt-4 mb-4">
    <div class="border border-dark p-5">
        <div class="icon-bg">
            <span class="{{ $card_icon_class }}" aria-hidden="true"></span>
        </div>
        <h4><a href="single.html" class="title-head">{{ $card_name }}</a></h4>
        <p>{{ $card_title }}</p>
        <a href="{{ $card_route }}" class="btn btn-primary">Read More </a>
    </div>
</div>
