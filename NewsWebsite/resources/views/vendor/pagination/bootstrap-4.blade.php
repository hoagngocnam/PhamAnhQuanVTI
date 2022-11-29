@if ($paginator->hasPages())
<nav style="margin-left:1300px ;" role="navigation" aria-label="{{ __('Pagination Navigation') }}"
    class="flex items-center justify-center">
    <span class="relative z-0 inline-flex shadow-sm rounded-md">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="" aria-label="{{ __('pagination.previous') }}">
        </a>
        @endif

        {{-- Pagination Elements --}}
        @if($paginator->currentPage() > 2)
        <a href="{{ $paginator->url(1) }}"
            class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-primary bg-white border border-gray-300 leading-5 hover:text-black hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
            aria-label="{{ __('Go to page :page', ['page' => 1]) }}">
            1
        </a>
        @endif
        @if($paginator->currentPage() > 3)
        {{-- "Three Dots" Separator --}}
        <span aria-disabled="true">
            <span
                class="relative inline-flex items-center p-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">...</span>
        </span>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $i)
        @if($i >= $paginator->currentPage() - 1 && $i <= $paginator->currentPage() + 1)
            @if ($i == $paginator->currentPage())
            <span aria-current="page">
                <span
                    class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium badge-primary border border-gray-300 cursor-default leading-5">{{ $i }}</span>
            </span>
            @else
            <a href="{{ $paginator->url($i) }}"
                class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-primary bg-white border border-gray-300 leading-5 hover:text-black hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                aria-label="{{ __('Go to page :page', ['page' => $i]) }}">
                {{ $i }}
            </a>
            @endif
            @endif
            @endforeach
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                {{-- "Three Dots" Separator --}}
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center p-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">...</span>
                </span>
                @endif
                @if($paginator->currentPage() < $paginator->lastPage() - 1)
                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-primary bg-white border border-gray-300 leading-5 hover:text-black hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        aria-label="{{ __('Go to page :page', ['page' => $paginator->lastPage()]) }}">
                        {{ $paginator->lastPage() }}
                    </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class=""
                        aria-label="{{ __('pagination.next') }}">
                    </a>
                    @else
                    @endif
    </span>
</nav>
<script src="https://kit.fontawesome.com/9749499914.js" crossorigin="anonymous"></script>
@endif