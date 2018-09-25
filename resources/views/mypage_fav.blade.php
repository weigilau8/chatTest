@extends('layouts.app_mypage')

@section('content')

	<div class="container00 login_content">
		<div class="content02">
			<h2>お気に入りに登録したホスト</h2>
		</div>

		<ul class="col4">
			@if(empty($favImgs))
				<h2 class="blk">現在お気に入りのホストは未登録です</h2>
			@else
				@foreach($favImgs as $img)
					<li>
						<a data-reveal-id="myModal{{ $loop->iteration }}"><img src="{{ $img['img_src'] }}" alt="ホスト写真"></a>{{ $img['host_name'] }}
						<div id="myModal{{ $loop->iteration }}" class="reveal-modal">
							<h1>{{ $img['host_name'] }}</h1>
							<div class="swiper-container">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
									<!-- Slides -->
									@foreach($img['sImgs_src'] as $sImg)
										<div class="swiper-slide"><img src="{{ '/' . $sImg }}" alt="ホスト{{ $loop->iteration }}"></div>
									@endforeach
								</div>

								<!-- If we need navigation buttons -->
								<div class="swiper-button-prev"></div>
								<div class="swiper-button-next"></div>
							</div>
							<div class="btn03 mb80"><a href="/detail/{{ $img['store_id'] }}/{{ $img['host_id'] }}">お店を予約する</a></div>
						</div>
					</li>
					{{--<a href="/detail/{{ $img['store_id'] }}/{{ $img['host_id'] }}"><li><img src="{{ $img['img_src'] }}" alt="ホスト写真">{{ $img['store_name'] }}　{{ $img['host_name'] }}</li></a>--}}
				@endforeach
			@endif
		</ul>

{{--
		<div class="pagenavi">
			<a href="#">&laquo; 最初へ</a>
			<span class="current">1</span>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#">5</a>
			<a href="#">6</a>
			<a href="#">7</a>
			<a href="#">8</a>
			<a href="#">9</a>
			<a href="#">10</a>
			<a href="#">次へ &raquo;</a>
			<a href="#">最後へ &raquo;</a>
		</div>
--}}
	</div>

@endsection
