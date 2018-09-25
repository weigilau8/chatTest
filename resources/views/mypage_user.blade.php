@extends('layouts.app_mypage')

@section('content')

	<div class="container user_edit login_content">
		<div class="content02">
			<h2>ユーザー情報</h2>

			<div class="box">
				<form id="" method="POST" action="mypage_user/update">
					{{ csrf_field() }}
					<div class="ttl">◆ ニックネーム</div>
					<div class="mb20">
						<input value="{{ old('name') ? old('name') : Auth::user()->name }}" type="text" name="name" required>
					</div>

					<div class="ttl">◆ メールアドレス</div>
					<div class="mb20 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						@if ($errors->has('email'))
							<span class="help-block with-errors">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
						<input value="{{ old('email') ? old('email') : Auth::user()->email }}" type="email" name="email" required>
					</div>

					<div class="ttl">◆ パスワード</div>
					<div class="mb20 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						@if ($errors->has('password'))
							<span class="help-block with-errors">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
						<input type="password" name="password"  placeholder="※パスワード変更時のみ入力">
					</div>

					<div class="ttl">◆ パスワード(確認用)</div>
					<input type="password" name="password_confirmation" placeholder="※パスワード変更時のみ入力">
					<div class="mb20">
					</div>

					<div class="ttl">◆ 住所(都道府県)</div>
					<div class="mb20">
						<select name="pref_id" required>
							<option value="" selected>▼　選択してください</option>
							@foreach($mstFrom as $from)
								<option value="{{ $from->from_id }}" @if((old('pref_id') ? old('pref_id') : $userInfo->from_id) == $from->from_id) selected @endif>
									{{ $from->from }}
								</option>
							@endforeach
						</select>
					</div>

{{--
					<div class="ttl">◆ 住所(都道府県)</div>
					<div class="mb20">
						<select>
							<option value="">選択してください</option>
							<option value="北海道">北海道</option>
							<option value="青森県">青森県</option>
							<option value="岩手県">岩手県</option>
							<option value="宮城県">宮城県</option>
							<option value="秋田県">秋田県</option>
							<option value="山形県">山形県</option>
							<option value="福島県">福島県</option>
							<option value="茨城県">茨城県</option>
							<option value="栃木県">栃木県</option>
							<option value="群馬県">群馬県</option>
							<option value="埼玉県">埼玉県</option>
							<option value="千葉県">千葉県</option>
							<option value="東京都">東京都</option>
							<option value="神奈川県">神奈川県</option>
							<option value="新潟県">新潟県</option>
							<option value="富山県">富山県</option>
							<option value="石川県">石川県</option>
							<option value="福井県">福井県</option>
							<option value="山梨県">山梨県</option>
							<option value="長野県">長野県</option>
							<option value="岐阜県">岐阜県</option>
							<option value="静岡県">静岡県</option>
							<option value="愛知県">愛知県</option>
							<option value="三重県">三重県</option>
							<option value="滋賀県">滋賀県</option>
							<option value="京都府">京都府</option>
							<option value="大阪府">大阪府</option>
							<option value="兵庫県">兵庫県</option>
							<option value="奈良県">奈良県</option>
							<option value="和歌山県">和歌山県</option>
							<option value="鳥取県">鳥取県</option>
							<option value="島根県">島根県</option>
							<option value="岡山県">岡山県</option>
							<option value="広島県">広島県</option>
							<option value="山口県">山口県</option>
							<option value="徳島県">徳島県</option>
							<option value="香川県">香川県</option>
							<option value="愛媛県">愛媛県</option>
							<option value="高知県">高知県</option>
							<option value="福岡県">福岡県</option>
							<option value="佐賀県">佐賀県</option>
							<option value="長崎県">長崎県</option>
							<option value="熊本県">熊本県</option>
							<option value="大分県">大分県</option>
							<option value="宮崎県">宮崎県</option>
							<option value="鹿児島県">鹿児島県</option>
							<option value="沖縄県">沖縄県</option>
						</select>
					</div>
--}}

					<div class="ttl">◆ 電話番号</div>
					<div class="mb20">
						<input type="text" name="tel" value="{{ old('tel') ? old('tel') : $userInfo->tel }}" required>
					</div>

					<div class="ttl">◆ Line ID</div>
					<div class="mb20">
						<input type="text" name="line" value="{{ old('line') ? old('line') : $userInfo->line }}" >
					</div>

					<div class="ttl">◆ 生年月日</div>
					<div class="mb20" id="datepicker-startview">
						<div class="input-group date">
							<input class="form-control" type="text" name="birth" id="birth"
							       value="{{ old('birth') ? old('birth') : (is_null($userInfo->birth) ? '' : $userInfo->birth->format('Y/m/d')) }}"
							       placeholder="※必須：生年月日を入力して下さい。"
							       data-required-error="入力が必要な項目です。" required>
							<span class="input-group-addon" id="dt_icon">
								<i class="glyphicon glyphicon-th"></i>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>

{{--
					<div class="ttl">◆ 生年月日</div>
					<div class="mb20 birth">
						<select>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
							<option value="1900">1900年</option>
						</select>
					</div>

					<div class="mb20 birth">
						<select>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
							<option value="1">1月</option>
						</select>
					</div>

					<div class="mb20 birth">
						<select>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
							<option value="1">1日</option>
						</select>
					</div>
					<div class="clear"></div>
--}}

					<button type="submit" id="sbtn" name="action" value="post">ユーザー情報を更新</button>
				</form>
			</div>

		</div>
		<!-- end #content -->
	</div>
	<!-- end #container -->

	<!--datepicker-->
	<script type="text/javascript">
		// カレンダーコントロール
		$(function () {
			$('#datepicker-startview .date').datepicker({
				startView: 2,
				language: "ja",
				autoclose: true
			});
		});
	</script>
	<script src="js/bootstrap-datepicker.min.js"></script>
	<script src="js/bootstrap-datepicker.ja.min.js"></script>

@endsection
