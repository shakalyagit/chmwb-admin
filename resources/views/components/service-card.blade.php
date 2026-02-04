@props(['route', 'is_media', 'media_path', 'service_name', 'service_title'])
<div>
    <a href="{{ $route }}">
        @if ($is_media)
            <img class="img-fluid img-responsive" src="{{ $media_path }}"
                alt="{{ $service_name }}">
        @endif
        <div class="service-info">
            <h4>{{ $service_name }}</h4>
            <p>{{ \Illuminate\Support\Str::limit($service_title, 65) }}</p>
        </div>
    </a>
</div>
