@extends('layout.app')
@section('pageTitle', 'list of all questions and answers')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center pb-25">
                        <h2> Questions and answers <span> paper</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row left-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @include('ShareView.operationCallBackAlert')
                    <div class="singel-services mb-5">
                        <table class="table table-hover table-striped table-responsive">
                            @if(isset($getPapers) and $getPapers)
                                @foreach($getPapers as $key=>$item)
                                    <tr class="text-uppercase">
                                        <th class="pt-2 pb-2 text-left"> {{ 1 + $key }}</th>
                                        <th class="pt-2 pb-2 text-left"> {{ $item->paper_name }} </th>
                                        <th class="pt-2 pb-2 text-left text-info"> {{ $item->category_name }} </th>
                                        <th class="pt-2 pb-2 text-left {{ ($item->cartTypeID > 2 ? 'text-warning' : 'text-success') }}"> {{ $item->course_name }} </th>
                                         <th class="pt-2 pb-2 text-center" width="150">
                                            @if(file_exists($uploadPath .'product-paper/' . $item->file_name))
                                                @if($item->cartTypeID > 2)
                                                    <a href="javascript:;" class="btn btn-warning btn-sm"> <i class="fa fa-lock"></i> DOWNLOAD</a>
                                                @else
                                                    <a target="_blank" href="{{ (isset($paperPath) ? $paperPath . $item->file_name : 'javascript:;') }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> DOWNLOAD</a>
                                                @endif
                                            @endif
                                        </th>
                                        <th class="pt-2 pb-2 text-center" width="150">
                                            @if(file_exists($uploadPath .'product-paper/product-answer/' . ($item->file_name_answer ? $item->file_name_answer : 'null') ))
                                                @if($item->cartTypeID > 2)
                                                    <a href="javascript:;" class="btn btn-warning btn-sm"> <i class="fa fa-lock"></i> ANSWER </a>
                                                @else
                                                    <a target="_blank" href="{{ (isset($paperAnswerPath) ? $paperAnswerPath . $item->file_name_answer : 'javascript:;') }}" class="btn btn-warning btn-sm"> <i class="fa fa-unlock"></i> ANSWER</a>
                                                @endif
                                            @endif
                                        </th>
                                        @if($item->cartTypeID > 2)
                                            <th class="text-center">
                                                <button type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmCart{{ $item->paperID }}"  title="Add To Cart" data-abc="true" class="btn btn-success btn-sm">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </th>
                                        @endif
                                    </tr>

                                    <!--add item to cart modal-->
                                    <form method="POST" action="{{ route('saveSelectedProduct') }}">
                                    @csrf
                                    <div class="modal fade text-left" id="confirmCart{{ $item->paperID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
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
                                                        {{ $item->paper_name }}
                                                    </div>
                                                    <div class="text-center text-danger">
                                                        Are you sure you want to add this item to cart?
                                                    </div>
                                                </div>
                                                <input type="hidden" value="{{ $item->paperID }}" name="product[]" class="form-control" />
                                                <input type="hidden" value="paper" name="productType" class="form-control" />

                                                <div class="modal-footer">
                                                    <button type="button" class="btn grey btn-outline-primary mt-3" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-outline-success p-2 mt-3"> <i class="fa fa-shopping-cart"></i>  Add </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <!--end Modal-->

                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div> <!-- row -->
            @if(($getPapers instanceof \Illuminate\Pagination\AbstractPaginator))
            <div align="right" class="col-md-12"><hr />
                Showing {{($getPapers->currentpage()-1)*$getPapers->perpage()+1}}
                    to {{$getPapers->currentpage()*$getPapers->perpage()}}
                    of  {{$getPapers->total()}} entries
                </div>
            <div class="d-print-none">{{ $getPapers->links() }}</div>
            @endif
        </div> <!-- container -->
    </section>

@endsection
