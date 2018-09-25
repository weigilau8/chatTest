<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<title>HOSMATCH｜ホスマッチはホストクラブの店舗とお客様をマッチングするサイトです</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="ホスト,ホストクラブ,マッチング"/>
	<meta name="description" value="ホストクラブのイメージに敷居の高さを感じている初めてのお客様の為に、より安心してホストクラブを体験してもらう為に作られた場所です。"/>

	<meta property="og:title" content="HOSMATCH｜ホスマッチはホストクラブの店舗とお客様をマッチングするサイトです">
	<meta property="og:description" content="ホストクラブのイメージに敷居の高さを感じている初めてのお客様の為に、より安心してホストクラブを体験してもらう為に作られた場所です。">
	<meta property="og:image" content="/images/image.jpg">
	<meta property="og:type" content="website">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.1/css/all.css">
	<link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet"/>

	<script type="text/javascript" src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/css/swiper.min.css">
	<script>


        $(window).load(function () { //全ての読み込みが完了したら実行
            $('#loader-bg').delay(900).fadeOut(3000);
            $('#loader').delay(600).fadeOut(300);
        });

        //10秒たったら強制的にロード画面を非表示
        $(function () {
            setTimeout('stopload()', 10000);
        });

        function stopload() {
            $('#loader-bg').delay(900).fadeOut(800);
            $('#loader').delay(600).fadeOut(300);
        }
	</script>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="/css/import.css"/>

	<link rel="shortcut icon" href="/images/favicon.ico">
	<link rel="apple-touch-icon" href="/images/icon.png"/>

	<link rel="stylesheet" href="/css/hosfront.css"/>

	<script>
		if (navigator.userAgent.match(/MSIE 10/i) || navigator.userAgent.match(/Trident/7. /) ||
		navigator.userAgent.match(/Edge/
		12. /
		))
		{
			$('body').on("mousewheel", function () {
				event.preventDefault();
				var wd = event.wheelDelta;
				var csp = window.pageYOffset;
				window.scrollTo(0, csp - wd);
			});
		}

	</script>

	<script>
		$(function () {
			$(window).stellar({
				horizontalScrolling: false,
				verticalScrolling: true
			});
		});

	</script>
</head>

<body class="drawer drawer--top">
<a name="TOP" id="TOP"></a>
<div id="wrapper">


<!-- /////////////////////////////////////////////// -->
@yield('content')
<!-- /////////////////////////////////////////////// -->


	<p id="pageTop">
		<a href="#"><img src="/images/pagetop.svg" alt="ページトップへ"/></a>
	</p>


	<div id="footer">
		<a href="/"><img src="/images/logo.svg" alt="HOSMATCH｜ホスマッチ" class="foot_logo"></a>
		<div class="foot_line"></div>

		<ul class="navi2">
			<li><a href="/">HOME</a></li>
			<li><a href="/about">ホスマッチについて</a></li>
			<li><a href="{{ route('login') }}">会員登録／ログイン</a></li>
			<li><a href="/list">登録店舗</a></li>
			<li><a href="/host">登録ホスト</a></li>
			<li><a href="/soon_host">即ホス</a></li>
			<br/>
			<li><a href="">お問い合わせ</a></li>
			<li><a href="">運営会社</a></li>
			<li><a href="">利用規約</a></li>
			<li><a href="">個人情報保護方針</a></li>
			<li><a href="">店舗掲載</a></li>
		</ul>
		<ul class="sns2">
			<li><a class="_hover" href="http://www.facebook.com/share.php?u=【ホスマッチのURL】"
			       onclick="window.open(this.href, 'FBwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img
							src="/images/icon_facebook.png" alt="Facebook"></a></li>
			<li>
				<a href="http://twitter.com/share?url=【ホスマッチのURL】&text=HOSMATCH｜ホスマッチはホストクラブの店舗とお客様をマッチングするサイトです。ホストクラブのイメージに敷居の高さを感じている初めてのお客様の為に、より安心してホストクラブを体験してもらう為に作られた場所です。"
				   onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"
				   class="_hover"><img src="/images/icon_twitter.png" alt="Twitter"></a></li>
			<li><a href="https://plus.google.com/share?url=【ホスマッチのURL】" class="_hover"
			       onclick="window.open(this.href, 'TWwindow', 'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes'); return false;"><img
							src="/images/icon_google.png" alt="Google+"></a></li>
			<li><a href="https://instagram.com/ユーザーURL/" class="_hover" target="_blank"><img src="/images/icon_insta.png"
			                                                                                 alt="Instagram"></a></li>
			<li><a href="https://www.youtube.com/channel/チャンネルURL?sub_confirmation=1" class="_hover"
			       target="_blank"><img src="/images/icon_youtube.png" alt="Toutube"></a></li>
		</ul>

		<p>Copyright&copy; 2018 HOSMATCH. ALL Rights Reserved.</p>
	</div>
	<!-- end #footer -->

</div>
<!-- end #wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.1/js/swiper.min.js"></script>
<script>
    var mySwiper = new Swiper ('.swiper-container', {
        loop: true,
        slidesPerView: 2,
        spaceBetween: 45,
        centeredSlides : true,
        pagination: '.swiper-pagination',
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
    })
</script>

<script src="https://apis.google.com/js/platform.js" async defer>
	{
		lang: 'ja'
	}

</script>
<script>
	$(document).ready(function () {
		$('.drawer').drawer();
		$('.drawer-menu li a').on('click', function () {
			$('.drawer').drawer('close');
		});
	});

</script>
</body>

<script src="/js/gotop.js"></script>
<script src="/js/jquery.stellar.min.js"></script>
<script src="/js/drawer.min.js"></script>
<script src="/js/iscroll.js"></script>
<script src="/js/jquery.reveal.js"></script>

</html>
