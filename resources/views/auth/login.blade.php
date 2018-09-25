@extends('layouts.app')

@section('content')

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

	<div class="container10" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="0">
		<div class="content">

			<h2 class="pln2">ホスマッチにログイン</h2>

			<div class="box04">
				<form method="POST" action="{{ route('login') }}">
					{{ csrf_field() }}

					<div class="box_lft">
						<h3 class="ctr">登録済みの方</h3>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<div class="ttl">◆ メールアドレス</div>
							@if ($errors->has('email'))
								<span class="help-block with-errors">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
							@endif

							<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required >
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<div class="ttl">◆ パスワード</div>
							@if ($errors->has('password'))
								<span class="help-block with-errors">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
							@endif

							<input type="password" id="password" name="password" class="form-control" required >
						</div>

						<div class="box_full">
							<input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
							<label for="remember" class="sample_label">パスワードを記憶する</label>
						</div>

						<div class="center">
							<button type="submit" id="sbtn" name="action" value="post">ログイン</button>
							<div class="pix12"><a href="">パスワードを忘れた方 »</a></div>
						</div>
					</div>
				</form>

				<form method="POST" action="{{ route('register') }}">
					{{ csrf_field() }}

					<div class="box_rgt">
						<h3 class="ctr">初めて利用する方</h3>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<div class="ttl">◆ ニックネーム</div>
							@if ($errors->has('name'))
								<span class="help-block with-errors">
									<strong>{{ $errors->first('name') }}</strong>
								</span>
							@endif
							<input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required >
						</div>

						<div class="form-group{{ $errors->has('reg_email') ? ' has-error' : '' }}">
							<div class="ttl">◆ メールアドレス</div>
							@if ($errors->has('reg_email'))
								<span class="help-block with-errors">
									<strong>{{ $errors->first('reg_email') }}</strong>
								</span>
							@endif
							<input type="email" id="reg_email" name="reg_email" class="form-control" value="{{ old('reg_email') }}" required >
						</div>

						<div class="form-group{{ $errors->has('reg_password') ? ' has-error' : '' }}">
							<div class="ttl">◆ パスワード</div>
							@if ($errors->has('reg_password'))
								<span class="help-block with-errors">
									<strong>{{ $errors->first('reg_password') }}</strong>
								</span>
							@endif
							<input type="password" id="reg_password" name="reg_password" class="form-control" required >
						</div>

						<div class="ttl">◆ 確認用パスワード</div>
						<div class="form-group">
							<input id="password_confirm" type="password" class="form-control"
							       name="reg_password_confirmation" required>
						</div>

{{--
						<div class="ttl">◆ お住まい</div>
						<select name="pref_name" class="form-control">
							<option value="" selected>▼　選択してください</option>
							@inject('fromMst', 'App\Models\MstFromTbl')
							@foreach($fromMst::all() as $from)
								<option value="{{ $from->from_id }}" @if(old('from') == $from->from_id) selected @endif>
									{{ $from->from }}
								</option>
							@endforeach
						</select>
--}}

						<div class="box_full">
							<input type="checkbox" name="not18" value="" id="not18" checked="checked"/>
							<label for="not18" class="sample_label">私は18歳未満ではありません。</label>
							<div class="pix12">※18歳未満の会員の方はお店でアルコールの提供はできません。</div>
						</div>

						<div class="center">
							<button type="submit" id="sbtn" name="action" value="post">会員登録</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end #content -->
	</div>
	<!-- end #container -->

	<!-- /////////////////////////////////////////////// -->
@endsection
