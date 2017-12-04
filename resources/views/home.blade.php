@extends('layouts.app')

@section('content')
<div class="container" id="homepage">
    <ul class="nav nav-tabs">
        <li role="presentation"@if($app->request->query->get('type') == \OtcCms\Models\CryptoCurrencyType::BITCOIN) class="active" @endif>
            <a href="{{ route('home', ['type'=>\OtcCms\Models\CryptoCurrencyType::BITCOIN]) }}">{{ __('glossary.BITCOIN') }}</a>
        </li>
        <li role="presentation"@if($app->request->query->get('type') == \OtcCms\Models\CryptoCurrencyType::ETHEREUM) class="active" @endif>
            <a href="{{ route('home', ['type'=>\OtcCms\Models\CryptoCurrencyType::ETHEREUM]) }}">{{ __('glossary.ETHEREUM') }}</a>
        </li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">钱包总览</div>
        <div class="panel-body">
            <form class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">名称</label>
                    <p class="form-control-static col-md-10">{{ __('glossary.'.$walletSummary->getCryptoTypeName()) }}</p>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">锁定中</label>
                    <p class="form-control-static col-md-10">{{ $walletSummary->getLocked() }}</p>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">有效余额</label>
                    <p class="form-control-static col-md-10">{{ $walletSummary->getBalance() }}</p>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">总计</label>
                    <p class="form-control-static col-md-10">{{ $walletSummary->getTotal() }}</p>
                </div>
            </form>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">营收状况</div>
        <div class="panel-body">
            <div class="row text-center">
                <div class="col-md-6">
                    <h2>当前手续费比率</h2>
                    <h3 class="text-danger">{{ $currentCommissionRatio }}%</h3>
                </div>
                <div class="col-md-3">
                    <h2>当日实时收</h2>
                    <h3 class="text-danger">{{ $commissionToday->commission }}BTC</h3>
                </div>
            </div>
        </div>
        @if ($commissionPageCount == 0)
            <div class="well text-center">
                <h2>暂无手续费记录</h2>
            </div>
        @else
        <table class="table">
            <thead>
            <tr>
                <th>时间</th>
                <th>交易额(BTC)</th>
                <th>手续费比率</th>
                <th>收入(BTC)</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="commission in commissionList">
                    @verbatim
                        <td>{{ commission.date }}</td>
                        <td>{{ commission.total }}</td>
                        <td>{{ commission.ratio }}%</td>
                        <td>{{ commission.commission }}</td>
                    @endverbatim
                </tr>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <paginate
                :page-count="{{ $commissionPageCount }}"
                :click-handler="getCommissionList"
                :prev-text="'上一页'"
                :next-text="'下一页'"
                :container-class="'pagination'"></paginate>
        </nav>

    </div>
</div>
@endsection

@section('scripts')
    <script>
        window.CRYPTO_TYPE={{ $app->request->input('type') }};
    </script>
    <script src="{{ asset('/js/homepage.js') }}"></script>
@endsection
