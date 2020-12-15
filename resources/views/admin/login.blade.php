@extends('admin.layouts.admin')
@section('maincontent')
<div class="login">
    <div class="container">
        <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="" src="{{ asset('admin/assets/img/logo-white.png') }}" class="admin-logo">
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x -mt-16" src="{{ asset('admin/assets/img/work.svg') }}">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign in to your account. 
                        </div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen flex">
                            <a href="{{ route('customer.register') }}">Register Customer</a>
                    <div class="my-auto mx-auto bg-white loginArea">
                        <h2 class="loginHeader">
                            {{ __('Login') }}
                        </h2>
                        <div class="intro-x mt-8">
                            <form method="POST" action="{{ route('admin.login') }}">
                            @csrf

                            <div>
<!--                                 <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                                <div class="wrap-input100 m-b-16">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" autofocus>
                                    <span class="focus-input100"></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                <div class="wrap-input100 m-b-16">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                                    <span class="focus-input100"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-0">
                                <div>
                                    <button type="submit" class="button button--lg text-white bg-theme-1">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <!-- <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input type="checkbox" class="input border mr-2" id="remember-me">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="">Forgot Password?</a> 
                        </div> -->
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
    </div>
</div>
@stop
