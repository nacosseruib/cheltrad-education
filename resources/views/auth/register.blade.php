@extends('layout.app')
@section('pageTitle', 'Sign up as a new member')
@section('content')

    <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="container register mt-10 mb-4">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                        <h3>Welcome</h3>
                        <p>At Cheltrad education, we adopt the best available approach to education. </p>
                        <a href="{{ route('login') }}" class="btn btn-light mt-5 btn-block rounded">Login</a><br/>
                    </div>
                    <div class="col-md-9 register-right">
                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Privacy</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Register as a new subscriber</h3>

                                <div class="row register-form">
                                    <div class="col-md-12">@include('ShareView.operationCallBackAlert')</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" required placeholder="First Name *" name="firstName" value="{{ old('firstName') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Last Name " name="lastName" value="{{ old('lastName') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" required name="username" value="{{ old('username') }}" placeholder="Account Username *"  />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" required placeholder="Account Password *" name="password" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" required name="password_confirmation" placeholder="Confirm Account Password *"  />
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" required placeholder="Your Email *" name="email" value="{{ old('email') }}" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" minlength="10" maxlength="15" name="phoneNumber" class="form-control" placeholder="Your Phone (optional)" value="{{ old('phoneNumber') }}" />
                                        </div>
                                        <div class="form-group">
                                            <div class="maxl form-control">
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" required value="male" checked>
                                                    <span> Male </span>
                                                </label> &nbsp;&nbsp;
                                                <label class="radio inline">
                                                    <input type="radio" name="gender" required value="female">
                                                    <span>Female </span>
                                                </label>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <select required class="form-control" name="category">
                                                <option value="" >Select A Category *</option>
                                                <option value="">Secondry Level</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select required class="form-control" name="course">
                                                <option value="">Select Course *</option>
                                                <option value="">English</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <select required class="form-control" name="subscriptionType">
                                                <option value="">Select Subscription Type *</option>
                                                <option value="">All Packages</option>
                                                <option value="">English</option>

                                            </select>
                                        </div>-->

                                        <input type="submit" class="btn btn-success btn-outline-success btn-block"  value="Save &amp; Proceed"/>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <h3  class="register-heading">Our Terms & Conditions</h3>
                                <div class="row register-form">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-control">
                                                Our terms and conditions here...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
@endsection

@section('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style>
    .register{
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        margin-top: 3%;
        padding: 3%;
    }
    .register-left{
        text-align: center;
        color: #fff;
        margin-top: 4%;
    }
    .register-left input{
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        width: 60%;
        background: #f8f9fa;
        font-weight: bold;
        color: #383d41;
        margin-top: 30%;
        margin-bottom: 3%;
        cursor: pointer;
    }
    .register-right{
        background: #f8f9fa;
        border-top-left-radius: 10% 50%;
        border-bottom-left-radius: 10% 50%;
    }
    .register-left img{
        margin-top: 15%;
        margin-bottom: 5%;
        width: 25%;
        -webkit-animation: mover 2s infinite  alternate;
        animation: mover 1s infinite  alternate;
    }
    @-webkit-keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    @keyframes mover {
        0% { transform: translateY(0); }
        100% { transform: translateY(-20px); }
    }
    .register-left p{
        font-weight: lighter;
        padding: 12%;
        margin-top: -9%;
    }
    .register .register-form{
        padding: 10%;
        margin-top: 10%;
    }
    .btnRegister{
        float: right;
        margin-top: 10%;
        border: none;
        border-radius: 1.5rem;
        padding: 2%;
        background: #0062cc;
        color: #fff;
        font-weight: 600;
        width: 50%;
        cursor: pointer;
    }
    .register .nav-tabs{
        margin-top: 3%;
        border: none;
        background: #0062cc;
        border-radius: 1.5rem;
        width: 28%;
        float: right;
    }
    .register .nav-tabs .nav-link{
        padding: 2%;
        height: 34px;
        font-weight: 600;
        color: #fff;
        border-top-right-radius: 1.5rem;
        border-bottom-right-radius: 1.5rem;
    }
    .register .nav-tabs .nav-link:hover{
        border: none;
    }
    .register .nav-tabs .nav-link.active{
        width: 100px;
        color: #0062cc;
        border: 2px solid #0062cc;
        border-top-left-radius: 1.5rem;
        border-bottom-left-radius: 1.5rem;
    }
    .register-heading{
        text-align: center;
        margin-top: 8%;
        margin-bottom: -15%;
        color: #495057;
    }
</style>

@endsection

@section('scripts')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
@endsection
