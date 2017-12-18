@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('adpicture_reorder') }}" method="post">
        {{ csrf_field() }}
        <div class="panel panel-default">
            <div class="panel-heading">轮播图片</div>
            <div class="panel-body">
                <div class="row" id="ad-pictures">
                    @foreach($pictures as $picture)
                    <div class="col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="{{ $picture->getUrl() }}">
                            <input type="hidden" value="{{ $picture->getUrl() }}" name="pictures[]">
                        </a>
                    </div>
                    @endforeach
                </div>
                <a class="btn btn-default" href="{{ route('adpicture_add') }}">上传图片</a>
                <button class="btn btn-default">保存</button>
            </div>
        </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/ad_pictures.js') }}"></script>
@endsection
