
<section class="">
    <div class="about-one mt-80">
    <div class="row align-items-center">
        <div class="card-body">
            <div class="row">
                @if (is_iterable($pageContent) && (is_array($pageContent)))
                    @forelse ($pageContent as $itemKey => $item)
                        <div class="col-md-12 mb-5">
                            <div>{{ $pageContent->title }}</div>
                        </div>
                        <div class="col-md-12">
                            <div>{!! $pageContent->content !!}</div>
                            <hr />
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="text-danger text-center font-15">No Record Found!</div>
                        </div>
                    @endforelse
                @else
                    @if($showImage)
                        <div class="col-md-12 mb-0">
                            <div class="wrapper">
                                <img src="{{ (isset($pageContentFile) ? $pageContentFile : '') }}" alt=" " class="star">
                                <p>
                                    <div style="margin-top: -50px;"> {!! (isset($pageContent) ? $pageContent : '') !!}</div>
                                </p>
                            </div>
                        </div>
                    @else
                        @if($showTitle)
                        <div class="col-md-12 mb-5">
                            <h2>{{ (isset($pageContentTitle) ? $pageContentTitle : '') }}</h2>
                        </div>
                        @endif
                        <div class="col-md-12 ">
                            <div> {!! (isset($pageContent) ? $pageContent : '') !!}</div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    </div>
</section>



