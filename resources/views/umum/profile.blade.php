@extends('partials.template')

@section('page_style')
<style>
    .msg[data-text="Profil berhasil diubah"]{
        color: #28c76f;
    }

    .msg[data-text="Profil gagal diubah"]{
        color: #ea5455; 
    }
</style>
@endsection

@section('main')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left">Edit Profile</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                          <form method="post" action="/profile" enctype="multipart/form-data">
                            @if(session('msg'))<div class="pl-2 pt-2 pr-2 msg"><b>{{ session('msg') }}</b></div>@endif
                            <div class="card-body"> 
                                <div class="form-group form-input">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="email" name="email" id="username" class="form-control @error('email') is-invalid @enderror" value="@error('email') {{old('email')}} @else {{Auth::user()->email}} @enderror" placeholder="Username" required />
                                    <div class="invalid-feedback">@error('email') {{ $message }} @enderror</div>
                                </div>   
                                <div class="form-group form-input">
                                    <label class="form-label" for="fullName">Nama</label>
                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" id="fullName" value="@error('nama'){{old('nama')}}@else{{Auth::user()->name}}@enderror" required />
                                    <div class="invalid-feedback">@error('nama') {{ $message }} @enderror</div>
                                </div>
                                <div class="form-group form-input">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                                    <div class="col-md-2 col-lg-2 mobile-centered">
                                        <img id="imgProfil" height="181" src="{{ file_exists('app-assets/images/profile/user-uploads/' . base64_encode(Auth::user()->id) . '.png') ? url('app-assets/images/profile/user-uploads/' . base64_encode(Auth::user()->id) . '.png') : url('app-assets/images/pages/eCommerce/personil.png') }}" alt="Profile">
                                        <div class="text-center pt-1">
                                            <a href="#" class="btn btn-primary btn-sm" title="Ganti profil image" onclick="chooseImg()"><i data-feather='image' class='font-medium-4'></i></a>
						                    <input type="file" name="imgFile" id="imgFile" style="display:none" accept='image/*' onchange="previewImg(this)" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="newPassword">Password Baru (isi jika ingin mengganti password)</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" />
                                    <div class="invalid-feedback">@error('password') {{ $message }} @enderror</div>
                                </div>
                                <div class="form-group form-input">
                                    <label class="form-label" for="renewPassword">Konfirmasi Password Baru (isi jika ingin mengganti password)</label>
                                    <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="renewPassword" />
                                    <div class="invalid-feedback">@error('password_confirmation') {{ $message }} @enderror</div>
                                </div>   
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
                            @csrf
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('page_script')
    <script>
		function chooseImg() {
			document.getElementById('imgFile').click();
		}
		function previewImg(obj) {
			document.getElementById('imgProfil').src = URL.createObjectURL(obj.files[0]);
		}

        let elemento= document.querySelectorAll(".msg")
        elemento.forEach(e => e.dataset.text= e.textContent )

    </script>
@endsection