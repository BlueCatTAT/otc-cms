@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">添加图片</div>
            <div class="panel-body">
                <form class="dropzone" id="dropzone" action="{{ route('upload_image') }}" method="post">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ad_pictures.js') }}"></script>
@endsection