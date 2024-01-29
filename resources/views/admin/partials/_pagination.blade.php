@if ($paginator->hasPages())
<div class="card-footer">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="d-flex flex-wrap mr-3">

            <a href="{{ $paginator->toArray()['first_page_url'] }}" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>

            @if ($paginator->onFirstPage())
            <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
            @endif

            @foreach ($elements as $element)

            @if (is_string($element))
            <a href="#" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{ $element }}</a>
            @endif

            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <a href="#" class="btn btn-icon btn-sm border-0 btn-light btn-hover-primary active mr-2 my-1">{{ $page }}</a>
            @else
            <a href="{{ $url }}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{ $page }}</a>
            @endif
            @endforeach
            @endif
            @endforeach

            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            @else
            <a href="#" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
            @endif

            <a href="{{ $paginator->toArray()['last_page_url'] }}" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>

        </div>
    </div>
</div>
@endif 




