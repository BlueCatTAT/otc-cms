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
            <li role="presentation" class="active"><a href="#">广告列表</a></li>
            <li role="presentation"><a href="{{ route('customer_withdraw_list', [ $customer->id ]) }}">提币申请列表</a></li>
        </ul>

        <div class="well">
            @if ($customer->advertisements->count() === 0)
                <p>没有广告记录</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>类型</th>
                        <th>状态</th>
                        <th>单价(CNY)</th>
                        <th>最小成交额(CNY)</th>
                        <th>最小成交额(BTC)</th>
                        <th>最大成交额(CNY)</th>
                        <th>最大成交额(BTC)</th>
                        <th>发布时间</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($customer->advertisements as $advertisement)
                    <tr>
                        <td>{{ $advertisement->getTypeText() }}</td>
                        <td>{{ $advertisement->getStatusText() }}</td>
                        <td>{{ $advertisement->price }}</td>
                        <td>{{ $advertisement->min_limit_CNY }}</td>
                        <td>{{ $advertisement->min_limit_Token }}</td>
                        <td>{{ $advertisement->max_limit_CNY }}</td>
                        <td>{{ $advertisement->max_limit_Token }}</td>
                        <td>{{ $advertisement->create_time }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
