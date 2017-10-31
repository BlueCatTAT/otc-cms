@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>名称</th>
                <th>邮箱</th>
                <th>角色</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userList as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                    @foreach ($user->roles as $role)
                        {{ $role->display_name }}
                    @endforeach
                    </td>
                    <td>
                        <a href="{{route('cms_user_detail', [$user->id])}}" class="glyphicon glyphicon-pencil"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
