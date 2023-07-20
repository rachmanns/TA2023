@extends('partials.template')
@section('main')
<div class="app-content content ">
    <div class="container">
        <div class="row">
            {{-- @include('admin.sidebar') --}}

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">company {{ $company->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/companys/index/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        {{-- <a href="{{ url('/admin/company/' . $company->id . '/edit') }}" title="Edit company"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/company' . '/' . $company->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete company" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form> --}}
                        <br/>
                        <br/>

                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $company->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Email </th>
                                        <td> {{ $company->email }} </td>
                                    </tr>
                                    <tr>
                                        <th> Website </th>
                                        <td> {{ $company->website }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
