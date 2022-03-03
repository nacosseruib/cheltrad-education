@extends('layout.app')
@section('pageTitle', 'About Cheltrad Education')
@section('activePageAbout', 'active')
@section('content')

    <section id="about-page">
        <div class="container about-one mt-140 mb-50">
                    
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center pb-25">
                        <h2> Frequently Asked <span> Questions</span></h2>
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
			@if(isset($allFaq))
				<div class="accordion toggle-icons lg" id="toggleIcons">
				    @foreach($allFaq as $faqKey=>$listFaq)
						<div class="accordion-container">
							<div class="accordion-header alert alert-secondary p-3 pb-0" id="toggleIcons{{$listFaq->faqID}}"> 
								<a  href="#" class="text-dark text-uppercase {{ ($faqKey == 0 ? '' : 'collapsed') }}" data-toggle="collapse" data-target="#toggleIconsCollapse{{$listFaq->faqID}}" aria-expanded="true" aria-controls="toggleIconsCollapse{{$listFaq->faqID}}">
									<b>{{ $listFaq->title }}</b>
								</a>
							</div>
							<div id="toggleIconsCollapse{{$listFaq->faqID}}" class="p-2 pt-0 collapse {{ ($faqKey == 0 ? 'show' : '') }}" aria-labelledby="toggleIcons{{$listFaq->faqID}}" data-parent="#toggleIcons">
								<div class="accordion-body">
									<p>
									    {!! $listFaq->information !!}
									</p>
								</div>
							</div>
						</div>
					@endforeach
                </div>
            @endif
						

        </div>
    </section>

@endsection
