@extends('layouts.app')

@section('content')
	<script src="js/jquery.fullPage.js"></script>
	<script src="js/jquery.easings.min.js"></script>
	<script src="js/scrolloverflow.min.js"></script>

	<script>
		$(document).ready(function () {
			$('#fullpage').fullpage({
				scrollingSpeed: 600,
				scrollOverflow: true
			});
		});
	</script>
	<script>
		var movieRatio = 16 / 9;

		function movieAdjust() {
			var adjustWidth = $(window).width();
			var adjustHeight = $(window).height();
			if (adjustHeight > adjustWidth / movieRatio) {
				adjustWidth = adjustHeight * movieRatio;
			}
			$('iframe').css({
				width: (adjustWidth),
				height: (adjustWidth / movieRatio)
			});
		}

		$(window).on('load resize', function () {
			movieAdjust();
		});

	</script>
	<script>
		$(function () {
			var h = $(window).height();

			$('#wrap').css('display', 'none');
			$('#loader-bg ,#loader').height(h).css('display', 'block');
		});

		$(window).load(function () { //全ての読み込みが完了したら実行
			$('#loader-bg').delay(900).fadeOut(3000);
			$('#loader').delay(600).fadeOut(300);
			$('#wrap').css('display', 'block');
		});

		//10秒たったら強制的にロード画面を非表示
		$(function () {
			setTimeout('stopload()', 10000);
		});

		function stopload() {
			$('#wrap').css('display', 'block');
			$('#loader-bg').delay(900).fadeOut(800);
			$('#loader').delay(600).fadeOut(300);
		}
	</script>

	<div id="loader-bg">
		<div id="loader">
			<img src="svg-loaders/hearts.svg" width="80" alt="">
			<p>HOSMATCH</p>
		</div>
	</div>
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

	<div class="pc_only">
		<div id="movie">
			<iframe src="https://www.youtube.com/embed/IT8vMnwgyjg?rel=0&autoplay=1&loop=1&mute=true&amp;controls=0&amp;showinfo=0&playlist=IT8vMnwgyjg"
			        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

		</div>
	</div>
	<div class="sp_only">
		<div id="key_sp">
			<div id="logo"><img src="images/logo.svg" alt="HOSMATCH"></div>
		</div>
	</div>

	<!-- /////////////////////////////////////////////// -->

	<div id="fullpage">
		<a name="TOP" id="TOP"></a>

		<div class="section">
			<div class="container">
				<div class="content">
					<div class="topimg"><img src="images/about-1.png" alt="HOSMATCH">
						<h2 class="pln">HOSMATCHの使い方</h2>
					</div>
				</div>
				<!-- end #container -->
			</div>
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->

		<div class="section">
			<div class="container05">
				<div class="content">
					<div class="topimg"><img src="images/about-2.png" alt="HOSMATCH">
						<h2 class="mb80">会員登録</h2>
					</div>

					<p class="mb80">以下のリンクから会員登録を行ってください。<br/> 簡単なプロフィールを入力して頂く事で、すぐに始められます。
					</p>

					<a href="{{ route('login') }}"><span class="btn02">会員登録・ログイン</span></a>

				</div>
				<!-- end #content -->
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
			</div>
			<!-- end #container -->
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->

		<div class="section">
			<div class="container06">
				<div class="content">
					<div class="topimg"><img src="images/about-3.png" alt="HOSMATCH">
						<h2 class="mb80">お店またはホストの検索</h2>
					</div>
					<p class="mb80">『新規様ご利用価格』でご利用頂ける店舗を検索する事が出来ます。<br/> 行ってみたいと思うお店をまずはHOSMATCHで検索。
					</p>

					<a href="/list"><span class="btn02">登録店舗を検索</span></a>

				</div>
				<!-- end #content -->
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
			</div>
			<!-- end #container -->
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->

		<div class="section">
			<div class="container07">
				<div class="content">
					<div class="topimg"><img src="images/about-4.png" alt="HOSMATCH">
						<h2 class="mb80">来店予約</h2>
					</div>
					<p>当日でなくても、2週間先まで来店予約をする事が出来ます。<br/> マイページのフォームで予約まですべて完結します。
					</p>
				</div>
				<!-- end #content -->
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
			</div>
			<!-- end #container -->
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->

		<div class="section">
			<div class="container08">
				<div class="content">
					<div class="topimg"><img src="images/about-5.png" alt="HOSMATCH">
						<h2 class="mb80">予約当日お店へ</h2>
					</div>
					<p>予約したらあとはそのお店に行くだけ。<br/> 是非ホストクラブでの素敵な時間を体験して下さい。
					</p>
				</div>
				<!-- end #content -->
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
			</div>
			<!-- end #container -->
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->

		<div class="section">
			<div class="container09">
				<div class="content">
					<div class="topimg">
						<img src="images/about-6.png" alt="HOSMATCH">
						<h2 class="mb80">お店を評価</h2>
					</div>
					<p>来店後は必ずお店の評価を行ってください。<br/> あなたの評価はこれからHOSMATCHを利用されるすべてのお客様にとっての安心に繋がります。
					</p>

					<p>また、評価をする事でお店のポイントが溜まり、ポイントに応じたサービスを受ける事が出来ます。</p>
				</div>
				<!-- end #content -->
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
			</div>
			<!-- end #container -->
		</div>
		<!-- end #section -->

		<!-- /////////////////////////////////////////////// -->
{{--
		<p id="btnTop">
			<img src="images/pagetop.svg" alt="ページトップへ"/>
		</p>
--}}

		<div class="section">
			<div class="container00">
				<div class="box-1-top">
					<div class="box-1-body">
						<h3>無料会員登録だけで、ネットでお店のご予約ができます。
						</h3>

						<p>ご利用方法はとても簡単です。『このお店に行ってみたい』と思ったらHOSMATCHに会員登録するだけでご予約が可能です。</p>

						<p class="mb80">しっかりと精査されたホストクラブを随時登録しているので、HOSMATCH一つできっとあなたに会ったお店が見つかります。</p>

						<a href="{{ route('login') }}"><span class="btn01">会員登録・ログイン</span></a>
					</div>
					<div class="box-1-bottom">&nbsp;</div>
				</div>
			</div>
			<!-- end #container -->

			<!-- /////////////////////////////////////////////// -->


			<div id="footer">
				<a href="/"><img src="images/logo.svg" alt="HOSMATCH｜ホスマッチ" class="foot_logo"></a>
				<div class="foot_line"></div>

				<ul class="navi2">
					<li><a href="/">HOME</a></li>
					<li><a href="/about">ホスマッチについて</a></li>
					<li><a href="{{ route('login') }}">会員登録／ログイン</a></li>
					<li><a href="/list">登録店舗</a></li>
					<li><a href="/host">登録ホスト</a></li>
					<br/>
					<li><a href="#">お問い合わせ</a></li>
					<li><a href="">運営会社</a></li>
					<li><a href="">利用規約</a></li>
					<li><a href="">個人情報保護方針</a></li>
					<li><a href="">店舗掲載</a></li>
				</ul>
				<ul class="sns2">
					<li><a class="_hover" href="http://www.facebook.com/share.php?u=【ホスマッチのURL】"
					       onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img
									src="images/icon_facebook.png" alt="Facebook"></a></li>
					<li>
						<a href="http://twitter.com/share?url=【ホスマッチのURL】&text=HOSMATCH｜ホスマッチはホストクラブの店舗とお客様をマッチングするサイトです。ホストクラブのイメージに敷居の高さを感じている初めてのお客様の為に、より安心してホストクラブを体験してもらう為に作られた場所です。"
						   onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"
						   class="_hover"><img src="images/icon_twitter.png" alt="Twitter"></a></li>
					<li><a href="https://plus.google.com/share?url=【ホスマッチのURL】" class="_hover"
					       onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img
									src="images/icon_google.png" alt="Google+"></a></li>
					<li><a href="https://instagram.com/ユーザーURL/" class="_hover" target="_blank"><img
									src="images/icon_insta.png" alt="Instagram"></a></li>
					<li><a href="https://www.youtube.com/channel/チャンネルURL?sub_confirmation=1" class="_hover"
					       target="_blank"><img src="images/icon_youtube.png" alt="Toutube"></a></li>
				</ul>

				<p>Copyright&copy; 2018 HOSMATCH. ALL Rights Reserved.</p>
			</div>
			<!-- end #footer -->

		</div>
		<!-- end #section -->

	</div>
	<!-- end #fullpage -->

	<!-- /////////////////////////////////////////////// -->
@endsection
