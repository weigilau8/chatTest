@extends('layouts.app_mypage')

@section('content')

	<div class="container mymenu login_content">
		<div class="content02">
			<h2>HOSMATCH　マイメニュー</h2>
		</div>

		<ul class="col4">
			<li><a href="/mypage_user"><i class="fa fa-user-circle" aria-hidden="true"></i>あなたの情報</a></li>
			<li><a href="/mypage_fav"><i class="fa fa-heart" aria-hidden="true"></i>お気に入りホスト</a></li>
			<li><a href="/mypage_rireki"><i class="fa fa-history" aria-hidden="true"></i>予約履歴</a></li>
			<li><a href="#"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>ポイント購入履歴</a></li>
			<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>ホストを応援</a></li>
			<li><a href="#"><i class="fa fa-smile-o" aria-hidden="true"></i>友達に紹介</a></li>

		</ul>
	</div>

@endsection
