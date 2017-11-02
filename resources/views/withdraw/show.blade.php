@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{URL::previous()}}">提现申请</a></li>
            <li class="active">#</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">提现详情</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">用户ID</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->uid}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">用户名称</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->uname}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">比特币地址</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->bitcoin_address or '----'}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">数量</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->amount}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">备注</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->comment}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">状态</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->getStatusText()}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">txid</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->txid or '----'}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">创建时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->create_time}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">更新时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->update_time}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">审核时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->audit_time}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">提现时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$withdraw->finish_time}}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">提现操作记录</div>
            <div class="panel-body">
                @if (count($withdraw->auditLogs) == 0)
                    <p>没有操作记录</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th width="25%">操作ID</th>
                            <th>操作人</th>
                            <th>操作成功</th>
                            <th>操作行为</th>
                            <th>状态</th>
                            <th>备注</th>
                            <th>操作时间</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($withdraw->auditLogs as $log)
                        <tr>
                            <td>{{$log->request_id}}</td>
                            <td>{{$log->cms_uname}}</td>
                            <td>
                                @if ($log->is_successful == false)
                                    <span class="label label-danger">{{$log->isSuccessfulText()}}</span>
                                @else
                                    {{$log->isSuccessfulText()}}
                                @endif
                            </td>
                            <td>{{$log->getTargetStatusText()}}</td>
                            <td>{{$log->getPreviousStatusText()}}->{{$log->getPostStatusText()}}</td>
                            <td>{{$log->comment or '----'}}</td>
                            <td>{{$log->create_time}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
@endsection
