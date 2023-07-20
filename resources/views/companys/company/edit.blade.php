@extends('partials.template')
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit company #{{ $company->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/companys/index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/companys/update/' . $company->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{-- {{ method_field('PATCH') }} --}}
                            {{ csrf_field() }}

                            @include ('companys.company.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
