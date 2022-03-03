@extends('layout.app')
@section('pageTitle', 'Sample Papers')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg" style="background-image: url({{ asset('assets/images/bg/software-15.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h2>Our Free <span> Sample Papers</span></h2>
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
                @if(isset($getPapers) and $getPapers)
                    @foreach($getPapers as $key=>$item)
                        <div class="col-lg-4 col-md-6 col-sm-10">
                            <div class="singel-services mb-5">
                                <div class="text-center mt-30 mb-5" style="height: 250px;">
                                    <div class="icon">
                                        <i class="flaticon-open-book"></i>
                                    </div>
                                    <div class="cont">
                                        <h4 class="services-title">{{ $item->paper_name }}</h4>
                                        <img src="{{ (isset($paperPath) ? $paperPath . $item->file_name : null) }}" alt=" " width="100" height="100" />
                                        <p class="text-justify">
                                            {!! substr(strip_tags($item->description), 0, 100) !!}...
                                        </p>
                                    </div>
                                </div> <!-- singel-services -->
                                <div align="center">
                                <h5 class="text-info text-uppercase">{{ $item->type_name }}</h5>
                                <hr />
                                    <a href="#" class="btn btn-success btn-outline-success text-white"> View More <i class="fa fa-angle-right"></i></a>
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
        </div> <!-- container -->
    </section>

@endsection
