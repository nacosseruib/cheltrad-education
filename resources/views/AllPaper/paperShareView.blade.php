            <div class="row left-content-center">
                @if(isset($getPapers) and $getPapers)
                    @foreach($getPapers as $key=>$item)

                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="singel-services mb-4 bg-light m-0 p-0" style="height: 310px;">
                                <div class="text-center" style="height: 150px; background-image: url({{ asset('assets/images/bg/software-01.jpg') }});">
                                    <h5 class="bg-info text-white text-uppercase">
                                        {{ $item->category_name }}
                                        <div class="rounded-circle bg-info pull-right text-white" style="font-size: 12px; height:80px; width: 80px; border-radius: 100%;">
                                            <b>{{ $item->course_name }}</b>
                                        </div>
                                    </h5>
                                    <div class="text-white text-center text-uppercase mt-10 p-1" style="font-size: 17px;">
                                        <b>{{ substr($item->paper_name, 0, 70) }} {{ Str::length($item->paper_name) > 70 ? '...' : '' }}</b>
                                    </div>
                                </div> <!-- singel-services -->
                                <div align="center" class="row img-bg-property m-0">
                                    <div class="col-md-12 mt-2">
                                        {{ $item->category_name }} | {{ $item->course_name }} | {{ $item->class_name }}
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        @if($item->cartTypeID == 3)
                                            <a href="#">
                                                <h6 class="text-uppercase text-warning">
                                                    <strong>
                                                        <span class="fa fa-cart-plus"></span> {{ $item->type_name }}
                                                    </strong>
                                                </h6>
                                            </a>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="pt-6 bg-warning pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                                        &nbsp;
                                                    </div> <i>Live</i>
                                                </div>
                                                <div class="col-md-7 mb-1" align="right">
                                                    <a href="{{ route('listPaper', ['cartType'=> base64_encode($item->cartTypeID), 'category'=> base64_encode($item->categoryID), 'course'=> base64_encode($item->courseID)])}}" class="btn btn-warning btn-outline-warning text-white">
                                                        Add To Cart <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-3" align="right">
                                                    <!--@if(isset($paperCoverImagePath))
                                                        <img src="{{ (isset($paperCoverImagePath) ? $paperCoverImagePath . $item->cover_image : null) }}" class="img-responsive" alt=" "  width="100%" height="35px" />
                                                    @else
                                                        <i class="flaticon-open-book"></i>
                                                    @endif-->
                                                </div>
                                            </div>

                                        @elseif($item->cartTypeID == 4)
                                            <a href="#">
                                                <h6 class="text-uppercase" style="color:red">
                                                    <strong>
                                                        <span class="fa fa-lock"></span> {{ $item->type_name }}
                                                    </strong>
                                                </h6>
                                            </a>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="pt-6 bg-danger pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                                        &nbsp;
                                                    </div> <i>Live</i>
                                                </div>
                                                <div class="col-md-7 mb-1" align="right">
                                                    <a href="{{ route('listPaper', ['cartType'=> base64_encode($item->cartTypeID), 'category'=> base64_encode($item->categoryID), 'course'=> base64_encode($item->courseID)])}}" class="btn btn-danger btn-outline-danger text-white">
                                                        Subscribe Now <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-3" align="right">
                                                    <!--@if(isset($paperCoverImagePath))
                                                        <img src="{{ (isset($paperCoverImagePath) ? $paperCoverImagePath . $item->cover_image : null) }}" class="img-responsive" alt=" "  width="100%" height="35px" />
                                                    @else
                                                        <i class="flaticon-open-book"></i>
                                                    @endif-->
                                                </div>
                                            </div>
                                        @else
                                            <a href="#">
                                                <h6 class="text-uppercase" style="color:green">
                                                    <strong>
                                                        <span class="fa fa-unlock"></span> {{ $item->type_name }}
                                                    </strong>
                                                </h6>
                                            </a>
                                            <hr />
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <div class="pt-6 bg-success pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                                        &nbsp;
                                                    </div> <i>Live</i>
                                                </div>
                                                <div class="col-md-7 mb-1" align="right">
                                                    <a href="{{ route('listPaper', ['cartType'=> base64_encode($item->cartTypeID), 'category'=> base64_encode($item->categoryID), 'course'=> base64_encode($item->courseID)])}}" class="btn btn-success btn-outline-success text-white">
                                                        View More <i class="fa fa-angle-right"></i>
                                                    </a>
                                                </div>
                                                <div class="col-md-3" align="right">
                                                    <!--@if(isset($paperCoverImagePath))
                                                        <img src="{{ (isset($paperCoverImagePath) ? $paperCoverImagePath . $item->cover_image : null) }}" class="img-responsive" alt=" "  width="100%" height="35px" />
                                                    @else
                                                        <i class="flaticon-open-book"></i>
                                                    @endif-->
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div> <!-- row -->
            @if(($getPapers instanceof \Illuminate\Pagination\AbstractPaginator))
            <div align="right" class="col-md-12"><hr />
                Showing {{($getPapers->currentpage()-1)*$getPapers->perpage()+1}}
                    to {{$getPapers->currentpage()*$getPapers->perpage()}}
                    of  {{$getPapers->total()}} entries
                </div>
            <div class="d-print-none">{{ $getPapers->links() }}</div>
            @endif
