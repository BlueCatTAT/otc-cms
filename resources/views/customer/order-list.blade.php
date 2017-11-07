@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('customer_list') }}">账号总览</a></li>
            <li class="active">{{ $customer->id }}</li>
        </ol>

        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{ route('customer_detail', [ $customer->id ]) }}">基本信息</a></li>
            <li role="presentation" class="active"><a href="#">订单列表</a></li>
            <li role="presentation"><a href="{{ route('customer_ad_list', [ $customer->id ]) }}">广告列表</a></li>
            <li role="presentation"><a href="{{ route('customer_withdraw_list', [ $customer->id ]) }}">提币申请列表</a></li>
        </ul>

        <div class="well">
            @if ($orderList->count())
                @include('mixins.order-list')
            @else
                <p>没有订单记录</p>
            @endif
        </div>
    </div>
@endsection