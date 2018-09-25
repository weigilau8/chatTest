@extends('layouts.app_mypage')

@section('content')
	<script src="/js/rireki.js" type="text/javascript"></script>

	<div class="container00 rireki login_content">
		<div class="content02">
			<h2>予約履歴</h2>
		</div>
		<div class="tab_area">
			<span><label name="tab_resv" class="current" id="01"><i class="fa fa-caret-right" aria-hidden="true"></i> これからの予約</label></span>
			<span><label name="tab_resv" id="02"><i class="fa fa-caret-right" aria-hidden="true"></i> 来店済みの予約</label></span>
		</div>
		<div class="content02 table_area">
			{{--これからの予約--}}
			<form method="POST" action="" id="frm_cancel">
				{{ csrf_field() }}
				<table class="table_rireki active" id="table01">
					<thead>
					<tr>
						<td>予約日時</td>
						<td>利用店舗</td>
						<td>指名ホスト</td>
						<td>予約番号</td>
						<td>ステータス</td>
						<td>キャンセル</td>
					</tr>
					</thead>

					<tbody class="tbody_yet active" id="yet01">
					@foreach($reservYet as $resv)
						@if($loop->index !== 0 && $loop->index % 5 === 0)
							<tbody class="tbody_yet" id="yet{{ sprintf('%02d', ($loop->index / 5) + 1) }}">
						@endif
							<tr>
								<th>{{ $resv['date_time'] }}</th>
								<td>{{ $resv['store'] }}</td>
								<td><ul>{!! $resv['hosts'] !!}</ul></td>
								<td>{{ $resv['conf'] }}</td>
								<td>{{ config('Common.reserv.' . $resv['status']) }}</td>
								<td>
									<input class="btn btn-default form-control resv_cancel"
									       type="button" name="cancel_btn" id="{{ $resv['id'] }}"
									       value="キャンセル" {{ $resv['status'] != 0 ? 'disabled' : '' }}>
								</td>
							</tr>
						@if($loop->index !== $loop->count - 1 && $loop->index % 5 === 4)
							</tbody>
						@endif
					@endforeach
					</tbody>
				</table>
			</form>

			<div class="pagenavi active" id="navi01">
				{!! $yetNavi !!}
			</div>

			{{--来店済み予約--}}
			<table class="table_rireki" id="table02">
				<thead>
				<tr>
					<td>予約日時</td>
					<td>利用店舗</td>
					<td>指名ホスト</td>
					<td>獲得ポイント</td>
					<td>項目</td>
				</tr>
				</thead>
				<tbody class="tbody_fin active" id="fin01">
					@foreach($reservFin as $resv)
						@if($loop->index !== 0 && $loop->index % 5 === 0)
							<tbody class="tbody_fin" id="fin{{ sprintf('%02d', ($loop->index / 5) + 1) }}">
						@endif
						<tr>
							<th>{{ $resv['date_time'] }}</th>
							<td>{{ $resv['store'] }}</td>
							<td>
								<ul>{!! $resv['hosts'] !!}</ul>
							</td>
							<td>{{ $resv['point'] }}</td>
							<td>項目</td>
						</tr>
						@if($loop->index !== $loop->count - 1 && $loop->index % 5 === 4)
							</tbody>
						@endif
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="pagenavi" id="navi02">
			{!! $finNavi !!}
		</div>
	</div>

@endsection
