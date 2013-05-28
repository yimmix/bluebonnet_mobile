function init_map(map_canvas_id, lat, lng, zoomLevel) {
	var myLatLng = new google.maps.LatLng(lat, lng);

	var options = {
	zoom: zoomLevel,
	center: myLatLng,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map_canvas = document.getElementById(map_canvas_id);

	var map = new google.maps.Map(map_canvas, options);
	for (var i = 1; i <= markers.length; i++) {
	var marker = new google.maps.Marker(markers[i-1]);

	 
	 marker.setIcon('http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+i+'|64B949|000'); 
	marker.setMap(map);
				 
	}
}