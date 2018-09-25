$(function () {
	// 予約ボタン上
	$('#res_top').on('click', function () {
		if ($('#menu_bar01').prop("checked") === false) {
			$('#menu_bar01').click();
		}
	});

	// お気に入りに登録
	$('[name="fav_host"]').on('click', function () {
		let hostId = $(this).attr('id');
		let addFlg = $(this).prop('checked') ? 'true' : 'false';

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'POST',
			url: '/detail/set_favrite',
			datatype: 'json',
			async: false,
			data: {
				'host_id': hostId,
				'add_flg' : addFlg
			}
		}).done(function (data) {
			let temp = 1;
		}).fail(function (data) {
			alert("ajax通信エラーです");
		});

	});

	// 予約ホスト選択
	$('[name="reserv_host"]').on('click', function () {
		let id = $(this).attr('id');
		let name = $(this).val();
		if ($(this).prop('checked') === true) {
			let chkCnt = 0;
			$('[name="reserv_host"]:checked').each(function () {
				if (chkCnt >= 5) {
					alert('選択できるホストは５名までです');
					$('#' + id).prop('checked', false);
				}
				chkCnt++;
			});
		}
	});

	// 日時選択
	$('#datetime_tbl td').on('click', function () {

		if ($(this).attr('class').substring(0, 2) !== 'ok') {
			return;
		}

		let selected_id = $('#selected_dt').val();
		let click_id = $(this).attr('id');

		if (selected_id === click_id) {
			$(this).removeClass('selected_datetime');
			$('#selected_dt').val('');
		} else {
			if (selected_id !== '') {
				$('#' + selected_id).removeClass('selected_datetime');
			}
			$(this).addClass('selected_datetime');
			$('#selected_dt').val(click_id);
		}
	});

	// 予約確認モーダル
	$('#btn_reserv').on('click', function () {

		let come_date = $('#selected_dt').val();
		if (come_date === '') {
			alert('ご来店の日時が選択されていません');
			return;
		}

		$(this).blur();
		if ($('#modal_overlay')[0]) return false;

		$('body').append('<div id="modal_overlay"></div>');
		$('#modal_overlay').fadeIn('slow');

		// 選択日時
		$('#confirm_reserv').empty();
		let dates = come_date.split('_');
		$('#confirm_reserv').append('<div>' + dates[0] + '年' + dates[1] + '月' + dates[2] + '日　' + dates[3] + ':' + dates[4] + '</div>');
		$('#res_date').val(dates[0] + '_' + dates[1] + '_' + dates[2] + '_' + dates[3] + '_' + dates[4]);

		// お好みホスト
		let fav = '';
		let cnt = 1;
		$('[name="reserv_host"]:checked').each(function () {
			fav += '<li>・' + $(this).val() + '</li>';
			$('#fav_host_' + cnt++).val($(this).attr('id'));
		});

		$('#fav_host').empty();
		if (fav === '') {
			$('#fav_host').append('<li>・なし</li>');
		} else {
			$('#fav_host').append(fav);
		}

		centeringModalSync();
		$('#modal_reserv').fadeIn('slow');
	});

	// 予約キャンセル
	$('#reserv_cancel').on('click', function () {
		$("#modal_reserv,#modal_overlay").fadeOut("slow", function () {
			$("#modal_overlay").remove();
		});
	});

	$(window).resize(centeringModalSync);

	// センタリング
	function centeringModalSync() {

		let w = $(window).width();
		let h = $(window).height();

		let cw = $('#modal_reserv').outerWidth();
		let ch = $('#modal_reserv').outerHeight();

		let pxleft = ((w - cw) / 2);
		let pxtop = ((h - ch) / 2);

		$('#modal_reserv').css({"left": pxleft + "px"});
		$('#modal_reserv').css({"top": pxtop + "px"});
	}

});

// 予約済みチェック
function checkReserve() {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	let date = $('#res_date').val();
	let result = true;

	$.ajax({
		type: 'POST',
		url: '/detail/chk_reserve',
		datatype: 'json',
		async: false,
		data: {
			'res_date': date
		}
	}).done(function (data) {
		if(data !== 'OK'){
			alert("ご指定の日時は既に " + data + " の予約をされています");
			result = false;
		}

	}).fail(function (data) {
		alert("ajax通信エラーです");
		result = false;
	});

	return result;
}

