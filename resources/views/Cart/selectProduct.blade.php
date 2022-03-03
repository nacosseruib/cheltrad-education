@extends('layout.app')
@section('pageTitle', 'Select Product')
@section('content')

<div class="container mt-130 mb-3">
    <form method="POST" action="{{ route('saveSelectedProduct') }}">
    @csrf
    <div class="row bg-light m-3">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="text-center" style="padding: 10% 5px; padding-bottom: 2px;">
                <div class="mb-3 bg-light" >
                        <div class="p-2">
                            <h3>
                                <span class="text-warning fa fa-shopping-basket"></span>
                                Add more product to cart
                            </h3>
                        </div>
                        <h4 class="mt-3 text-info">
                            Our Courses to Success at affordable prices.
                            Parents can book all courses at a time.
                        </h4>
                </div>
            </div>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div align="center">
                <img src="{{ asset('assets/images/bg/software-001.jpg') }}" alt=" "/>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($getPapers))
            @foreach ($getPapers as $key=>$item)
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="row bg-light singel-services m-1 p-1" style="min-height: 120px;">
                        <div class="col-lg-1 col-md-1" >
                            <input type="hidden" value="paper" name="productType" class="form-control" />
                            <input type="checkbox" value="{{ $item->paperID }}" name="product[]" class="form-control" />
                        </div>
                        <div class="col-lg-1 col-md-1" >
                            <span class="text-warning fa fa-shopping-basket fa-2x"></span>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="">{{ ucfirst($item->paper_name) }}</div>
                            <div class="text-danger">{{ $item->category_name .' - '. $item->course_name }}</div>
                        </div>
                        <div class="col-lg-2 col-md-2 text-center">
                            <span class="text-danger fa fa-euro fa-1x"> {{ (is_numeric($item->price) ? number_format(($item->price), 2) : $item->price) }} </span>
                            <small><i class="text-success">Available</i></small>
                        </div>
                        <div class="col-lg-1 col-md-1" >
                            <span class="text-success fa fa-star fa-2x"></span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <div align="center" class="col-md-12 m-1 p-1">
            <hr />
            <button class="btn btn-outline-warning"> <i class="fa fa-shopping-basket"></i>  Add & View Cart</button>
        </div>

    </div>
    </form>
</div>

@endsection
