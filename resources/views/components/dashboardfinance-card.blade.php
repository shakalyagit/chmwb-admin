@props(['bg_color_class', 'icon_class', 'text_color_class', 'risk_label', 'left_value', 'right_value'])
<div class="col-lg-3 border-end-lg border-bottom border-bottom-lg-0 pb-3 pb-lg-0">
    <div class="d-flex flex-between-center mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-item icon-item-md shadow-none me-2 {{ $bg_color_class }}">
                <span class="fs-8  {{ $icon_class }} {{ $text_color_class }}"></span>
            </div>
            <h6 class="mb-0">{{ $risk_label }}</h6>
        </div>
        {{-- <div class="dropdown font-sans-serif btn-reveal-trigger">
            <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button"
                id="dropdown-new-contact" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true"
                aria-expanded="false"><span class="fas fa-ellipsis-h fs-11"></span></button>
            <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-new-contact">
                <a class="dropdown-item" href="{{ $view_route }}">View</a>
                <a class="dropdown-item" href="{{ $export_route }}">Export</a>
            </div>
        </div> --}}
    </div>
    <div class="d-flex">
        <div class="d-flex">
            <p class="font-sans-serif lh-1 mb-1 fs-5 pe-2">{{ $left_value }}</p>
        </div>
        {{-- <div class="echart-crm-statistics w-100 ms-2">
            <p class="font-sans-serif lh-1 mb-1 fs-5 pe-2 float-end">{{ $right_value }}%</p>
        </div> --}}
    </div>
</div>
