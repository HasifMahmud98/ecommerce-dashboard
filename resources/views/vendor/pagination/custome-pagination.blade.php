@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
       
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
            </li>
        @else
            <li class="page-item disabled">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
            </li>
        @endif


      
        @foreach ($elements as $element)
           
            @if (is_string($element))
                <li class="page-item disabled">
                    <a href="javascript: void(0);" class="page-link">{{ $element }}</a>
                </li>
            @endif


           
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a href="javascript: void(0);" class="page-link">{{ $page }}</a>
                        </li>
                        <li class="active my-active"><span>{{ $page }}</span></li>
                    @else
                        <li class="page-item">
                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                        </li>
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                    @endif
                @endforeach
            @endif
        @endforeach


        
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
            </li>
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next →</a></li>
        @else
            <li class="page-item disabled">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
            </li>
            {{-- <li class="disabled"><span>Next →</span></li> --}}
        @endif
    </ul>
@endif 


{{-- <div class="row">
    <div class="col-lg-12">
        <ul class="pagination pagination-rounded justify-content-center mt-3 mb-4 pb-1">
            <li class="page-item disabled">
                <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
            </li>
            <li class="page-item">
                <a href="javascript: void(0);" class="page-link">1</a>
            </li>
            <li class="page-item active">
                <a href="javascript: void(0);" class="page-link">2</a>
            </li>
            <li class="page-item">
                <a href="javascript: void(0);" class="page-link">3</a>
            </li>
            <li class="page-item">
                <a href="javascript: void(0);" class="page-link">4</a>
            </li>
            <li class="page-item">
                <a href="javascript: void(0);" class="page-link">5</a>
            </li>
            <li class="page-item">
                <a href="javascript: void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
            </li>
        </ul>
    </div>
</div> --}}