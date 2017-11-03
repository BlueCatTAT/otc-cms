@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('cms_user_list')}}">用户列表</a></li>
            <li class="active">{{$user->name}}</li>
        </ol>
        <form class="form-horizontal" action="{{route('cms_user_update', [$user->id])}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-12">
                @include('mixins.post-message')
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">名称</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{$user->name}}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{$user->email}}</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">角色</label>
                <div class="col-sm-10">
                    <select name="roleId">
                       @foreach ($roles as $role)
                           <option value="{{$role->id}}"
                                   @if ($user->getRole() && $role->id == $user->getRole()->id) selected @endif
                           >{{$role->display_name}}</option>
                       @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">新密码</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="新密码" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">密码确认</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="密码确认" name="password_confirmation">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">提交</button>
                </div>
            </div>
        </form>
    </div>
@endsection
