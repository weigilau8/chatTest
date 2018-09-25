
!!!!DONE!!!!
<br/>
<br/>
<br/>

<a href="/"><img src="/images/logo.svg" alt="HOSMATCH｜ホスマッチ" class="foot_logo"></a>


<a href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	ログアウト
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	{{ csrf_field() }}
</form>
