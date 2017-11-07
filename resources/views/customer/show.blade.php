@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('customer_list') }}">账号总览</a></li>
            <li class="active">{{ $customer->id }}</li>
        </ol>

        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">基本信息</a></li>
            <li role="presentation"><a href="{{ route('customer_order_list', [ $customer->id ]) }}">订单列表</a></li>
            <li role="presentation"><a href="{{ route('customer_ad_list', [ $customer->id ]) }}">广告列表</a></li>
            <li role="presentation"><a href="{{ route('customer_withdraw_list', [ $customer->id ]) }}">提币申请列表</a></li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-heading">基本信息</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">ID</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->id }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">昵称</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->nickname }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">手机号</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->mobile }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">注册时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->create_time }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">资产概况(BTC)</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">资产总额</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->wallet->total }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">有效余额</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->wallet->balance }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">锁定</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $customer->wallet->locked }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection