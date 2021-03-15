@extends('frontend.layout_news')
@section('content')
<div class="col-sm-10">
    <!-- row -->
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<p class="title-rand-news" >{{ isset($name)?$name:'' }}</p>

            @foreach($data as $rows)
			<div class="border"></div>
			<div class="hot-new-content" >
				<a href="{{ url('news-detail/'.$rows->news_id) }}" style="display: flex;" class="box-content-hot">
					<img src="upload/news/{{ $rows->news_image }}" class="img-thumbnail" style="width: 300px; height: 200px" alt="">

					<div class="title-news-hot" style="background: none; margin-left: 5px"><b>
                          {{ $rows->news_title }}
					</b>

					<p style="margin-top: 25px">
                        {{ $rows->news_desc }}
                    </p>

					<p style="color: gray; font-size: 15px; padding-top: 20px ">{{ isset($rows->created_at)?$rows->created_at:'' }}</p>
				</div>
				</a>
			</div>
                @endforeach

		</div>
		<!-- tin ngau nhien -->
	</div>
    <br>
	<!-- end row -->
    <div class="rows">
        <div class="col-sm-12 text-center">
            {{ $data->render() }}
        </div>
    </div>

</div>
@endsection
