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
                            <h2 class="float-left mb-0">Edit Role</h2>
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

                        <form method="POST" action="{{ url('/roles/perm/store/' . $role->id) }}" accept-charset="UTF-8"
                            class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('roles.role.form', ['formMode' => 'edit'])
                            {{-- {{ method_field('PATCH') }} --}}
                            <legend>
                                <span>
                                    <h4 class="mb-2">Assign Permissions</h4>
                                </span>
                            </legend>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label class="custom-control-label" for="select-all"><b>Select All</b></label>
                            </div>

                            <div class='form-group'>
                                <div class="row">
                                    @php
                                        $i=0;                                    
                                        
                                        foreach($permissions as $p){

                                        $temp=array();
                                        $temp=explode(",",$p->name);
                                        $temp[1]=str_replace("{$temp[0]}_","",$p->name);
                                        $permissions_list['group'][$i]            = $temp[1];
                                        $permissions_list['function'][$temp[1]][] = ['name'=>$temp[0],'id'=>$p->id];
                                        $permissions_list['id'][$temp[1]][]       = $p->name;
                                        $i++;
                                        }
                
                                        $permissions_list['group']=array_unique($permissions_list['group']);
                                        $listIdCheckbox = "";

                                        foreach ($permissions_list['group'] as $val) {
                                        echo'<div class="col-sm-4">
                                            
                                        <br/>';

                                        foreach ($permissions_list['function'][$val] as $index => $value) {
                                        
                                            echo ' 
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" onclick="togglePermission()"'.' class="custom-control-input" id="'.$permissions_list['function'][$val][$index]['name'].$i.'" name="permission_id[]" value="'.$value['id'].'">
                                                <label class="custom-control-label" for="'.$permissions_list['function'][$val][$index]['name'].$i.'">'.$value['name'].'</label>
                                            </div>';
                                            $listIdCheckbox = strval($permissions_list['function'][$val][$index]['name'].$i).'|'.$listIdCheckbox;
                                            
                                            $i++;
                                        }
                                        
                                        echo'</div>';
                                        }
                                    @endphp
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
