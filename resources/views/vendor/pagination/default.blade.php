@if ($paginator->hasPages())
    <div class="page-navigation-wrap mt-4 text-center">
        <div class="page-navigation-inner d-inline-block">
            <div class="page-navigation">
                @if ($paginator->onFirstPage())
                    <a href="javascript:void(0)" class="page-go page-prev">
                        @if(app()->getLocale() == 'ar')
                            <i class="la la-arrow-right"></i>
                        @else
                            <i class="la la-arrow-left"></i>
                        @endif
                    </a>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-go page-prev">
                        @if(app()->getLocale() == 'ar')
                            <i class="la la-arrow-right"></i>
                        @else
                            <i class="la la-arrow-left"></i>
                        @endif
                    </a>
                @endif
                <ul class="page-navigation-nav">
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="disabled"><a href="javascript:void(0)" class="page-go-link">{{ $element }}</a>
                            </li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><a href="javascript:void(0)" class="page-go-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li><a href="{{ $url }}" class="page-go-link">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </ul>
                @if ($paginator->hasMorePages())

                    <a href="{{ $paginator->nextPageUrl() }}" class="page-go page-next">
                        @if(app()->getLocale() == 'ar')
                            <i class="la la-arrow-left"></i>
                        @else
                            <i class="la la-arrow-right"></i>
                        @endif
                    </a>
                @else
                    <a href="javascript:void(0)" class="page-go page-next">
                        @if(app()->getLocale() == 'ar')
                            <i class="la la-arrow-left"></i>
                        @else
                            <i class="la la-arrow-right"></i>
                        @endif
                    </a>
                @endif
            </div>
        </div>
        <p class="font-size-14 mt-3">Showing {{($paginator->currentpage()-1)*$paginator->perpage()+1}}
            -{{$paginator->currentpage()*$paginator->perpage()}} of {{$paginator->total()}} entries</p>
    </div>
@endif


