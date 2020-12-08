@extends(getThemePath('layout.layout'))
@section('content')
@php
$is_superadmin=false;
    if(auth()->user()->cb_roles_id==1){
        $is_superadmin=true;
    }
@endphp
        <p>
            {{-- <a href="{{ action('AdminCoursesController@getIndex') }}"><i class="fa fa-arrow-left"></i> &nbsp; Back to Courses</a> --}}
        </p>
    <div class="box box-default">
        <div class="box-header with-border">
            <h1 class="box-title"><i class="fa fa-eye"></i> All Parent</h1>
            @if (session('success'))
                <div class="alert alert-info">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-tools pull-left" style="position: relative;margin-top: 5px;margin-left: 10px">
                        <button onclick="sendSms()" class="btn btn-primary btn-sm">Send Bulk SMS</button>
                    </div>
                    <div class="box-tools pull-right" style="position: relative;margin-top: 5px;margin-right: 10px">

                        <form method="get" style="display:inline-block;width: 260px;" action="{{request()->fullUrl()}}">
            
            <div class="input-group">
                <input type="text" name="q" value="{{request()->q}}" class="form-control input-sm pull-right" placeholder="Search">
                @if (request()->limit!=null)
                    <input type="hidden" name="limit" value="{{request()->limit}}">
                @endif
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        
                        <form method="get" id="form-limit-paging" style="display:inline-block" action="{{request()->fullUrl()}}">
                            @if (request()->q!=null)
                                <input type="hidden" name="q" value="{{request()->q}}">
                            @endif
                            @if (request()->city!=null)
                                <input type="hidden" name="city" value="{{request()->city}}">
                            @endif
                            @if (request()->location!=null)
                                <input type="hidden" name="location" value="{{request()->location}}">
                            @endif
                        
            
            <div class="input-group">
                <select onchange="$('#form-limit-paging').submit()" name="limit" style="width: 56px;" class="form-control input-sm">
                    @php
                        $limit=request()->limit;
                    @endphp
                    <option value="10">10</option>
                    <option @if($limit==20) selected @endif value="20">20</option>
                    <option @if($limit==25) selected @endif value="25">25</option>
                    <option @if($limit==50) selected @endif value="50">50</option>
                    <option @if($limit==100) selected @endif value="100">100</option>
                    <option @if($limit==200) selected @endif value="200">200</option>
                </select>
            </div>
        </form>
        
        </div>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <input onchange="chackboxChanged(this)" type="checkbox">
                            </th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Heard From</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parents as $parent)
                        <tr>
                            <td><input class="selector" data-id="{{$parent->id}}" type="checkbox"></td>
                            <td>{{$parent->id}}</td>
                            <td>{{$parent->name}}</td>
                            <td>{{$parent->email}}</td>
                            <td>{{$parent->phone}}</td>
                            <td>{{$parent->heard_from}}</td>
                            <td>
                                <a href="{{ action('AdminTutorsController@getSingle',[$parent->id]) }}"><button class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </button></a>
                                <a href="{{ action('AdminParentsController@getEdit',[$parent->id]) }}"><button class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button></a>
                                <a href="{{ action('AdminTutorsController@getSingle',[$parent->id]) }}"><button class="btn btn-info btn-sm">
                                    <i class="fa fa-envelope"></i>
                                </button></a>
                                @if ($is_superadmin)
                                <form style="display: inline" action="{{ action('AdminParentsController@postDelete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$parent->id}}">
                                    <button onclick="confirmDelete(this)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!!$parents->appends(request()->query())->links()!!}
            </div>
        </div>
    </div>
    <form id="bulk_sms_form" method="POST" action="{{ action('AdminTutorsController@postBulkSms') }}">
        @csrf
        <input type="hidden" id="ids" name="ids">
    </form>
    <script>
        function confirmDelete(obj){
            if(confirm("Do you really want to delete this?")==true){
                $(obj).closest('form').submit();
            }
        }
        function chackboxChanged(obj){
            for(var selector of $('.selector')){
                selector.checked=obj.checked;
            }
        }
        function sendSms(){
            var ids=[];
            for(var selector of $('.selector')){
                if(selector.checked){
                    ids.push($(selector).data('id'));
                }
            } 
            if(ids.length<1){
                alert("Please select atleast one tutor");
                return;
            }
            $("#ids").val(JSON.stringify(ids));
            $("#bulk_sms_form").submit();
        }
    </script>
@endsection