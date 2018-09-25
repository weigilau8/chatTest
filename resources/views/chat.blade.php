@extends('layouts.app_mypage')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="container mymenu login_content" >
		<div class="content02">
			<h2>HOSMATCH　マイメニュー</h2>
		</div>

		<div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" id="app">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    <chat-messages :messages="messages"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                    ></chat-form>
                </div>
            </div>
        </div>
	</div>

@endsection