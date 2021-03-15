@extends('frontend.layout_news')
@section('content')
    <br>
    <div class="col-sm-10">
        <p class="title-rand-news" >Chi tiet</p>
        <!-- row	 -->
{{--        <img src="upload/news/{{ $record->news_image }}" style="width: 90px; height: 80px; " alt="">--}}

        <div class="rows">
            <!-- one new-->
            <div class="col-lg-8 col-md-12 col-sm-12" style="margin-bottom: 10px;">
                <div class="title-news-detail">{{ isset($record->news_title)?$record->news_title:'' }}</div>
                <div class="news-content">
                    {!! isset($record->news_content)?$record->news_content:'' !!}
                </div>
                <p style="margin-top: 30px; color: gray">{{ isset($record->created_at)?$record->created_at:'' }}</p>
            </div>
            <!-- one new-->
            <!-- news latest -->
            <div class="col-lg-4 col-md-12 col-sm-12 " style="padding: 0; margin: 0 ">
                <div class="box-right">
                    <p class="text-center title-lastest" style="background: #ffa500">BÀI VIẾT LIÊN QUAN</p>
                    <ul>
                        <div style="border: 1px dashed #dddddd"></div>
                        @foreach($data as $rows)
                            <li style="display: flex;">
                                <a href="{{ url('news-detail/'.$rows->news_id) }}">
                                    <img src="upload/news/{{ $rows->news_image }}" style="width: 90px; height: 80px; " alt="">
                                    <div class="content-right">
                                        <a href="{{ url('news-detail/'.$rows->news_id) }}">
                                            {{ $rows->news_title }}
                                        </a>
                                        <p style="padding-top: 14px; font-size: 13px">{{ isset($rows->created_at)?$rows->created_at:'' }}</p>
                                    </div>
                                </a>
                            </li>
                            <div style="border: 1px dashed #dddddd"></div>
                        @endforeach
                    </ul>
                    <p class="text-right" style="padding: 0; margin: 0px; padding-bottom: 10px; padding-right: 13px">
                        <a href="{{ url('news-category/'.$record->news_category_id) }}">
                            <i>Xem thêm</i>
                        </a>
                    </p>
                </div>
            </div>
            <!-- end news latest -->
            <div class="clearfix"></div>
        </div>

        <!-- end rows -->
    </div>
@endsection
