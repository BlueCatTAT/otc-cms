@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>用户ID</th>
                    <th>用户名称</th>
                    <th>数量</th>
                    <th>创建时间</th>
                    <th>状态</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($withdrawList as $withdraw)
                <tr>
                    <td>{{ $withdraw->uid }}</td>
                    <td>{{ $withdraw->uname }}</td>
                    <td>{{ $withdraw->amount }}</td>
                    <td>{{ $withdraw->create_time }}</td>
                    <td>{{ $withdraw->getStatusText() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $withdrawList->links() }}
    </div>
@endsection
