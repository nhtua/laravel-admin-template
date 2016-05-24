@extends('layouts.backend')

@section('title','Role manager')

@push('custom-style')
    <link href="{{asset('/backend/css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('/backend/css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">
@endpush

<?php 
    $textLabels = App\Models\Role::getLabels();
?>

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            @include('common.breadcrumb', ['links'=>[],'current'=> 'Role manager'])
        </div>

        <div class="title_right">
            <div class="col-md-2 col-sm-2 col-xs-4 form-group pull-right top_search">

            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List of all Roles</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                            <a href="#"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" id="tableXContent">
                    @include('common.flash')
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th class=""><input type="checkbox" class="tableflat" id="checkAll"></th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12">{{$textLabels['name']}}</th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12">{{$textLabels['display_name']}}</th>
                                <th class="col-lg-6 col-md-6 col-sm-6 col-xs-12">{{$textLabels['description']}}</th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12 no-link last"><span class="nobr">Function</span></th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $key => $role)
                            <tr class="{{ $key%2 ? 'odd' : 'even' }} pointer" id="item{{$role->id}}">
                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>
                                <td class=" ">
                                    <a href="{{route('backend::role.edit',[$role->id])}}"><strong>{{$role->name}}</strong></a>
                                </td>
                                <td class=" ">{{$role->display_name}}</td>
                                <td class=" ">{{$role->description}}</td>
                                <td class=" last">
                                    <a href="{{route('backend::role.edit', [$role->id])}}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach                   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')    
    <!-- icheck -->
    <script src="/backend/js/icheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="/backend/js/datatables/js/jquery.dataTables.js"></script>
    <script src="/backend/js/datatables/tools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript">
        $(function(){
            setupDataTable('#example');
        });
    </script>

@endpush