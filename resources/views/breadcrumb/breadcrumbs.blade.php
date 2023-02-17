@if ($breadcrumbs)
    <div class="container">
        <ol class="breadcrumb breadcrumb-arrow">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$loop->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="active"><span>{{ $breadcrumb->title }}</span></li>
            @endif
        @endforeach
        </ol>
    </div>
@endif