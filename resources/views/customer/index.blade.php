@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb">
        <li class="active">帐号总览</li>
    </ol>

    <div class="panel panel-default">
        <div class="panel-heading">用户列表</div>
        <div class="panel-body">
            <div class="well">
                <form class="form-horizontal" method="get" action="{{ route('customer_list') }}">
                    <div class="form-group">
                        <label class="control-label col-sm-2">用户昵称或者id</label>
                        <div class="col-sm-4">
                            <input class="form-control" name="query" placeholder="用户昵称或者id" type="text" value="{{ request('query') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>昵称</th>
                <th>手机号</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customerList as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->nickname }}</td>
                    <td>{{ $customer->mobile }}</td>
                    <td>{{ $customer->create_time }}</td>
                    <td>
                       <a class="glyphicon glyphicon-eye-open" href="{{ route('customer_detail', [ $customer->id ]) }}"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if (empty(request('query')))
            {{ $customerList->links() }}
        @endif
    </div>
</div>
@endsection
