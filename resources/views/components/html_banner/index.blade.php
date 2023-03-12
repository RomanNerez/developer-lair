@extends('index')

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/html-banner/html-banner.css') }}" />
@endpush

@section('content')
    <div class="container">
        <div class="wrap-container">
            <div class="canvas_wrap-container">
                <div class="canvas_banner-container">
                    <div class="canvas_banner-items"></div>
                </div>
                <div
                    id="control-settings"
                    class="canvas_banner-item-settings"
                    style="display: none;"
                >
                    <div class="canvas_banner-item-settings-content">
                        <span class="action draggable" title="Draggable">
                            <i class="fas fa-grip-vertical"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="banner-timeline">
                <div class="banner-actions">
                    <button class="btn btn-primary add-object">Add Object</button>
                    <button class="btn btn-primary preview-toggle">Preview</button>
                </div>
                <div class="timeline-content">
                    <p>The future timeline for animations</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/html-banner/html-banner.js') }}"></script>
@endpush