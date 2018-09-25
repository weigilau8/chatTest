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
			<div class="topimg"><img src="/images/host-1.png" alt="HOSMATCH">
				<h2 class="pln">即ホス一覧</h2>
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
			<h2 class="blk">すぐ付けるホストを検索</h2>
			<form method="post" action="/soon_host/find_host">
				{{ csrf_field() }}

				<div class="box_lft">
					<div class="ttl">◆ キーワード</div>
					<div class="mb10"><input type="text" name="keyword" value="{{ old('keyword') }}" ></div>

					<div class="ttl">◆ 価格検索（初回セット料金）</div>
					<div class="mb30">
						<div class="layout-slider">
							<input id="Slider1" type="slider" name="price_range" value="{{ old('price_range') == null ? '3000;10000' : old('price_range') }}" />
						</div>
						<script type="text/javascript" charset="utf-8">
							jQuery("#Slider1").slider({ from: 1000, to: 50000, step: 1000, smooth: true, round: 0, dimension: "&nbsp;￥", skin: "round" });
						</script>
					</div>

					<div class="ttl">◆ 出身地</div>
					<div class="mb10">
						<select name="from">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_from'] as $from)
								<option value="{{ $from->from_id }}" @if(old('from') == $from->from_id) selected @endif>
									{{ $from->from }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ 売り上げ</div>
					<div class="mb10">
						<select name="sales">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_sales'] as $sales)
								<option value="{{ $sales->sale_id }}" @if(old('sales') == $sales->sale_id) selected @endif>
									{{ $sales->sale }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ 見た目の系統</div>
					<div class="mb10">
						<select name="visual">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_visual'] as $vis)
								<option value="{{ $vis->visual_id }}" @if(old('visual') == $vis->visual_id) selected @endif>
									{{ $vis->visual }}
								</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="box_rgt">
					<div class="ttl">◆ エリア</div>
					<div class="mb10">
						<select name="area">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_from'] as $from)
								<option value="{{ $from->from }}" @if(old('area') == $from->from) selected @endif>
									{{ $from->from }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ 主な年齢層（18歳～19歳アルコール提供不可）</div>
					<div class="mb30">
						<div class="layout-slider">
							<input id="Slider2" type="slider" name="age_range" value="{{ old('age_range') == null ? '20;30' : old('age_range') }}" />
						</div>
						<script type="text/javascript" charset="utf-8">
							jQuery("#Slider2").slider({ from: 18, to: 60, step: 1, smooth: true, round: 0, dimension: "&nbsp;歳", skin: "round" });
						</script>
					</div>

					<div class="ttl">◆ 指名本数</div>
					<div class="mb10">
						<select name="nominate">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_nomi'] as $nomi)
								<option value="{{ $nomi->nominate_id }}" @if(old('nominate') == $nomi->nominate_id) selected @endif>
									{{ $nomi->nominate }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ ホスト歴</div>
					<div class="mb10">
						<select name="history">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_hist'] as $hist)
								<option value="{{ $hist->history_id }}" @if(old('history') == $hist->history_id) selected @endif>
									{{ $hist->history }}
								</option>
							@endforeach
						</select>
					</div>

					<div class="ttl">◆ 方言</div>
					<div class="mb10">
						<select name="dialect">
							<option value="" selected>▼　選択してください</option>
							@foreach($mst['mst_diale'] as $diale)
								<option value="{{ $diale->dialect_id }}" @if(old('dialect') == $diale->dialect_id) selected @endif>
									{{ $diale->dialect }}
								</option>
							@endforeach
						</select>
					</div>
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
				<h2 class="blk">該当のホストは存在しません。</h2>
			@else
				@foreach($partImgs as $img)
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

		<div class="pagenavi">
			@if(!empty($pgNavi))
				@foreach($pgNavi as $navi)
					{!! $navi !!}
				@endforeach
			@endif
		</div>
	</div>

	<!-- /////////////////////////////////////////////// -->
	<div class="clearfix"></div>
	<!-- /////////////////////////////////////////////// -->
@endsection
