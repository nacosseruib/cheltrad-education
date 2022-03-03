@extends('layout.app')
@section('pageTitle', 'View Cart')
@section('content')

<div class="container mt-130 mb-1">
    <form>
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div class="section-title text-center pb-15">
                    <h3 class="pb-3">
                        <span class="text-warning fa fa-shopping-basket"></span>
                        View Cart
                    </h3>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="container-fluid">
	    <div class="row">
	        <aside class="col-lg-9">
	            <div class="card">
	                <div class="table-responsive">
	                    <table class="table table-borderless table-shopping-cart">
	                        <thead class="text-muted">
	                            <tr class="small text-uppercase">
                                    <th scope="col">SN</th>
                                    <th scope="col">Product</th>
	                                <th scope="col">Quantity</th>
	                                <th scope="col" width="80">Price</th>
	                                <th scope="col" class="text-right d-none d-md-block"></th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @if(isset($getCart))
                                    @php
                                        $totalPrice = 0.00;
                                        $totalDiscount = 0.00;
                                    @endphp
                                    @foreach ($getCart as $key=>$item)
                                        <tr>
                                            <td>{{ (1 + $key) }} </td>
                                            <td>
                                                <figure class="itemside align-items-center">
                                                    @if($item->cover_image <> null)
                                                    <div class="aside">
                                                        <img src="{{ $coverPath . $item->cover_image }}" alt=" " class="img-sm">
                                                    </div>
                                                    @endif
                                                    <figcaption class="info">
                                                        <a href="#" class="title text-dark" data-abc="true">{{ $item->paper_name }}</a>
                                                        <p class="text-muted small">
                                                            CATEGORY: {{ $item->category_name }} <br>
                                                            COURSE: {{ $item->course_name }}
                                                        </p>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td class="text-center">
                                                1
                                                <!--<select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select> -->
                                            </td>
                                            <td>
                                                <div class="price-wrap text-center">
                                                    <var class="price">{{ (is_numeric($item->price) ? number_format(($item->price), 2) : $item->price) }}</var>
                                                    <small class="text-muted">Discount: {{ (is_numeric($item->discount) ? number_format(($item->discount), 2) : $item->discount) }} </small>
                                                </div>
                                            </td>
                                            <td class="text-right d-none d-md-block">
                                                <button type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmRemoveCart{{ $item->cartID }}"  title="Remove Cart" data-abc="true" class="btn btn-danger btn-sm">Remove</button>
                                            </td>
                                        </tr>
                                        @php
                                            $totalPrice += $item->price;
                                            $totalDiscount += $item->discount;
                                        @endphp
                                        <tr>
                                            <td colspan="5"><hr class="mt-0 mb-0"></td>
                                        </tr>

                                        <!--remove modal-->
                                        <div class="modal fade text-left" id="confirmRemoveCart{{ $item->cartID }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <h4 class="modal-title" id="myModalLabel12"><i class="fa fa-trash"></i> Remove Item  </h4>
                                                        <button id="hideCloseWhenTimeUp2" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div align="center">
                                                            @if($item->cover_image <> null)
                                                            <img src="{{ $coverPath . $item->cover_image }}" alt=" " class="img-sm">
                                                            @endif
                                                        </div>
                                                        <div class="text-center text-info">
                                                            {{ $item->paper_name }}
                                                        </div>
                                                        <div class="text-center text-danger">
                                                            Are you sure you want to remove this item from your cart?
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn grey btn-outline-primary mt-3" data-dismiss="modal">Close</button>
                                                        <a href="{{ route('removeCart', ['id' => base64_encode($item->cartID) ]) }}" class="btn btn-outline-danger changeStatus p-2 mt-3"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end Modal-->

                                    @endforeach
                                @endif

	                        </tbody>
	                    </table>
	                </div>
	            </div>
	        </aside>
	        <aside class="col-lg-3">

	            <div class="card mb-3">
	                <div class="card-body">
	                    <form>
	                        <div class="form-group"> <label>Have coupon?</label>
	                            <div class="input-group"> <input type="text" class="form-control coupon" name="" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	            <div class="card">
	                <div class="card-body">
	                    <dl class="dlist-align">
	                        <dt>Total price:</dt>
	                        <dd class="text-right ml-3 pull-right">{{ (is_numeric($totalPrice) ? number_format(($totalPrice), 2) : $totalPrice) }}</dd>
	                    </dl>
	                    <dl class="dlist-align">
	                        <dt>Discount:</dt>
	                        <dd class="text-right text-danger ml-3 pull-right"> {{ (is_numeric($totalDiscount) ? number_format(($totalDiscount), 2) : $totalDiscount) }}</dd>
	                    </dl>
	                    <dl class="dlist-align p-1 text-white" style="background: #969696">
	                        <dt>Total:</dt>
	                        <dd class="text-right text-white b ml-3 pull-right"><strong>{{ number_format(($totalPrice - $totalDiscount), 2) }}</strong></dd>
	                    </dl>
                        <hr>
                        @if(isset($getCart) && $getCart <> null)
                            <a href="{{ route('checkOutStripe') }}" class="btn btn-out btn-outline-warning text-white bg-warning btn-square btn-main" data-abc="true">
                                <i class="fa fa-paypal"></i> CheckOut now
                            </a>
                        @endif
                        <a href="{{ route('saveSelectedProduct') }}" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">
                            <i class="fa fa-shopping-basket"></i> Add More Product
                        </a>
	                </div>
	            </div>
	        </aside>
        </div>
        <div align="center" class="m-2">
            <a href="{{ route('viewCart') }}" class="btn btn-outline-warning">
                <i class="fa fa-shopping-basket"></i>
                Update Cart <i class="fa fa-refresh"></i>
            </a>
        </div>
	</div>
    </form>

</div>

@endsection

@section('styles')
    <style>
         @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        .container-fluid {
            margin-top: 70px
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.40rem
        }

        .img-sm {
            width: 80px;
            height: 80px
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .table-shopping-cart .price-wrap {
            line-height: 1.2
        }

        .table-shopping-cart .price {
            font-weight: bold;
            margin-right: 5px;
            display: block
        }

        .text-muted {
            color: #969696 !important
        }

        a {
            text-decoration: none !important
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .dlist-align {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        [class*="dlist-"] {
            margin-bottom: 5px
        }

        .coupon {
            border-radius: 1px
        }

        .price {
            font-weight: 600;
            color: #212529
        }

        .btn.btn-out {
            outline: 1px solid #fff;
            outline-offset: -5px
        }

        .btn-main {
            border-radius: 2px;
            text-transform: capitalize;
            font-size: 15px;
            padding: 10px 19px;
            cursor: pointer;
            color: #fff;
            width: 100%
        }

        .btn-light {
            color: #ffffff;
            background-color: #F44336;
            border-color: #f8f9fa;
            font-size: 12px
        }

        .btn-light:hover {
            color: #ffffff;
            background-color: #F44336;
            border-color: #F44336
        }

        .btn-apply {
            font-size: 11px
        }
    </style>
@endsection

@section('scripts')
    <script>

    </script>

@endsection
