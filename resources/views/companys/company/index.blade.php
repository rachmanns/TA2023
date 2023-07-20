@extends('partials.template')
@section('main')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Company</div>
                    <div class="card-body">
                        <a href="{{ url('/companys/create') }}" class="btn btn-success btn-sm" title="Add New company">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/companys') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="feather" data-feather="search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive-xl">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nohp</th>
                                        {{-- <th>email</th> --}}
							            {{-- <th>website</th> --}}
                                        <th>Actions</th>   
                                        <th colspan="2"></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($company as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td style="width: 20%">{{ $item->telepon }}</td>
                                        {{-- <td>{{ $item->email }}</td> --}}
							            {{-- <td>{{ $item->website }}</td> --}}
                                        <td colspan="2">
                                                <a href="{{ url('/companys/view/' . $item->id) }}" title="View company"><button class="btn btn-icon btn-icon rounded-circle btn-flat-success waves-effect">
                                                                                                    
                                                    <i class="feather" data-feather="search" aria-hidden="true"></i></button></a>
    
                                                <a href="{{ url('/companys/edit/' . $item->id) }}" title="Edit company"><button class="btn btn-icon btn-icon rounded-circle btn-flat-primary waves-effect">
                                                                                                    
                                                    <i class="feather" data-feather="edit" aria-hidden="true"></i></button></a>
                                                
                                                <a href="{{ url('/companys/delete/' . $item->id) }}" title="Delete company"><button class="btn btn-icon btn-icon rounded-circle btn-flat-danger waves-effect" onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                    {{ method_field('DELETE') }}
                                                    {{ csrf_field() }}
                                                                                                    
                                                    <i class="feather" data-feather="delete" aria-hidden="true"></i></button></a>
                                        </td>
                                            {{-- <form method="POST" action="{{ url('/companys/delete' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete company" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> --}}
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $company->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
