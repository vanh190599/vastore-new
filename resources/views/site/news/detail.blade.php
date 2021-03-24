@extends('site.layout.main')
@section('title')
    <title>{{ $new->title }}</title>
@endsection
@section('content')
    <style>
        .content-news img {
            width: 100%;
        }
    </style>
    <div class="container">
        <div style="font-size: 38px; font-weight: 600">{{ $new->title }}</div>
        <div>{{ $new->user_name_c }} - {{ date('h:i d-m-Y', $new->date_c) }}</div>
        <hr>
        <div style="font-weight: 600">{{ $new->description }}</div>
        <hr>
        <div class="content-news" >
            {!! $new->content !!}
        </div>
    </div>

@section('cate')
    <div class="brands_products"><!--products-->
        <h2 style="color: orangered">Tin tức</h2>
        <div class="">
            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                @if(!empty($cate_news))
                    @foreach($cate_news as $k => $v)
                        <li class="">
                            <a class="list-group-item text-dark" style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px"
                               href="{{ route('site.news.index', ['id'=>$v->id]) }}">
                                {{ $v->name }}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div><!--/products-->
@endsection
@endsection
@section('custom_js')
@endsection
