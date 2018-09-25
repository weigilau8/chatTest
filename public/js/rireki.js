$(function () {
	// タブ切り替え
	$('[name="tab_resv"]').on('click', function () {
		let no = $(this).attr('id');
		$('[name="tab_resv"]').removeClass('current');
		$(this).addClass('current');

		$(".table_rireki").removeClass("active");
		$('#table' + no).addClass("active");

		$(".pagenavi").removeClass("active");
		$('#navi' + no).addClass("active");
	});

	// ページ切り替え これからの予約
	$('[name="navi_yet"]').on('click', function () {
		let cls = $(this).attr('class');
		if (cls.slice(-7) === 'current') {
			return;
		}

		let nextId = $(this).attr('id');
		let last = $('#yet_count').val();

		if (nextId === 'pg_yet_top') {
			nextId = 'pg_yet_01';
		} else if (nextId === 'pg_yet_next') {
			let id = $('.navi_yet.num.current').attr('id');
			let pg = parseInt(id.slice(-2)) + 1;
			nextId = 'pg_yet_' + (pg < 10 ? '0' + pg : pg);
		} else if (nextId === 'pg_yet_last') {
			nextId = 'pg_yet_' + last;
		}

		$('[name="navi_yet"]').removeClass('current');
		$('#' + nextId).addClass('current');

		let nextPg = nextId.slice(-2);

		if (nextPg === '01') {
			$('#pg_yet_top').addClass('current');
		} else if (nextPg === last) {
			$('#pg_yet_next').addClass('current');
			$('#pg_yet_last').addClass('current');
		}

		$(".tbody_yet").removeClass("active");
		$('#yet' + nextPg).addClass("active");
	});

	// ページ切り替え 来店済み予約
	$('[name="navi_fin"]').on('click', function () {
		let cls = $(this).attr('class');
		if (cls.slice(-7) === 'current') {
			return;
		}

		let nextId = $(this).attr('id');
		let last = $('#fin_count').val();

		if (nextId === 'pg_fin_top') {
			nextId = 'pg_fin_01';
		} else if (nextId === 'pg_fin_next') {
			let id = $('.navi_fin.num.current').attr('id');
			let pg = parseInt(id.slice(-2)) + 1;
			nextId = 'pg_fin_' + (pg < 10 ? '0' + pg : pg);
		} else if (nextId === 'pg_fin_last') {
			nextId = 'pg_fin_' + last;
		}

		$('[name="navi_fin"]').removeClass('current');
		$('#' + nextId).addClass('current');

		let nextPg = nextId.slice(-2);

		if (nextPg === '01') {
			$('#pg_fin_top').addClass('current');
		} else if (nextPg === last) {
			$('#pg_fin_next').addClass('current');
			$('#pg_fin_last').addClass('current');
		}

		$(".tbody_fin").removeClass("active");
		$('#fin' + nextPg).addClass("active");
	});

	// キャンセル処理
	$('[name="cancel_btn"]').on('click', function () {
		if (window.confirm('本当にキャンセルしますか？')) {
			let act = 'mypage_rireki/cancel/' + $(this).attr('id');
			$('#frm_cancel').attr('action', act);
			$('#frm_cancel').submit();

			return true;
		} else {
			return false;
		}

	});

});

