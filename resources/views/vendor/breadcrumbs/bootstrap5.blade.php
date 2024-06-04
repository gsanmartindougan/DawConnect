@unless ($breadcrumbs->isEmpty())
<div class="mx-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"><b>{{ $breadcrumb->title }}</b></a></li>
                @else
                    <li class="breadcrumb-item active link-dark link-offset-2 link-underline-opacity-25" aria-current="page">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ol>
    </nav>
</div>
@endunless
