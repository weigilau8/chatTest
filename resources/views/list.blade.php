@extends('layouts.app')

@section('content')

	<!-- FOR jquery slider -->
	@include('layouts.slider')

	<div class="pc_only">
		<div id="header">
			<div class="content">
				@include('layouts.pc_navi')
			</div>
			<!-- end #container -->
		</div>
		<!-- end #header -->
	</div>
	<div class="sp_only">
		<div id="header_sp">
			@include('layouts.sp_navi')
		</div>
	</div>

	<!-- /////////////////////////////////////////////// -->

	<div class="container02" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="0">
		<div class="content">
			<div class="topimg"><img src="/images/list-1.png" alt="HOSMATCH">
				<h2 class="pln">登録店舗一覧</h2>
			</div>
		</div>
		<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
		<!-- end #content -->
	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->
	<div class="clearfix"></div>


	<div class="container00">
		<div class="box02">
			<h2 class="blk">行きたいお店を検索</h2>
			<form method="post" action="/list/find_store">
				{{ csrf_field() }}

				<div class="box_lft">
					<div class="ttl">◆ キーワード</div>
					<div class="mb20"><input type="text" name="keyword" value="{{ old('keyword') }}" ></div>

					<div class="ttl">◆ 価格検索（初回セット料金）</div>
					<div class="layout-slider">
						<input id="Slider1" type="slider" name="price_range" value="{{ old('price_range') == null ? '3000;10000' : old('price_range') }}" />
					</div>
					<script type="text/javascript" charset="utf-8">
						jQuery("#Slider1").slider({ from: 1000, to: 50000, step: 1000, smooth: true, round: 0, dimension: "&nbsp;￥", skin: "round" });
					</script>

					{{--					<select name="price">
											<option value="" selected>▼　選択してください</option>
											<option>1,000円</option>
											<option>2,000円</option>
											<option>3,000円</option>
											<option>4,000円</option>
											<option>5,000円</option>
											<option>6,000円</option>
											<option>7,000円</option>
											<option>8,000円</option>
											<option>9,000円</option>
											<option>10,000円</option>
										</select>--}}
				</div>

				<div class="box_rgt">
					<div class="ttl">◆ エリア</div>
					<div class="mb20">
						<select name="area">
							<option value="" selected>▼　選択してください</option>
							@foreach($froms as $from)
								<option value="{{ $from->from }}" @if(old('area') == $from->from) selected @endif>
									{{ $from->from }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ 主な年齢層（18歳～19歳アルコール提供不可）</div>
					<div class="layout-slider">
						<input id="Slider2" type="slider" name="age_range" value="{{ old('age_range') == null ? '20;30' : old('age_range') }}" />
					</div>
					<script type="text/javascript" charset="utf-8">
						jQuery("#Slider2").slider({ from: 18, to: 60, step: 1, smooth: true, round: 0, dimension: "&nbsp;歳", skin: "round" });
					</script>
{{--					<select name="age">
						<option value="" selected>▼　選択してください</option>
						<option>18歳～19歳（アルコール提供不可）</option>
						<option>20歳</option>
						<option>25歳</option>
						<option>30歳</option>
						<option>35歳</option>
						<option>40歳</option>
						<option>45歳</option>
						<option>50歳</option>
					</select>--}}
				</div>
				<div class="clearfix"></div>
				<div class="box_full">
					<input type="checkbox" name="new" id="new" {{ old('new') == null ? "" : "checked" }} />
					<label for="new" class="sample_label">新着店舗のみを検索（登録から3か月以内のお店のみを表示します）</label>
				</div>

				<button type="submit" id="sbtn" name="action" value="post">検　索</button>
			</form>

			<div class="clearfix"></div>
		</div>
		<!-- end #box_02 -->

		<ul class="col4">
			@if(empty($partImgs))
				<h2 class="blk">該当の店舗は存在しません。</h2>
			@else
				@foreach($partImgs as $img)
					<a href="/detail/{{ $img['store_id'] }}"><li><img src="{{ $img['img_src'] }}" alt="店舗写真">{{ $img['store_name'] }}</li></a>
				@endforeach
			@endif
		</ul>

{{--
		<ul class="col4">
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_03.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_04.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_03.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_04.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_03.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_04.jpg" alt="店舗写真">CLUB NAME</li>
		</ul>
--}}

		<div class="pagenavi">
			@if(!empty($pgNavi))
				@foreach($pgNavi as $navi)
					{!! $navi !!}
				@endforeach
			@endif
		</div>
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

	<!-- /////////////////////////////////////////////// -->
	<div class="clearfix"></div>

	<!-- /////////////////////////////////////////////// -->
@endsection
