@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('customer_list') }}">账号总览</a></li>
            <li class="active">{{ $customer->id }}</li>
        </ol>

        <ul class="nav nav-tabs">
            <li role="presentation"><a href="{{ route('customer_detail', [ $customer->id ]) }}">基本信息</a></li>
            <li role="presentation"><a href="{{ route('customer_order_list', [ $customer->id ]) }}">订单列表</a></li>
            <li role="presentation"><a href="{{ route('customer_ad_list', [ $customer->id ]) }}">广告列表</a></li>
            <li role="presentation" class="active"><a href="#">提币申请列表</a></li>
        </ul>

        <div class="well">
            @if ($customer->withdraws->count())
                @include('mixins.withdraw-list', [ 'withdrawList' => $customer->withdraws ])
            @else
                <p>没有提币申请</p>
            @endif
        </div>
    </div>
@endsection