@extends('site.layout.main')
@section('title')
    <title>Tin tức</title>
@endsection
@section('content')
    <style>
        .news .item-news{
            margin-top: 10px;
            border: 1px solid #dddddd;
            height: 200px;
            display: flex;
        }
        .news-detail {
            margin-left: 20px;
            padding: 10px;
        }
        .cate {
            color: #0f71fb;
            font-size: 14px;
        }

        .news-name {
            color: #3d3d3d;
            font-weight: 700;
            font-size: 22px;
        }
        a { text-decoration: none }
        .des {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3; /*(3 dòng)*/
            -webkit-box-orient: vertical;
        }
    </style>

    <div class="news">
        <div class="container-fluid">
            <div class="row">
                @if(! empty($news))
                    @foreach($news as $k => $v)
                        <a href="{{ route('site.news.detail', ['id' => $v->id]) }}">
                            <div class="item-news">
                                <img src="{{ $v->image }}" alt="" height="198" width="220" style="object-fit: cover">
                                <div class="news-detail">
                                    <a href="{{ route('site.news.index', ['id' => $v->category_news_id]) }}">
                                        <div class="cate">{{ isset($v->cate->name) ? $v->cate->name : ''  }}</div>
                                    </a>
                                    <div class="news-name" style="margin-top: 10px">{{ $v->title }}</div>
                                    <div class="des" style="color: #3d3d3d; margin-top: 10px">{{ $v->description }}</div>
                                    <div style="color: gray; margin-top: 20px">{{ date('h:s d-m-Y', $v->date_c) }} - Đăng bởi: {{ $v->user_name_c }}</div>
                                </div>
                            </div>
                        </a>
                    @endforeach
{{--
                    <div style="color: grey" class="text-center">Không có dữ liệu</div>
--}}
                @endif
            </div>
        </div>
    </div>
@endsection

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

@section('custom_js')
@endsection
