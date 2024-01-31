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
                    <form class="card login-form" method="POST" action="{{ route('two-factor.enable') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA</h3>
                                <p>You can enable/disable 2FA.</p>
                            </div>
                            <div class="button">
                                @if (!isset(Auth::user()->two_factor_secret))
                                    <button class="btn" type="submit">enable</button>
                                @else
                                    @method('delete')
                                    {{-- @if (session('status') == 'two-factor-authentication-enabled')
                                        <div class="mb-4 font-medium text-sm">
                                            Please finish configuring two factor authentication below.
                                        </div>
                                    @endif --}}
                                    <div class="mb-3">
                                        {!! Auth::user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <ul class="list-group">
                                        @foreach (Auth::user()->recoveryCodes() as $code)
                                            <li class="list-group-item">{{ $code }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn" type="submit">disable</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
