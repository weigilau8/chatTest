<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD26ATRoRrvrUR2z3qB7zQUXxjaSdzRy3s" type="text/javascript"></script>
<script type="text/javascript">
	var geocoder = new google.maps.Geocoder();
	var address = "東京都文京区本駒込２－２１－２";
	geocoder.geocode({'address': address,'language':'ja'},function(results, status){
		if (status == google.maps.GeocoderStatus.OK){
			var latlng=results[0].geometry.location;
			var mapOpt = {
				center: latlng,
				zoom: 15,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById('google_map'),mapOpt);
			var marker = new google.maps.Marker({
				position: map.getCenter(),
				map: map
			});
		}else{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
</script>
<div id="google_map" style="width:90%;height:500px"></div>
