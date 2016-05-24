@extends('layouts.backend')

@section('title','User manager')

@push('custom-style')
    <link href="{{asset('/backend/css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('/backend/css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">
@endpush

<?php 
    $textLabels = App\Models\User::getLabels();
?>

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            @include('common.breadcrumb', ['links'=>[],'current'=> 'User manager'])
        </div>

        <div class="title_right">
            <div class="col-md-2 col-sm-2 col-xs-4 form-group pull-right top_search">
                <div class="input-group">
                   <a href="{{route('backend::user.add')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add user</a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>List of all users</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('backend::user.home')}}">Danh sách tài khoản</a>
                                </li>
                                <li><a href="{{route('backend::user.jail')}}">Danh sách đã khóa</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-close"></i></a>
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
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12">{{$textLabels['avatar']}}</th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12">{{$textLabels['name']}}</th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12">{{$textLabels['email']}}</th>
                                <th class="col-lg-4 col-md-4 col-sm-6 col-xs-12">{{$textLabels['created_at']}}</th>
                                <th class="col-lg-2 col-md-2 col-sm-6 col-xs-12 no-link last"><span class="nobr">Function</span></th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach ($users as $key => $user)
                            <tr class="{{ $key%2 ? 'odd' : 'even' }} pointer" id="item{{$user->id}}">
                                <td class="a-center ">
                                    <input type="checkbox" class="tableflat">
                                </td>
                                <td class=" ">
                                    <a href="{{route('backend::user.edit',[$user->id])}}"><img src="{{$user->getThumbBySize(128, 'avatar')}}" width="128"></a>
                                </td>
                                <td class=" "><a href="{{route('backend::user.edit',[$user->id])}}">{{$user->name}}</a></td>
                                <td class=" ">{{$user->email}}</td>
                                <td class=" ">{{date_format(date_create($user->created_at), 'm/d/Y H:i:s')}}</td>
                                <td class=" last">
                                    <a href="{{route('backend::user.edit', [$user->id])}}" class="btn btn-primary btn-xs">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    @if( $user->status != App\Models\User::STT_INACTIVE )
                                        <a onclick="deleteItem('{{route('backend::user.lock')}}',{{$user->id}})" class="btn btn-danger btn-xs">
                                            <i class="fa fa-ban"></i> Ban
                                        </a>
                                    @else 
                                        <a href="{{route('backend::user.unlock',[$user->id])}}?_token={{csrf_token()}}" class="btn btn-success btn-xs">
                                            <i class="fa fa-unlock"></i> Unlock
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach                   
                        </tbody>
                    </table>
                    @include('common.paging',['data'=>$users])
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
            setupDataTable('#example',{
                "bPaginate": false,
                "bInfo" : false,
                'iDisplayLength': -1
            });
        });
    </script>

@endpush