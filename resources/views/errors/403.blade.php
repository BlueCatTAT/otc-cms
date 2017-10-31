@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>403</h1>
            <p>抱歉，你没有权限访问该页面。</p>
            <p><a class="btn btn-default btn-lg" role="button" href="{{ route('home') }}">返回首页</a></p>
        </div>
    </div>
@endsection
