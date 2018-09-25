@extends('layouts.app')

@section('content')
	{{--<script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>--}}
	<script src="/js/detail.js" type="text/javascript"></script>

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

	<div class="container03" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="0">
		<div class="content">
			<h2 class="pln">{{$store->store_name}}</h2>
		</div>
		<!-- end #content -->
		<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->

	<div class="container00">
		<div class="content02">
			<input type="hidden" id="chkHostId" value="{{$hostId}}">
			@auth
				<a href="#tagReserv">
					<label class="btn03 mb80" id="res_top">このホストクラブを予約</label>
				</a>
			@else
				店舗予約を行うには無料会員登録が必要となります。</br>
				<a href="{{ route('login') }}">
					<div class="btn03 mb80">会員登録はこちらから</div>
				</a>
			@endauth


			<h2 class="blk">システム紹介</h2>

			<div id="box_sys">
				<table id="table01">
					<tr>
						<th>住所</th>
						<td>{{$store->store_address}}</td>
					</tr>
					<tr>
						<th>電話番号</th>
						<td>{{$store->store_phone}}</td>
					</tr>
					<tr>
						<th>営業時間</th>
						<td>18:00〜</td>
					</tr>
					<tr>
						<th>URL</th>
						<td>{{$store->store_url}}</td>
					</tr>
					<tr>
						<th>初回セット</th>
						<td>{{$store->initial_set}}</td>
					</tr>
					<tr>
						<th>初回料金</th>
						<td>{{$store->initial_price}}</td>
					</tr>
					<tr>
						<th>通常料金</th>
						<td>{{$store->regular_price}}</td>
					</tr>
					<tr>
						<th>指名料</th>
						<td>{{$store->nominate_fee}}</td>
					</tr>
					<tr>
						<th>同伴料</th>
						<td>{{$store->with_fee}}</td>
					</tr>
					<tr>
						<th>税・サービス料</th>
						<td>{{$store->service_charge}}</td>
					</tr>
					<tr>
						<th>定休日</th>
						<td>{{$closed}}</td>
					</tr>
				</table>
			</div>


			<h2 class="blk">店内写真</h2>
			<ul class="col3">
				@foreach($imgs['store'] as $img)
					<li><img src="{{ $img['img_src'] }}" alt="店内写真">{{ $img['store_name'] }}</li>
				@endforeach
			</ul>
			<div class="clearfix"></div>

			<h2 class="blk">人気ホストトップ5</h2>
			<ul class="col5">
				@foreach($imgs['no5'] as $img)
					<li><img src="{{ $img['img_src'] }}" alt="人気ホストトップ5"></li>
				@endforeach
			</ul>
			<div class="clearfix"></div>

			@auth
				<a id="tagReserv"></a>
				<div class="res_menu col5">
					<label for="menu_bar01" class="btn03 mb80" id="res_bot">このホストクラブを予約</label>
					<input type="checkbox" id="menu_bar01" class="accordion"/>
					<div id="links01">
						<form>
							<div class="content_top">
								<h2 class="blk">①お好みのタイプのホストを選択</h2>
								<p>
									接客を希望するホストのタイプを5名選択してください(※出来る限りご希望のタイプに合わせたホストの接客を行わせて頂きますが、ご選択して頂いた写真のホストと同一人物の接客を確約するものではございません)<br/>
									<img src="/images/star_on.png">お気に入りに登録
								</p>
							</div>
							<ul class="col5">
								@foreach($imgs['hosts'] as $img)
									<li>
										<label class="pop_name" for="num{{$loop->iteration}}">
											<input class="star" type="checkbox" name="fav_host" title="お気に入りに登録" id="{{$img['host_id']}}" value="{{$img['host_name']}}" {{$img['fav']}}>
											<img class="choice_img" src="{{$img['img_src']}}" alt="ホスト" title="{{$img['host_name']}}">
											<input class="choice" type="checkbox" name="reserv_host" id="{{$img['host_id']}}" value="{{$img['host_name']}}" {{ $hostId == $img['host_id'] ? 'checked' : ''}}>
											{{--<span class="remark">{{$img['host_name']}}</span>--}}
										</label>
									</li>
								@endforeach
							</ul>
							<div class="clearfix"></div>
							<div class="content_bottom">
								<h2 class="blk">②ご来店の予約日時を指定</h2>
								<p>以下よりご来店を希望される日時を指定して下さい。</p>
								<div class="date_time_selec_content">
									<table id="datetime_tbl">
										<thead>
										<tr>
											<th>{{$dateInfo['month']}}</th>
											@foreach($dateInfo['days'] as $d)
												<td class="{{$d['cls']}}">{{$d['day']}}<span>{{$d['dsp']}}</span></td>
											@endforeach
										</tr>
										</thead>
										<tbody>
											@foreach($dateInfo['hours'] as $key => $val)
												<tr>
													<th>{{$key}}</th>
													@foreach($val as $open)
														<td class="{{$open['cls']}}" id="{{$open['dt_id']}}">
															{{$open['val']}}
														</td>
													@endforeach
												</tr>
											@endforeach
										</tbody>
									</table>
									<input type="hidden" id="selected_dt" />
								</div>

								<label class="btn01_res" id="btn_reserv">この内容で予約を行う</label>
							</div>
						</form>
					</div>
				</div>
			@else
				店舗予約を行うには無料会員登録が必要となります。</br>
				<a href="{{ route('login') }}">
					<div class="btn03 mb80">会員登録はこちらから</div>
				</a>
			@endauth


			<h2 class="blk">MAP</h2>
			{{--GoogleMap--}}
			<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_API_KEY')}}"
			        type="text/javascript"></script>
			<script src="/js/hosmap.js" type="text/javascript"></script>
			<script>googlemapInit('map', '{{$store->store_address}}', '{{$store->store_name}}');</script>
			<div id="map"></div>

			<link rel="stylesheet" href="/css/hosmap.css" />
			<div id="map_widget">
				<strong>{{$store->store_name}}</strong><br>
				{{$store->store_address}}</br>
				☎　{{$store->store_phone}}
			</div>

			{{--予約モーダル--}}
			<div class="container-fluid" id="modal_reserv">
				<form method="POST" action="/detail/reserve">
					{{ csrf_field() }}
					<div class="head">次の内容でご予約します。</div>
					<strong>ご来店日時</strong>
					<div id="confirm_reserv" class="sel_confirm"></div>
					<input type="hidden" name="res_date" id="res_date">
					<strong>お好みのホスト</strong>
					<ul id="fav_host" class="sel_confirm"></ul>
					<input type="hidden" name="fav_host_1" id="fav_host_1">
					<input type="hidden" name="fav_host_2" id="fav_host_2">
					<input type="hidden" name="fav_host_3" id="fav_host_3">
					<input type="hidden" name="fav_host_4" id="fav_host_4">
					<input type="hidden" name="fav_host_5" id="fav_host_5">
					<input type="hidden" name="storeId" value="{{$storeId}}">
					<div class="row" id="btn_div">
						<div class="col-md-5">
							<lavel id="reserv_cancel" class="confirm_ng">キャンセル</lavel>
						</div>
						<div class="col-md-5">
							<input type="submit" class="confirm_ok" onClick="return checkReserve();" value="予約" />
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end #content -->
	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->
	<div class="clearfix"></div>

	<script>
		$(function () {
            f()
        });

        function f() {
            var chkHost = $("#chkHostId").val();
            if (chkHost != "0"){
                $('#menu_bar01').click();
                $('body,html').animate({scrollTop: $('#links01').offset().top}, 500);
            }
        }
	</script>
{{--	<div class="container_top">
		<h2 class="blk">行きたいお店を探す</h2>
		<ul class="col5">
			<li><img src="photo/men_01.jpg" alt="人気ホストトップ5">ホスト名</li>
			<li><img src="photo/men_02.jpg" alt="人気ホストトップ5">ホスト名</li>
			<li><img src="photo/men_03.jpg" alt="人気ホストトップ5">ホスト名</li>
			<li><img src="photo/men_04.jpg" alt="人気ホストトップ5">ホスト名</li>
			<li><img src="photo/men_05.jpg" alt="人気ホストトップ5">ホスト名</li>
		</ul>
		<div class="clearfix"></div>
		<ul class="col4">
			<li class="none"><img src="images/top-icon-1.png" alt="店舗写真"></li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li><img src="photo/club_03.jpg" alt="店舗写真">店名店名店名</li>
			<li class="none"><img src="images/top-icon-2.png" alt="店舗写真"></li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
			<li class="none"><img src="images/top-icon-3.png" alt="店舗写真"></li>

			<li><img src="photo/club_03.jpg" alt="店舗写真">店名店名店名</li>

			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li class="none"><img src="images/top-icon-4.png" alt="店舗写真"></li>

			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_01.jpg" alt="店舗写真">店名店名店名</li>
			<li><img src="photo/club_02.jpg" alt="店舗写真">CLUB NAME</li>
		</ul>
		<div class="clearfix"></div>
	</div>--}}
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->
@endsection

