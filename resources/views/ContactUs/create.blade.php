@extends('layout.app')
@section('pageTitle', 'Contact Us')
@section('activePageContact', 'active')
@section('content')

    <section id="contact-page" class="pt-95 pb-130">
        <div class="container">
            <div class="contact-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-info text-center mt-30">
                            <div class="info-icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="info-content mt-15">
                                <p>07861729961</p>
                            </div>
                        </div> <!-- single info -->
                    </div>
                    <div class="col-md-4">
                        <div class="single-info text-center mt-30">
                            <div class="info-icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="info-content mt-15">
                                <p>info@cheltrad.co.uk</p>
                            </div>
                        </div> <!-- single info -->
                    </div>
                    <div class="col-md-4">
                        <div class="single-info text-center mt-30">
                            <div class="info-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="info-content mt-15">
                                <p>Cheltrad Education
                                    102 Heath Road
                                    Chadwell Heath
                                    Romford
                                    London
                                    RM6 6LH</p>
                            </div>
                        </div> <!-- single info -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
            <div class="contact-form-map pt-0"><hr />
                <div class="row">
                    <div class="col-md-12">
                        @include('ShareView.operationCallBackAlert')
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form mt-50">
                            <form  action="{{ route('postContact') }}" method="post">
                                <div class="single-form form-group">
                                    <input name="name" value="{{  old('name') }}" type="text" placeholder="Name" data-error="Name is required.">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single-form -->
                                <div class="single-form form-group">
                                    <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" data-error="Valid email is required." required="required">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single-form -->
                                <div class="single-form form-group">
                                    <input name="number" type="phone" value="{{ old('number') }}" placeholder="Mobile Number" data-error="Valid mobile number is required.">
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single-form -->
                                <div class="single-form form-group">
                                    <textarea name="message" placeholder="Message" data-error="Please, leave us a Message." required="required">{{ old('message') }}</textarea>
                                    <div class="help-block with-errors"></div>
                                </div> <!-- single-form -->

                                <div class="single-form">
                                    <button type="submit" class="main-btn">Send</button>
                                </div> <!-- single-form -->
                            </form>
                        </div> <!-- contact-form -->
                    </div>
                    <div class="col-lg-6">
                        <div class="map mt-50">
                            <div>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2479.958746730012!2d0.13441035115130398!3d51.56898977954537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a4599448197d%3A0x1cdb6fcb0b96a7ac!2s102%20Heath%20Rd%2C%20Chadwell%20Heath%2C%20Dagenham%2C%20Romford%20RM6%206LH%2C%20UK!5e0!3m2!1sen!2sng!4v1592981065128!5m2!1sen!2sng" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div> <!-- map -->
                    </div>
                </div> <!-- row -->
            </div> <!-- contact info -->
        </div> <!-- container -->
    </section>

@endsection
