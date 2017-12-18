@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('adpicture_save') }}" method="post">
        <div class="panel panel-default">
            <div class="panel-heading">轮播图片</div>
            <div class="panel-body">
                <div class="row">
                    @foreach($pictures as $picture)
                    <div class="col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="{{ $picture->getUrl() }}">
                        </a>
                    </div>
                    @endforeach
                </div>
                <button class="btn btn-default" type="button">上传图片</button>
                <button class="btn btn-default">保存</button>
            </div>
        </div>
        </form>
        <form class="dropzone" action="{{ route('upload_image') }}" method="post">
            {{ csrf_field() }}
            <input type="file" name="file">
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ad_pictures.js') }}"></script>
@endsection
