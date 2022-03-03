@extends('layout.app')
@section('pageTitle', 'About Cheltrad Education')
@section('activePageAbout', 'active')
@section('content')

    <section id="about-page">
        <div class="container">

            @include('ShareView.pageContentShare', ['showTitle'=> 0, 'showImage'=> 1])

        </div>
    </section>

@endsection
