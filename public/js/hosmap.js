// GoogleMapAPI 通信処理
function googlemapInit(mapId, address, storeName) {

	let geocoder = new google.maps.Geocoder();

	geocoder.geocode({'address': address,'language':'ja'},function(results, status){
		if (status == google.maps.GeocoderStatus.OK){
			let latlng=results[0].geometry.location;    // 緯度・経度
			let mapOpt = {
				center: latlng,                             // 地図中央
				zoom: 15,                                   // 地図倍率
				mapTypeId: google.maps.MapTypeId.ROADMAP,   // 道路マップ
				mapTypeControl: false                       // 地図・航空写真非表示
			};
			let map = new google.maps.Map(document.getElementById(mapId),mapOpt);
			let marker = new google.maps.Marker({
				position: map.getCenter(),
				map: map,
				title: storeName
			});
			let widgetDiv = document.getElementById('map_widget');
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(widgetDiv);
		}else{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}