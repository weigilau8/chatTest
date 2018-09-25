@extends('layouts.top')

@section('content')
	<script>
        $(function () {
            getPickUp();
            setInterval(getPickUp,300000); //300s
        });

        function getPickUp() {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{route('getPickUp')}}",
                type:"post",
                data:{},
                dataType:"json",
                async: false,
                success:function (data) {
                    if (data.status==1){
                        for (let i=1;i<18;i++){
							let w1="<a href='#' data-reveal-id='myModal"+i+"'><img src='"+data.data[i-1]['src']+"'></a>"+data.data[i-1]['name']+"\n"+
									"<div id='myModal"+i+"' class='reveal-modal'>\n"+
										"<h1>"+data.data[i-1]['name']+"</h1>\n"+
										"<div class='swiper-container'>\n"+
											"<div class='swiper-wrapper'>\n"+
												"<div class='swiper-slide'><img src='/storage/images/Host/Host_"+data.data[i-1]['id']+"_Small_1.jpg' alt=\"ホスト1\"></div>\n"+
                                				"<div class='swiper-slide'><img src='/storage/images/Host/Host_"+data.data[i-1]['id']+"_Small_2.jpg' alt=\"ホスト2\"></div>\n"+
												"<div class='swiper-slide'><img src='/storage/images/Host/Host_"+data.data[i-1]['id']+"_Small_3.jpg' alt=\"ホスト3\"></div>\n"+
												"<div class='swiper-slide'><img src='/storage/images/Host/Host_"+data.data[i-1]['id']+"_Small_4.jpg' alt=\"ホスト4\"></div>\n"+
                                				"<div class='swiper-slide'><img src='/storage/images/Host/Host_"+data.data[i-1]['id']+"_Small_5.jpg' alt=\"ホスト5\"></div>\n"+
											"</div>\n"+
											"<div class='swiper-button-prev'></div>\n"+
											"<div class='swiper-button-next'></div>\n"+
										"</div>\n"+
										"<div class='btn03 mb80'><a href='/detail/"+data.data[i-1]['store_id']+"/"+data.data[i-1]['id']+"'>お店を予約する</a></div>\n"+
									"</div>\n";
                            $("#pick"+i).html(w1);

                            var mySwiper = new Swiper('.swiper-container',{
                                nextButton: '.swiper-button-next',
                                prevButton: '.swiper-button-prev',
                                loop:true,
                                grabCursor: true,
                            });
                        }
                    }
                }
            })
        }

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
	<div id="loader-bg">
		<div id="loader">
			<img src="svg-loaders/hearts.svg" width="80" alt="">
			<p>HOSMATCH</p>
		</div>
	</div>

	<div class="pc_only">
		<div id="header_top">
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

	<div class="pc_only">
		<div id="photo">
			<div class="container_mov">
				<div id="logo"><img src="images/logo.svg" alt="HOSMATCH"></div>
				<div id="top">
					<ul class="navi">
						<li><a href="/about">HOSMATCHの使い方</a></li>
						<li><a href="{{ route('login') }}">会員登録／ログイン</a></li>
						<li><a href="/list">登録店舗</a></li>
						<li><a href="/host">登録ホスト</a></li>
						<li><a href="/soon_host">即ホス</a></li>
						<li><a href="#">お問い合わせ</a></li>
					</ul>
				</div>
				<div class="arrow"><i class="fas fa-angle-down fa-3x"></i></div>
				<div class="link_area">
					<a href="/host"><img src="images/top-icon-2.png" alt="店舗写真"></a>
					<a href="/list"><img src="images/top-icon-3.png" alt="店舗写真"></a>
				</div>
			</div>

		</div>

	</div>
	<div class="sp_only">
		<div id="photo">
			<div id="logo"><img src="images/logo.svg" alt="HOSMATCH"></div>
		</div>
	</div>

	<!-- /////////////////////////////////////////////// -->

	<div class="container_top">
		<div class="box-1-top">
			<div class="box-1-body">
				<h3>初めての方でも安心してホストクラブを利用して頂く為に、<br/> 私たちが出来る事は何かを考えました。
				</h3>

				<p>HOSMATCHはホストクラブの店舗とお客様をマッチングするサイトです。</p>

				<p>ホストクラブのイメージに敷居の高さを感じている初めてのお客様の為に、<br/> より安心してホストクラブを体験してもらう為に作られた場所です。
				</p>

				<p>まずはそのお店を知って頂く為の『新規様ご利用価格』、そしてご利用頂いたお客様にお店を『評価して頂く』、<br/> その評価をHOSMATCHが常にチェックを行う。
				</p>

				<p class="mb50">安心で健全なホストクラブ選びを、私たちは全てのお客様に提案し続けます。</p>

				<a href="{{ route('login') }}"><span class="btn01">ログイン・会員登録</span></a>
			</div>
			<div class="box-1-bottom">&nbsp;</div>
		</div>

	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->

	<div class="container01" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="0">

		<div class="content">
			<h3>無料会員登録だけで、ネットでお店のご予約ができます。</h3>
			<p>ご利用方法はとても簡単です。『このお店に行ってみたい』と思ったらHOSMATCHに会員登録するだけでご予約が可能です。</p>

			<p class="mb50">しっかりと精査されたホストクラブを随時登録しているので、HOSMATCH一つできっとあなたに会ったお店が見つかります。</p>

			<a href="/about"><span class="btn02">使い方を見る</span></a>

		</div>
		<!-- end #content -->
	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->
	<div class="clearfix"></div>

	<div class="container_top row">
		<div class="clearfix"></div>
		<ul class="col4">
			<li class="none"><a href="#"><img src="images/top-icon-1.png" alt="店舗写真"></a></li>

			<li id="pick1"></li>
			<li id="pick2"></li>
			<li id="pick3"></li>
			<li id="pick4"></li>
			<li id="pick5"></li>
			<li id="pick6"></li>
			<li id="pick7"></li>

			<li class="none"><a href="#"><img src="images/top-icon-2.png" alt="店舗写真"></a></li>

			<li id="pick8"></li>
			<li id="pick9"></li>

			<li class="none"><a href="#"><img src="images/top-icon-3.png" alt="店舗写真"></a>&nbsp</li>

			<li id="pick10"></li>
			<li id="pick11"></li>
			<li id="pick12"></li>
			<li id="pick13"></li>
			<li id="pick14"></li>
			<li id="pick15"></li>
			<li id="pick16"></li>

			<li class="none"><a href="#"><img src="images/top-icon-4.png" alt="店舗写真"></a>&nbsp</li>
			<li id="pick17"></li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<!-- end #container -->
	<!-- /////////////////////////////////////////////// -->
@endsection
