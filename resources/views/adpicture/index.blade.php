@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">轮播图片</div>
            <div class="panel-body">
                <div class="row">
                   @verbatim
                      <div v-for="picture in pictures" class="col-md-3">
                        <a href="#" class="thumbnail">
                            <img src="{{ picture.url }}">
                        </a>
                      </div>
                   @endverbatim
                </div>
            </div>
        </div>
    </div>
@endsection