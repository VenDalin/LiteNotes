@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center">
        <ul class="pagination flex list-none p-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true" class="px-3 py-1 bg-gray-400 text-gray-800">←</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" class="px-3 py-1 bg-gray-400 text-gray-800">←</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span class="px-3 py-1 bg-gray-400 text-gray-800">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span class="px-3 py-1 bg-gray-400 text-gray-800">{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="px-3 py-1 bg-gray-400 text-gray-800">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" class="px-3 py-1 bg-gray-400 text-gray-800">→</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true" class="px-3 py-1 bg-gray-400 text-gray-800">→</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
