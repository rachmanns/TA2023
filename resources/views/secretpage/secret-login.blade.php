@extends('partials.template')
@section('page_style')
<link rel="stylesheet" type="text/css" href="{{ url('app-assets/css/pages/page-auth.css')}}">
@endsection
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <div class="auth-wrapper auth-v1 px-2">
                <div class="auth-inner py-2">
                    <!-- Reset Password v1 -->
                    <div class="card mb-0">
                        <div class="card-body">

                            <a href="javascript:void(0);" class="brand-logo">
                                <img src="{{ url('img/lock.png')}}" height="42" />
                            </a>

                            <h4 class="card-title mb-1">Re-authenticate 🔒</h4>
                            <p class="card-text mb-2">Silahkan masukkan password anda kembali untuk mengakses halaman ini</p>
                     
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="p-2">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                            @endif
                            <form class="auth-reset-password-form mt-2" action="{{url('captcha-validation')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="reset-password-new">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input type="password" class="form-control form-control-merge" id="reset-password-new" name="secret_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" tabindex="1" autofocus required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2 justify-content-between">
                                        <label for="reset-password-new">Captcha</label>
                                    </div>
                                    <div class="form-group mb-1">
                                        <div class="captcha">
                                            <span>{!! captcha_img("flat") !!}</span>
                                            <button type="button" class="btn btn-icon btn-outline-danger " title="Reload Captcha" class="reload" id="reload">
                                                <i data-feather='refresh-ccw'></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required/>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block" tabindex="3">Submit</button>
                            </form>
                        </div>
                    </div>
                    <!-- /Reset Password v1 -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section("page_script")
<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection