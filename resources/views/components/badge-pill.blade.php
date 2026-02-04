@props(['label', 'status_type'])
<div>
    @switch($status_type)
        @case('success')
            <span
                class="bg-success-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-success text-success">{!! $label !!}</span>
        @break

        @case('danger')
            <span
                class="bg-danger-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-danger text-danger">{!! $label !!}</span>
        @break

        @case('primary')
            <span
                class="bg-primary-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-primary text-primary">{!! $label !!}</span>
        @break

        @case('warning')
            <span
                class="bg-warning-subtle pt-1 pb-1 ps-3 pe-3 rounded rounded-pill border border-warning text-warning">{!! $label !!}</span>
        @break

        @default
    @endswitch
</div>
