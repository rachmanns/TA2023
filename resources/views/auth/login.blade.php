@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->
<div id="app" class="h-100">
    <div>
        <div class="auth-wrapper auth-v2">
            <div class="row auth-inner m-0">
                <!-- <div class="d-none d-lg-flex align-items-center p-5 col-lg-8" style="background-image: url({{ url('img/cover2.jpg')}}); background-position: right; background-size: contain; background-repeat: no-repeat">
                </div> -->

                <div class="d-none d-lg-flex col-lg-8 p-0">
                    <div class="w-100 d-lg-flex justify-content-center"><img class="img-fluid" src="{{ url('img/cover2.jpg')}}" alt="Login V2" /></div>
                </div>

                <div class="d-flex align-items-center auth-bg px-2 col-lg-4">
                    <!-- Login v1 -->
                    <div class="px-xl-2 mx-auto col-sm-8 col-md-6 col-lg-12">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ url('app-assets/images/ico/Logo.png')}}" height="70" />
                            </div>
                        
                            <form class="auth-login-form mt-4" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" placeholder="john@example.com" value="{{ old('email') }}" aria-describedby="login-email" tabindex="1" autofocus required autocomplete="email"/>
                                </div>

                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="login-password">Password</label>
                                        <a href="page-auth-forgot-password-v1.html">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror" id="login-password" required autocomplete="current-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember-me" tabindex="3" {{ old('remember') ? 'checked' : '' }}/>
                                        <label class="custom-control-label" for="remember-me"> Remember Me </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" tabindex="4" type="submit">Sign in</button>
                            </form>

                            <p class="text-center mt-2">
                            </p>

                            <div class="auth-footer-btn d-flex justify-content-center">
                            </div>
                        </div>
                    </div>
                    <!-- /Login v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection