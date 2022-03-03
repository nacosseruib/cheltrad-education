@extends('layout.app')
@section('pageTitle', 'Full Practice Papers')
@section('activePageServices', 'active')
@section('content')

    <section id="services-part" class="mt-100 pt-40 pb-20 gray-bg img-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center pb-25">
                        <h2> Full Practice Papers With <span> Detailed Answers</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
            @include('AllPaper.paperShareView')
        </div> <!-- container -->
    </section>

@endsection
