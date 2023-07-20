@extends('partials.template')
@section('main')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="float-left mb-0">Permission Role</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <a href="{{ url('/roles/index') }}"><button type="button" class="btn btn-outline-primary"><i
                            class="ficon mr-75" data-feather="chevron-left"></i>Back</button></a>
            </div>
            <div class="content-body">
                {{-- @include('admin.sidebar') --}}
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/roles/perm/store') }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{-- {{ method_field('PATCH') }} --}}
                            {{ csrf_field() }}
                            <input type="hidden" name="role_id" value="{{ $roles->id }}">
                            {{-- @include ('users.user.form', ['formMode' => 'edit']) --}}
                            
                            <div class="custom-checkbox">
                                <div class="form-group">
                                    @foreach ($perm as $p)
                                        <input type="checkbox" name="permission_id[]" value="{{ $p->id }}">
                                        {{-- {{ Form::checkbox('roles[name]', $perm,[], array('class' => 'form-control','multiple')) }} --}}
                                        {{ Form::label($p->name, ucfirst($p->name)) }}<br>
                                    @endforeach
                                    {{-- {!! Form::select('roles[name]', $perm,[], array('class' => 'form-control','multiple')) !!} --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="submit">
                            </div>
                            {{-- <form method="POST" action="{{ url('/users/store/') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
    
                                @include ('users.user.form', ['formMode' => 'create'])
    
                            </form> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
