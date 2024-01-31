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
                            <li>2FA</li>
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
                    <form class="card login-form" method="POST" action="{{ route('two-factor.login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA</h3>
                            </div>
                            <div class="form-group input-group">
                                <x-input-label for="code" :value="__('code')" />
                                <x-text-input id="code" class="form-control" type="text" name="code"
                                    :value="old('code')" autofocus autocomplete="code" />
                                <x-input-error :messages="$errors->get('code')" class="mt-2" />
                            </div>
                            <div class="form-group input-group">
                                <x-input-label for="recovery_code" :value="__('recovery code')" />
                                <x-text-input id="recovery_code" class="form-control" type="text" name="recovery_code"
                                    :value="old('recovery_code')" autofocus autocomplete="recovery_code" />
                                <x-input-error :messages="$errors->get('recovery_code')" class="mt-2" />
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
