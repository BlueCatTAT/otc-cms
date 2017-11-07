@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">提现申请</li>
        </ol>
        @include('mixins.post-message')
        <div class="row">
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">查询条件</div>
                <div class="panel-body">
                    <div class="well">
                    <form class="form-horizontal" method="get" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订单状态</label>
                            <div class="col-sm-10 checkbox-form">
                                @foreach ($statusList as $status)
                                <div class="pretty p-default">
                                    <input type="checkbox" value="{{ $status->getStatusCode() }}"
                                    name="statusList[]"
                                    @if (in_array($status->getStatusCode(), request('statusList'))) checked @endif>
                                    <div class="state"><label>{{ $status->getStatusText() }}</label></div>
                                </div>
                                @endforeach
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
                @include('mixins.withdraw-list')
            </div>
            </div>
        </div>
        {{ $withdrawList->links() }}
    </div>

@endsection
