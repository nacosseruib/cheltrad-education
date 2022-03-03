<div class="row left-content-center">
    @if(isset($getSampleQuiz) and $getSampleQuiz)
        @foreach($getSampleQuiz as $key=>$item)
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="singel-services mb-3 bg-light">
                    <div class="text-center" style="height: 150px; background-image: url({{ asset('assets/images/bg/software-02.jpg') }});">
                        <h5 class="bg-info text-white text-uppercase">
                            {{ $item->category_name }}
                            <div class="rounded-circle bg-info pull-right text-white" style="font-size: 12px; height:80px; width: 80px; border-radius: 100%;">
                                <b>{{ $item->course_name }}</b>
                            </div>
                        </h5>
                        <div class="text-white text-uppercase mt-10 p-1" style="font-size: 13px;">
                           <b>{{ $item->quiz_name }}</b>
                        </div>
                    </div> <!-- singel-services -->
                    <div align="center" class="row">
                        <div class="col-md-12 mt-2">
                            <div style="font-size: 13px;">
                                <em>{{ $item->category_name .' '. $item->course_name .' '. $item->class_name .' Quiz Test' }}</em>
                            </div>
                            @if($item->cartTypeID == 3)
                                <a href="#">
                                    <h6 class="text-uppercase text-warning">
                                        <strong>
                                            <span class="fa fa-cart-plus"></span> {{ $item->type_name }}
                                        </strong>
                                    </h6>
                                </a>
                                <hr />
                                <div class="" align="left">
                                    <div class="pt-6 bg-warning pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                         &nbsp;
                                    </div> <i>Live</i>
                                </div>
                                <div class="col-md-11">
                                    <button type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmCart{{ $item->quizID }}"  title="Add To Cart" data-abc="true" class="btn btn-warning btn-sm">
                                        Add To Cart <i class="fa fa-angle-right"></i>
                                    </button>
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
                                <div class="" align="left">
                                    <div class="pt-6 bg-danger pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                         &nbsp;
                                    </div> <i>Live</i>
                                </div>
                                <div class="col-md-11">
                                    <a href="#" class="btn btn-danger btn-outline-danger btn-sm text-white" title="Subscribe to this quiz">
                                        Subscribe Now <i class="fa fa-angle-right"></i>
                                    </a>
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
                                <div class="" align="left">
                                    <div class="pt-6 bg-success pull-left text-white" style="height: 12px; width: 12px; border-radius: 50%;">
                                         &nbsp;
                                    </div> <i>Live</i>
                                </div>
                                <div class="col-md-11">
                                    <a title="Start your free quiz" href="{{ route('createSampleQuiz',['q'=>base64_encode($item->quizID), 'ca'=>base64_encode($item->categoryID), 'co'=>base64_encode($item->courseID) ]) }}" class="btn btn-success btn-sm btn-outline-success text-white">
                                         Start Now <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>

            <!--add item to cart modal-->
            <form method="POST" action="{{ route('saveSelectedProduct') }}">
                @csrf
                <div class="modal fade text-left" id="confirmCart{{ $item->quizID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-secondary white">
                                <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-shopping-bag"></i> Add To Cart  </h4>
                                <button id="hideCloseWhenTimeUp2" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center text-info">
                                    {{ $item->quiz_name }}
                                </div>
                                <div class="text-center text-danger">
                                    Are you sure you want to add this item to cart?
                                </div>
                            </div>
                            <input type="hidden" value="{{ $item->quizID }}" name="product[]" class="form-control" />
                            <input type="hidden" value="quiz" name="productType" class="form-control" />

                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-primary mt-3" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-outline-success p-2 mt-3"><i class="fa fa-shopping-cart"></i> Add </a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <!--end Modal-->

        @endforeach
    @endif
</div> <!-- row -->
@if(($getSampleQuiz instanceof \Illuminate\Pagination\AbstractPaginator))
<div align="right" class="col-md-12"><hr />
    Showing {{($getSampleQuiz->currentpage()-1)*$getSampleQuiz->perpage()+1}}
        to {{$getSampleQuiz->currentpage()*$getSampleQuiz->perpage()}}
        of  {{$getSampleQuiz->total()}} entries
</div>
<div class="d-print-none">{{ $getSampleQuiz->links() }}</div>
@endif
