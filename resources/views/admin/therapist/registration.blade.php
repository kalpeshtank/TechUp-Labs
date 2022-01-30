
<?php

use Request as Input;
?>
@extends('layouts.app')
@section('content')
<div class="kt-login__container">
    <div class="kt-login__signin">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Therapist Registration</h3>
        </div>
        <form method="POST" action="{{ route('registration-therapist') }}" accept-charset="UTF-8" class="kt-form" id="login" name="login" enctype="multipart/form-data" novalidate="novalidate">
            @csrf
            @include('errormessage')            
            <div class="form-group fv-plugins-icon-container">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter Name"> 
            </div>
            <div class="form-group fv-plugins-icon-container">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Enter Email"> 
            </div>
            <div class="form-group fv-plugins-icon-container">
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number" required placeholder="Enter Phone Number"> 
            </div>
            <div class="form-group fv-plugins-icon-container">
                <select class="form-control" id="state" name="state">
                    <option value="">Select State</option>
                    @foreach($state as $val)
                    <option value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group fv-plugins-icon-container">
                <select class="form-control" id="country" name="country">
                    <option value="" >Select Country</option>
                    @foreach($country as $val)
                    <option value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group fv-plugins-icon-container">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> 
            </div>
            <div class="form-group text-left px-8 fv-plugins-icon-container">
                <div class="checkbox-inline">
                    @foreach($services as $val)
                    <label class="checkbox checkbox-outline checkbox-white text-white m-0">
                        <input type="checkbox" name="services[]" value="{{$val->id}}"> {{$val->name}}
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="kt-login__actions">
                <button type="submit" id="kt_login_signin_submit1" class="btn btn-pill kt-login__btn-primary">Sign Up</button>
                <a href="{{ route('login') }}" class="btn btn-pill kt-login__btn-primary">Sign In</a>
            </div>
        </form>
    </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.kt-form').validate({// initialize the plugin            
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                phone_number: {
                    required: true,
                },
                state: {
                    required: true,
                },
                country: {
                    required: true,
                },
                password: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection