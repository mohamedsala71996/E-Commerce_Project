<x-front-layout title='login'>
    <x-slot name='breadcrumbs'>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Login</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="index.html"><i class="lni lni-home"></i> Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot>

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>
                            <div class="social-login">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn facebook-btn"
                                            href="javascript:void(0)"><i class="lni lni-facebook-filled"></i> Facebook
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn twitter-btn"
                                            href="javascript:void(0)"><i class="lni lni-twitter-original"></i> Twitter
                                            login</a></div>
                                    <div class="col-lg-4 col-md-4 col-12"><a class="btn google-btn"
                                            href="javascript:void(0)"><i class="lni lni-google"></i> Google login</a>
                                    </div>
                                </div>
                            </div>
                            <div class="alt-option">
                                <span>Or</span>
                            </div>
                            <div class="form-group input-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="text" name="{{config('fortify.username')}}"
                                    :value="old(config('fortify.username'))" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group input-group">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" class="form-control" type="password" name="password"
                                    required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" name='remember' vlaue='1' id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                @if(Route::has('password.request'))
                                <a class="lost-pass" href="{{route('password.request')}}">Forgot password?</a>
                                @endif
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Login</button>
                            </div>
                            @if(Route::has('register'))
                            <p class="outer-link">Don't have an account? <a href="{{route('register')}}">Register here </a>
                            @endif
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
